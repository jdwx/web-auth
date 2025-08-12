<?php


declare( strict_types = 1 );


namespace JDWX\Web\Auth\Routes;


use JDWX\Web\Auth\Level;


class PublicRoute extends AuthRoute {


    protected const Level REQUIRED_LEVEL = Level::PUBLIC;


}