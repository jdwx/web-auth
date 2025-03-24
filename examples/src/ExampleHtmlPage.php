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


    public function __construct( private readonly string $stWhich ) {
        parent::__construct();
        $this->setTitle( "Example Page - {$stWhich}" );
        $this->addCSS( '/css/example.css' );
    }


    protected function prefix() : string {
        $st = '<nav>';
        foreach ( self::ROUTES as $stName => $stRoute ) {
            if ( $stName === $this->stWhich ) {
                $st .= "<b>{$stName}</b> ";
                continue;
            }
            $st .= "<a href=\"{$stRoute}\">{$stName}</a> ";
        }
        $st .= "</nav><hr><h1>{$this->stWhich} Page</h1><hr><main>";
        return $st;
    }

    protected function suffix() : string {
        return '</main>';
    }

}