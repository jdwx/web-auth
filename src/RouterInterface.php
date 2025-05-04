<?php


declare( strict_types = 1 );


namespace JDWX\Web\Login;


interface RouterInterface extends \JDWX\Web\Framework\RouterInterface {


    /**
     * @param RouteTag $i_tag The tag to look up.
     * @return ?string The route matching a given tag, or null if no
     *                 such route exists.
     *
     * This is mainly used for things like looking up what page
     * to redirect to after a successful login or logout.
     */
    public function getTagUri( RouteTag $i_tag ) : ?string;


}