<?php


declare( strict_types = 1 );


use JDWX\Web\SimpleHtmlPage;


class ExampleHtmlPage extends SimpleHtmlPage {


    /** @var array<string, string> */
    private const array ROUTES = [
        'Public' => '/',
        'Signup' => '/signup',
        'Login' => '/login',
        'User' => '/user',
        'Admin' => '/admin',
    ];


    public function __construct( string $stWhich ) {
        parent::__construct();
        $this->setTitle( "Example Page - {$stWhich}" );
        $this->addContent( '<nav>' );
        foreach ( self::ROUTES as $stName => $stRoute ) {
            if ( $stName === $stWhich ) {
                $this->addContent( "<b>{$stName}</b> " );
                continue;
            }
            $this->addContent( "<a href=\"{$stRoute}\">{$stName}</a> " );
        }
        $this->addContent( "</nav><hr><h1>{$stWhich} Page</h1><hr>" );
        $this->addCSS( '/css/example.css' );
    }


}