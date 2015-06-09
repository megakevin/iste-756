<?php
include "xmlrpclib/xmlrpc.inc";
include "xmlrpclib/xmlrpcs.inc";
include "xmlrpclib/xmlrpc_wrappers.inc";

require_once "services/BeerService.class.php";

function getMethods($params)
{
    /*
        public Vector getMethods()	Takes no arguments and returns a list of the methods contained in the service.
        public Double getPrice(String beer)	Takes a string denoting the beer brand and returns a double representing the beer price.
        public Boolean setPrice(String beer, Double price)	Takes a string denoting the beer brand and a double denoting the price returns true or false depending on success
        public Vector getBeers()	Takes no arguments and returns a list of the known beers.
        public String getCheapest()	Takes no arguments and returns the name of the least expensive beer.
        public String getCostliest()	Takes no arguments and returns the name of the most expensive beer.
     */

    return new xmlrpcresp(
        new xmlrpcval(
            array(
                new xmlrpcval("public Vector getMethods()", 'string'),
                new xmlrpcval("public Double getPrice(String beer)", 'string'),
                new xmlrpcval("public Boolean setPrice(String beer, Double price)", 'string'),
                new xmlrpcval("public Vector getBeers()", 'string'),
                new xmlrpcval("public String getCheapest()", 'string'),
                new xmlrpcval("public String getCostliest()", 'string')
            ),
            "array"
        )
    );
}

//public Vector getBeers()
function getBeers($params)
{
    $service = new BeerService();
    $beers = $service->get_all_beers();

    $result = array();

    foreach ($beers as $beer)
    {
        $result[] = new xmlrpcval($beer->name, 'string');
    }

    return new xmlrpcresp(
        new xmlrpcval($result, "array")
    );
}

//public String getCheapest()
function getCheapest($params)
{
    $service = new BeerService();
    $cheapest_beer = $service->get_cheapest_beer();

    return new xmlrpcresp( new xmlrpcval( $cheapest_beer->name, "string" ) );
}

//public String getCostliest()
function getCostliest($params)
{
    $service = new BeerService();
    $costliest_beer = $service->get_costliest_beer();

    return new xmlrpcresp( new xmlrpcval( $costliest_beer->name, "string" ) );
}

//public Double getPrice(String beer)
function getPrice($params)
{
    $service = new BeerService();
    $beer_name = $params->getParam(0)->scalarval();
    $beer_price = $service->get_beer_price($beer_name);

    return new xmlrpcresp( new xmlrpcval( $beer_price, "double" ) );
}

//public Boolean setPrice(String beer, Double price)
function setPrice($params)
{
    $service = new BeerService();

    $beer_name= $params->getParam(0)->scalarval();
    $beer_price = $params->getParam(1)->scalarval();

    $success = $service->set_beer_price($beer_name, $beer_price);

    // build response
    return new xmlrpcresp( new xmlrpcval( $success, "boolean" ) );
}

// Declare our signature and provide some information
//   in a "dispatch map".
// The PHP server supports "remote introspection".
// Signature: array of signatures, where each is an array
//   that includes the return type and one or more
//   param types

$getMethods_sig = array( array( "array" ) );
$getBeers_sig = array( array( "array" ) );
$getCheapest_sig = array( array( "string" ) );
$getCostliest_sig = array( array( "string" ) );
$getPrice_sig = array( array( "string", "string" ) );
$setPrice_sig = array( array( "boolean", "string", "double" ) );

$getMethods_doc = "Returns available methods.";
$getBeers_doc = "Returns available beers.";
$getCheapest_doc = "Returns the cheapest beer.";
$getCostliest_doc = "Returns the costliest beer.";
$getPrice_doc = "Returns the price of a given beer.";
$setPrice_doc = "Updates the price of a given beer.";

new xmlrpc_server( array(
    "beers.getCheapest" =>
        array( "function" => "getCheapest",
            "signature" => $getCheapest_sig,
            "docstring" => $getCheapest_doc ),
    "beers.getCostliest" =>
        array( "function" => "getCostliest",
            "signature" => $getCostliest_sig,
            "docstring" => $getCostliest_doc ),
    "beers.getMethods" =>
        array( "function" => "getMethods",
            "signature" => $getMethods_sig,
            "docstring" => $getMethods_doc ),
    "beers.getBeers" =>
        array( "function" => "getBeers",
            "signature" => $getBeers_sig,
            "docstring" => $getBeers_doc ),
    "beers.getPrice" =>
        array( "function" => "getPrice",
            "signature" => $getPrice_sig,
            "docstring" => $getPrice_doc ),
    "beers.setPrice" =>
        array( "function" => "setPrice",
            "signature" => $setPrice_sig,
            "docstring" => $setPrice_doc )
));
?>