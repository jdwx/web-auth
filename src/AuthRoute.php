<?php


declare( strict_types = 1 );


namespace JDWX\Web\Login;


use JDWX\Web\Framework\AbstractRoute;


class AuthRoute extends AbstractRoute {


    private static ?UserManagerInterface $manager = null;

    private ?string $nstToken = null;


    public static function setManager( UserManagerInterface $i_manager ) : void {
        if ( ! is_null( self::$manager ) ) {
            throw new \LogicException( 'UserManager already set' );
        }
        self::$manager = $i_manager;
    }


    protected function aaa( string $i_stMethod, string $i_stUri, string $i_stPath ) : true|string {
        return $this->credentialsEx()->aaa( $i_stMethod, $i_stUri, $i_stPath );
    }


    protected function credentials() : ?CredentialsInterface {
        if ( is_null( $this->nstToken ) ) {
            return null;
        }
        return $this->managerEx()->resume( $this->nstToken );
    }


    protected function credentialsEx() : CredentialsInterface {
        $cred = $this->credentials();
        if ( ! is_null( $cred ) ) {
            return $cred;
        }
        throw new \RuntimeException( 'Required credentials not present' );
    }


    protected function isAdmin() : bool {
        return $this->credentials()?->isAdmin() ?? false;
    }


    protected function isAdminOrHigher() : bool {
        return $this->credentials()?->isAdminOrHigher() ?? false;
    }


    protected function isPublic() : bool {
        return $this->credentials()?->isPublic() ?? false;
    }


    protected function isPublicOrHigher() : bool {
        return $this->credentials()?->isPublicOrHigher() ?? false;
    }


    protected function isUser() : bool {
        return $this->credentials()?->isUser() ?? false;
    }


    protected function isUserOrHigher() : bool {
        return $this->credentials()?->isUserOrHigher() ?? false;
    }


    protected function manager() : ?UserManagerInterface {
        return self::$manager;
    }


    protected function managerEx() : UserManagerInterface {
        $mgr = $this->manager();
        if ( $mgr instanceof UserManagerInterface ) {
            return $mgr;
        }
        throw new \RuntimeException( 'Required UserManager interface not present' );
    }


    protected function setToken( string $i_stToken ) : void {
        $this->nstToken = $i_stToken;
    }


}