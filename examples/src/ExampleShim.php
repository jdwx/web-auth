<?php


declare( strict_types = 1 );


use JDWX\Web\Framework\PhpWsShim;


class ExampleShim extends PhpWsShim {


    public function __construct() {
        $router = new ExampleRouter();
        parent::__construct( $router, __DIR__ . '/../static/' );
    }


}