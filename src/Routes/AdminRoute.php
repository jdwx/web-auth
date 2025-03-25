<?php


declare( strict_types = 1 );


namespace JDWX\Web\Login\Routes;


use JDWX\Web\Login\Level;


class AdminRoute extends AuthRoute {


    protected const Level REQUIRED_LEVEL = Level::ADMIN;


}