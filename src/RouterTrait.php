<?php


declare( strict_types = 1 );


namespace JDWX\Web\Auth;


use JDWX\Web\Framework\RouteInterface;


trait RouterTrait {


    /** @var array<string, string> */
    private array $rTags = [];


    public function getTagUri( RouteTag $i_tag ) : ?string {
        return $this->rTags[ $i_tag->name ] ?? null;
    }


    protected function addRoute( string $i_stUri, RouteInterface|string $i_route, ?RouteTag $i_tag = null ) : void {
        parent::addRoute( $i_stUri, $i_route );
        if ( $i_tag ) {
            $this->rTags[ $i_tag->name ] = $i_stUri;
        }
    }


}