<?php


declare( strict_types = 1 );


use JDWX\Web\Auth\Level;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;


#[CoversClass( Level::class )]
final class LevelTest extends TestCase {


    public function testIs() : void {
        $level = Level::USER;
        self::assertTrue( $level->is( Level::USER ) );
        self::assertFalse( $level->is( Level::ADMIN ) );
        self::assertFalse( $level->is( Level::PUBLIC ) );
        self::assertTrue( $level->is( 5000 ) );
        self::assertFalse( $level->is( 9001 ) );
        self::assertFalse( $level->is( 0 ) );
    }


    public function testIsAbove() : void {
        $level = Level::USER;
        self::assertFalse( $level->isAbove( Level::USER ) );
        self::assertTrue( $level->isAbove( Level::PUBLIC ) );
        self::assertFalse( $level->isAbove( Level::ADMIN ) );
        self::assertTrue( $level->isAbove( 4999 ) );
        self::assertFalse( $level->isAbove( 5000 ) );
        self::assertTrue( $level->isAbove( 0 ) );
        self::assertFalse( $level->isAbove( 9001 ) );
    }


    public function testIsAtLeast() : void {
        $level = Level::USER;
        self::assertTrue( $level->isAtLeast( Level::USER ) );
        self::assertTrue( $level->isAtLeast( Level::PUBLIC ) );
        self::assertFalse( $level->isAtLeast( Level::ADMIN ) );
        self::assertTrue( $level->isAtLeast( 5000 ) );
        self::assertFalse( $level->isAtLeast( 5001 ) );
        self::assertTrue( $level->isAtLeast( 0 ) );
        self::assertFalse( $level->isAtLeast( 9001 ) );
    }


    public function testIsAtOrBelow() : void {
        $level = Level::USER;
        self::assertTrue( $level->isAtOrBelow( Level::USER ) );
        self::assertFalse( $level->isAtOrBelow( Level::PUBLIC ) );
        self::assertTrue( $level->isAtOrBelow( Level::ADMIN ) );
        self::assertTrue( $level->isAtOrBelow( 5000 ) );
        self::assertFalse( $level->isAtOrBelow( 0 ) );
        self::assertTrue( $level->isAtOrBelow( 9001 ) );
    }


    public function testIsBelow() : void {
        $level = Level::USER;
        self::assertFalse( $level->isBelow( Level::USER ) );
        self::assertFalse( $level->isBelow( Level::PUBLIC ) );
        self::assertTrue( $level->isBelow( Level::ADMIN ) );
        self::assertFalse( $level->isBelow( 5000 ) );
        self::assertFalse( $level->isBelow( 0 ) );
        self::assertTrue( $level->isBelow( 9001 ) );
    }


}