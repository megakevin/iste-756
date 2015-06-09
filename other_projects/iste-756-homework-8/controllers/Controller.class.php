<?php

require "BaseController.class.php";

include "lib/xmlrpc.inc";
include "lib/xmlrpcs.inc";
include "lib/xmlrpc_wrappers.inc";

class Controller extends BaseController
{
    private $client;

    public function __construct($context)
    {
        $this->context = $context;
        $this->client = new xmlrpc_client( "beer", "alvin.ist.rit.edu", 8100);
    }

    public function get()
    {
        $this->init_data();
    }

    public function post()
    {
        if (isset($_POST["get_price_submit"]))
        {
            $this->context->beer_price = $this->get_price($_POST["beer"]);
        }

        $this->init_data();
    }

    public function init_data()
    {
        $this->context->methods = $this->get_methods();
        $this->context->beers = $this->get_beers();
        $this->context->cheapest_beer = $this->get_cheapest_beer();
        $this->context->costliest_beer = $this->get_costliest_beer();
    }

    public function get_methods()
    {
        $response = $this->handle_xmlrpc($this->client, new xmlrpcmsg("beer.getMethods"));

        $results = array();

        foreach ($response as $method)
        {
            $results[] = $method->me["string"];
        }

        return $results;
    }

    public function get_beers()
    {
        $response = $this->handle_xmlrpc($this->client, new xmlrpcmsg("beer.getBeers"));

        $results = array();

        foreach ($response as $beer)
        {
            $results[] = $beer->me["string"];
        }

        return $results;
    }

    public function get_cheapest_beer()
    {
        $response = $this->handle_xmlrpc($this->client, new xmlrpcmsg("beer.getCheapest"));

        return $response;
    }

    public function get_costliest_beer()
    {
        $response = $this->handle_xmlrpc($this->client, new xmlrpcmsg("beer.getCostliest"));

        return $response;
    }

    public function get_price($beer)
    {
        $msg = new xmlrpcmsg("beer.getPrice", array(new xmlrpcval($beer, "string")));
        $response = $this->handle_xmlrpc($this->client, $msg);

        return $response;
    }

    public function handle_xmlrpc( $client, $msg ) {
        // invoke the method
        $result = $client->send( $msg );

        if ( $result ) {
            if ( $result->value() ) { // no error has occurred
                // use a shortcut function to lazily decode a scalar
                $val = $result->value()->scalarval();
                //echo "We got this result: $val<br/>";

                return $val;
            }
            else {
                // deal with XML-RPC error
                echo "We got an error!<br/>";
                echo $result->faultCode() . ": " . $result->faultString() . "<br/>";
            }
        }
        else { // a low-level I/O error has occurred
            echo "Help! A low-level error has occurred. Error #" .
                $client->errno . ": " . $client->errstr . "<br/>";
            die();
        }
    }
}