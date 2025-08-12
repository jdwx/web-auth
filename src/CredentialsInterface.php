<?php


declare( strict_types = 1 );


namespace JDWX\Web\Auth;


interface CredentialsInterface {


    /**
     * @return true|string True if access is granted, otherwise a string with
     *                     the reason for denial.
     *
     * Allows for accounting and fine-grained access control. For example, if
     * users have access to the "edit user profile" page, you could use this
     * to make sure that they are only allowed to edit their own profile.
     */
    public function aaa( string $i_stMethod, string $i_stUri, string $i_stPath ) : true|string;


    /**
     * @return int The expiration time as a Unix timestamp.
     *
     * Note: This value may change. It is common to extend the expiration time
     * each time the user accesses the site.
     */
    public function getExpirationTime() : int;

    public function getLevel() : Level;

    /**
     * @return string|null The session token, or null if not available.
     *
     * Public credentials may or may not have a token.
     */
    public function getToken() : ?string;

    /**
     * @return string The session token.
     *
     * Used when the token is expected (or required) to be present.
     */
    public function getTokenEx() : string;

    /**
     * @return string|null The user ID, or null if not available.
     *
     * Public credentials do not have a user ID.
     */
    public function getUserId() : ?string;

    /**
     * @return string The user ID.
     *
     * Used when the user ID is expected (or required) to be present.
     */
    public function getUserIdEx() : string;

    public function isLoggedIn() : bool;


}