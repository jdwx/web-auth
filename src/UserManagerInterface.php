<?php


declare( strict_types = 1 );


namespace JDWX\Web\Login;


interface UserManagerInterface {


    /**
     * @param string $i_stUserId The user ID.
     * @param array<string, mixed> $i_rAuthData Any other data needed for
     *                                          authentication, (e.g.,
     *                                          password, 2FA token).
     * @return string|CredentialsInterface CredentialsInterface on success,
     *                                     error message string on failure.
     *
     * Be careful with returning a string on failure, as this could help
     * an attacker gain information about the system. We prefer to return
     * "Login incorrect" in all cases and have the logIn method email the
     * user with more information instead. (Provided the username exists.)
     */
    public function logIn( string $i_stUserId, array $i_rAuthData = [] ) : string|CredentialsInterface;


    /**
     * @param string $i_stToken The session token.
     *
     * Invalidates any existing credentials matching the specified token.
     */
    public function logOut( string $i_stToken ) : void;


    /**
     * @param string $i_stToken The session token.
     * @return CredentialsInterface|null
     *
     * Resumes an existing session (created by logIn) if it exists.
     * Returns null if the session is invalid or expired.
     */
    public function resume( string $i_stToken ) : ?CredentialsInterface;


    /**
     * @param array<string, mixed> $i_rSignUpData Any other data needed for sign up. (E.g., email address.)
     * @return true|string True on success, string with an error message on failure.
     */
    public function signUp( string $i_stUserId,
                            array  $i_rSignUpData = [] ) : true|string;


}