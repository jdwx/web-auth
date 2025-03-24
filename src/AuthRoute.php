<?php


declare( strict_types = 1 );


namespace JDWX\Web\Login;


use JDWX\Web\Framework\AbstractRoute;


class AuthRoute extends AbstractRoute {


    protected function allowAccess( string $i_stMethod, string $i_stUri, string $i_stPath ) : bool {
        return $this->credentials()->allowAccess( $i_stMethod, $i_stUri, $i_stPath );
    }


    protected function credentials() : ?CredentialsInterface {
        return null;
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


    protected function isAdmin() : bool {
        return $this->credentials()?->isAdmin() ?? false;
    }


    protected function isAdminOrHigher() : bool {
        return $this->credentials()?->isAdminOrHigher() ?? false;
    }


}