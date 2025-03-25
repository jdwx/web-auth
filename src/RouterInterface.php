<?php


declare( strict_types = 1 );


namespace JDWX\Web\Login;


interface RouterInterface extends \JDWX\Web\Framework\RouterInterface {


    public function getTagUri( RouteTag $i_tag ) : ?string;


}