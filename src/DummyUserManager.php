<?php


declare( strict_types = 1 );


namespace JDWX\Web\Auth;


use ArrayAccess;
use LogicException;


/**
 * Please do not use this class in production.
 */
class DummyUserManager extends AbstractUserManager {


    private const int TOKEN_LIFETIME = 600;


    /** @param ArrayAccess<string, mixed> $kv */
    public function __construct( private ArrayAccess $kv ) {}


    public function addUser( string $i_stUserId, string $i_stPassword, Level|int $i_level ) : void {
        if ( ! $i_level instanceof Level ) {
            /** @noinspection CallableParameterUseCaseInTypeContextInspection */
            $i_level = Level::from( $i_level );
        }
        $stUserKey = "user:{$i_stUserId}";
        if ( isset( $this->kv[ $stUserKey ] ) ) {
            throw new LogicException( "User already exists: {$i_stUserId}" );
        }
        $stPasswordHash = password_hash( $i_stPassword, PASSWORD_DEFAULT );
        $this->kv[ $stUserKey ] = [
            'passwordHash' => $stPasswordHash,
            'level' => $i_level->value,
        ];
    }


    public function logIn( string $i_stUserId, array $i_rAuthData = [] ) : string|CredentialsInterface {
        $stUserKey = "user:{$i_stUserId}";
        if ( ! isset( $this->kv[ $stUserKey ] ) ) {
            return 'User not found';
        }
        if ( ! isset( $i_rAuthData[ 'password' ] ) ) {
            return 'Password required';
        }
        $r = $this->kv[ $stUserKey ];
        if ( ! password_verify( $i_rAuthData[ 'password' ], $r[ 'passwordHash' ] ) ) {
            return 'Invalid password';
        }
        $stToken = self::newToken();
        $stTokenKey = "token:{$stToken}";
        $this->kv[ $stTokenKey ] = [
            'userId' => $i_stUserId,
            'expires' => time() + self::TOKEN_LIFETIME,
        ];
        return $this->resume( $stToken ) ?? 'An error occurred';
    }


    public function logOut( string $i_stToken ) : void {
        $stTokenKey = "token:{$i_stToken}";
        unset( $this->kv[ $stTokenKey ] );
    }


    public function resume( string $i_stToken ) : ?CredentialsInterface {
        $stTokenKey = "token:{$i_stToken}";
        if ( ! isset( $this->kv[ $stTokenKey ] ) ) {
            return null;
        }
        $rToken = $this->kv[ $stTokenKey ];
        if ( $rToken[ 'expires' ] < time() ) {
            unset( $this->kv[ $stTokenKey ] );
            return null;
        }
        $stUser = $rToken[ 'userId' ];
        $stUserKey = "user:{$stUser}";
        $rUser = $this->kv[ $stUserKey ];
        return new DummyCredentials( $stUser, $i_stToken, $rUser[ 'level' ] );
    }


    public function signUp( string $i_stUserId, array $i_rSignUpData = [] ) : true|string {
        $stUserKey = "user:{$i_stUserId}";
        if ( isset( $this->kv[ $stUserKey ] ) ) {
            return 'User already exists';
        }
        if ( ! isset( $i_rSignUpData[ 'password' ] ) ) {
            return 'Password required';
        }
        $uLevel = intval( $i_rSignUpData[ 'level' ] ?? Level::USER->value );
        $this->addUser( $i_stUserId, $i_rSignUpData[ 'password' ], $uLevel );
        return true;
    }


}