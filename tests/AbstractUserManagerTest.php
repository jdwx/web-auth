<?php


declare( strict_types = 1 );


namespace JDWX\Web\tests;


use JDWX\Web\Login\AbstractUserManager;
use JDWX\Web\Login\UserManagerInterface;
use JDWX\Web\tests\Shims\MyUserManager;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;


require_once __DIR__ . '/Shims/MyUserManager.php';


#[CoversClass( AbstractUserManager::class )]
final class AbstractUserManagerTest extends TestCase {


    public function testNewToken() {
        $stToken = MyUserManager::newTokenPub();
        self::assertSame( 180, strlen( $stToken ) );

        $stToken2 = MyUserManager::newTokenPub();
        self::assertNotSame( $stToken, $stToken2 );
    }


    private function newAbstractUserManager() : UserManagerInterface {
        return new MyUserManager();
    }


}