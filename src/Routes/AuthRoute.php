<?php


declare( strict_types = 1 );


namespace JDWX\Web\Login\Routes;


use JDWX\Web\Framework\AbstractRoute;
use JDWX\Web\Framework\Exceptions\ForbiddenException;
use JDWX\Web\Framework\ResponseInterface;
use JDWX\Web\Login\CredentialsInterface;
use JDWX\Web\Login\Level;
use JDWX\Web\Login\RouterInterface;
use JDWX\Web\Login\RouteTag;
use JDWX\Web\Login\UserManagerInterface;
use JDWX\Web\Session;
use LogicException;
use RuntimeException;


class AuthRoute extends AbstractRoute {


    protected const Level REQUIRED_LEVEL = Level::IMPOSSIBLE;


    private static ?UserManagerInterface $manager = null;

    private static string $stGuestId = 'Guest';

    private ?CredentialsInterface $credentials = null;

    private ?string $nstToken = null;


    public function __construct( RouterInterface $i_router ) {
        parent::__construct( $i_router );
        if ( Session::cookieInRequest( $this->request() ) ) {
            $this->startSession();
            $this->setToken( Session::get( 'token' ) );
        } elseif ( static::REQUIRED_LEVEL->isAbove( Level::PUBLIC ) ) {
            $this->startSession();
        }
    }


    public static function setManager( UserManagerInterface $i_manager ) : void {
        if ( ! is_null( self::$manager ) ) {
            throw new LogicException( 'UserManager already set' );
        }
        self::$manager = $i_manager;
    }


    protected static function setGuestId( string $i_stGuestId ) : void {
        self::$stGuestId = $i_stGuestId;
    }


    public function handle( string $i_stUri, string $i_stPath ) : ?ResponseInterface {
        if ( $this->getLevel()->isBelow( static::REQUIRED_LEVEL ) ) {
            $this->forbidden( $i_stUri, $i_stPath );
        }
        if ( ! $this->aaa( $this->method(), $i_stUri, $i_stPath ) ) {
            $this->forbidden( $i_stUri, $i_stPath );
        }
        return parent::handle( $i_stUri, $i_stPath );
    }


    /** @param array<string, mixed> $i_rAuthData */
    public function tryLogin( string $i_stUserId, array $i_rAuthData ) : string|CredentialsInterface {
        Session::softStart( $this->logger() );
        $cred = $this->managerEx()->logIn( $i_stUserId, $i_rAuthData );
        if ( is_string( $cred ) ) {
            $this->logger()->info( "Login failed for user '{$i_stUserId}': {$cred}" );
            return $cred;
        }
        $this->setToken( $cred->getToken() );
        $this->saveToken();
        return $cred;
    }


    protected function aaa( string $i_stMethod, string $i_stUri, string $i_stPath ) : true|string {
        return $this->credentials()?->aaa( $i_stMethod, $i_stUri, $i_stPath ) ?? true;
    }


    protected function credentials() : ?CredentialsInterface {
        if ( ! $this->credentials instanceof CredentialsInterface ) {
            if ( is_null( $this->nstToken ) ) {
                return null;
            }
            $this->credentials = $this->managerEx()->resume( $this->nstToken );
        }
        return $this->credentials;
    }


    protected function credentialsEx() : CredentialsInterface {
        $cred = $this->credentials();
        if ( ! is_null( $cred ) ) {
            return $cred;
        }
        throw new RuntimeException( 'Required credentials not present' );
    }


    protected function findBestUserId() : string {
        $nst = null;
        if ( $this->credentials instanceof CredentialsInterface ) {
            $nst = $this->credentials->getUserId();
        }
        return $nst ?? self::$stGuestId;
    }


    protected function forbidden( string $i_stUri, string $i_stPath ) : never {
        $stUserId = $this->findBestUserId();
        $stHas = $this->getLevel()->name;
        $stNeeds = static::REQUIRED_LEVEL->name;
        $stMethod = strtoupper( $this->method() );
        $stWhere = $i_stUri;
        if ( $i_stPath ) {
            $stWhere .= "({$i_stPath})";
        }
        $this->logger()->warning(
            "Forbidden {$stMethod} by {$stUserId} to {$stWhere} (has {$stHas} needs {$stNeeds})"
        );
        throw new ForbiddenException();
    }


    protected function getLevel() : Level {
        return $this->credentials()?->getLevel() ?? Level::PUBLIC;
    }


    protected function getTagUri( RouteTag $i_tag ) : ?string {
        return $this->router()->getTagUri( $i_tag );
    }


    protected function getToken() : ?string {
        return $this->nstToken;
    }


    protected function getTokenEx() : string {
        $nst = $this->getToken();
        if ( is_string( $nst ) ) {
            return $nst;
        }
        throw new RuntimeException( 'Required token not present' );
    }


    protected function isLevel( Level|int $i_level ) : bool {
        return $this->getLevel()->is( $i_level );
    }


    protected function isLevelAbove( Level|int $i_level ) : bool {
        return $this->getLevel()->isAbove( $i_level );
    }


    protected function isLevelAtLeast( Level|int $i_level ) : bool {
        return $this->getLevel()->isAbove( $i_level );
    }


    protected function isLevelBelow( Level|int $i_level ) : bool {
        return $this->getLevel()->isBelow( $i_level );
    }


    protected function isLoggedIn() : bool {
        return $this->credentials()?->isLoggedIn() ?? false;
    }


    /**
     * @return bool True if logged out, false if not logged in.
     */
    protected function logOut() : bool {
        if ( ! $this->isLoggedIn() ) {
            return false;
        }
        $this->managerEx()->logOut( $this->getTokenEx() );
        $this->setToken( null );
        $this->saveToken();
        return true;
    }


    protected function manager() : ?UserManagerInterface {
        return self::$manager;
    }


    protected function managerEx() : UserManagerInterface {
        $mgr = $this->manager();
        if ( $mgr instanceof UserManagerInterface ) {
            return $mgr;
        }
        throw new RuntimeException( 'Required UserManager interface not present' );
    }


    protected function router() : RouterInterface {
        $router = parent::router();
        assert( $router instanceof RouterInterface );
        return $router;
    }
    

    protected function saveToken() : void {
        if ( ! is_string( $this->nstToken ) ) {
            Session::remove( 'token' );
        }
        Session::set( 'token', $this->nstToken );
    }


    protected function setToken( ?string $i_nstToken ) : void {
        $this->nstToken = $i_nstToken;
    }


    protected function startSession() : void {
        Session::start( $this->logger() );
    }


}