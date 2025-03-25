<?php


declare( strict_types = 1 );


namespace JDWX\Web\Login;


enum RouteTag {


    case LOGIN;

    case SIGNUP;

    case LOGOUT;

    case AFTER_LOGOUT;


}
