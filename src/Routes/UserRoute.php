<?php


declare( strict_types = 1 );


namespace JDWX\Web\Login\Routes;


use JDWX\Web\Login\Level;


class UserRoute extends AuthRoute {


    protected const Level REQUIRED_LEVEL = Level::USER;


}