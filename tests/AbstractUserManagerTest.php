<?php


declare( strict_types = 1 );


use JDWX\Web\Login\AbstractUserManager;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Shims\MyUserManager;


require_once __DIR__ . '/Shims/MyUserManager.php';


#[CoversClass( AbstractUserManager::class )]
final class AbstractUserManagerTest extends TestCase {


    public function testNewToken() : void {
        $stToken = MyUserManager::newTokenPub();
        self::assertSame( 180, strlen( $stToken ) );

        $stToken2 = MyUserManager::newTokenPub();
        self::assertNotSame( $stToken, $stToken2 );
    }


}