<?php
include "xmlrpclib/xmlrpc.inc";
include "xmlrpclib/xmlrpcs.inc";
include "xmlrpclib/xmlrpc_wrappers.inc";

$client = new xmlrpc_client( "/~kac2375/project2/index.php", "kelvin.ist.rit.edu", 80 );
//$client = new xmlrpc_client( "/index.php", "localhost", 8080 );
// output extra info about what client receives from server
//$client->setDebug( 1 );
// HTTP Basic Authentication
//$client->setCredentials( $username, $password );


function handle_xmlrpc( $client, $msg ) {
    // invoke the method
    $result = $client->send( $msg );

    echo "<pre>";
    print_r($result);
    echo "</pre>";

    if ( $result ) {
        if ( $result->value() ) { // no error has occurred
            // use a shortcut function to lazily decode a scalar
            $val = $result->value()->scalarval();
            echo "We got this result: $val<br/>";
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

echo "<hr/><h3>beers.getMethods</h3>";
$msg = new xmlrpcmsg( "beers.getMethods" );
echo "<pre>" . htmlentities( $msg->serialize() ) ."</pre>";
handle_xmlrpc( $client, $msg );

echo "<hr/><h3>beers.getBeers</h3>";
$msg = new xmlrpcmsg( "beers.getBeers" );
echo "<pre>" . htmlentities( $msg->serialize() ) ."</pre>";
handle_xmlrpc( $client, $msg );

echo "<hr/><h3>beers.getCheapest</h3>";
$msg = new xmlrpcmsg( "beers.getCheapest" );
echo "<pre>" . htmlentities( $msg->serialize() ) ."</pre>";
handle_xmlrpc( $client, $msg );

echo "<hr/><h3>beers.getCostliest</h3>";
$msg = new xmlrpcmsg( "beers.getCostliest" );
echo "<pre>" . htmlentities( $msg->serialize() ) ."</pre>";
handle_xmlrpc( $client, $msg );

echo "<hr/><h3>beers.getPrice</h3>";
$msg = new xmlrpcmsg( "beers.getPrice", array( new xmlrpcval( "Corona", "string" ) ) );
echo "<pre>" . htmlentities( $msg->serialize() ) ."</pre>";
handle_xmlrpc( $client, $msg );

echo "<hr/><h3>beers.setPrice</h3>";
$msg = new xmlrpcmsg( "beers.setPrice", array( new xmlrpcval( "Corona", "string" ),
                                              new xmlrpcval( 100.00, "double" ) ) );
echo "<pre>" . htmlentities( $msg->serialize() ) ."</pre>";
handle_xmlrpc( $client, $msg );


echo "<hr/><h3>system.listMethods</h3>";
$msg = new xmlrpcmsg( "system.listMethods" );
echo "<pre>" . htmlentities( $msg->serialize() ) ."</pre>";
handle_xmlrpc( $client, $msg );

echo "<hr/><h3>system.methodHelp</h3>";
$msg = new xmlrpcmsg( "system.methodHelp", array( new xmlrpcval( "beers.calcCircle" ) ) );
echo "<pre>" . htmlentities( $msg->serialize() ) ."</pre>";
handle_xmlrpc( $client, $msg );


?>
