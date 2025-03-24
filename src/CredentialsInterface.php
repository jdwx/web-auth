<?php


declare( strict_types = 1 );


namespace JDWX\Web\Login;


interface CredentialsInterface {


    /** Allows for fine-grained access control. */
    public function allowAccess( string $i_stMethod, string $i_stUri, string $i_stPath ) : bool;


    public function getExpirationTime() : int;


    public function getUserId() : ?string;


    public function getUserIdEx() : string;


    public function getToken() : ?string;


    public function getTokenEx() : string;


    public function isBanned() : bool;


    public function isUser() : bool;


    public function isUserOrHigher() : bool;


    public function isPublic() : bool;


    public function isPublicOrHigher() : bool;


    public function isAdmin() : bool;


    public function isAdminOrHigher() : bool;


}