<?php


declare( strict_types = 1 );


namespace JDWX\Web\Auth;


enum RouteTag {


    case LOGIN;

    case SIGNUP;

    case LOGOUT;

    case AFTER_LOGOUT;


}
