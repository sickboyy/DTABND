<?php



define('ROOT', dirname(__FILE__));

$baseurl = 'http://dtabnd.sicksicksicks.co.uk/';



function ismobilesafari() {

    if( preg_match( '/(iPod|iPhone|iPad)/', $_SERVER[ 'HTTP_USER_AGENT' ] ) ) {

        return true;

    } else {

        return false;

    }

}





?>