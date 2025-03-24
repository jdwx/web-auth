<?php


declare( strict_types = 1 );


use JDWX\Web\Login\KV;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;


#[CoversClass(KV::class)]
final class KVTest extends TestCase {


    public function testOffsetGet() : void {
        $kv = new KV( ':memory:' );
        $kv['foo'] = 'bar';
        self::assertSame( 'bar', $kv['foo'] );

        self::assertNull( $kv[ 'baz' ] );
    }


    /** @noinspection PhpConditionAlreadyCheckedInspection */
    public function testOffsetExists() : void {
        $kv = new KV( ':memory:' );
        $kv['foo'] = 'bar';
        self::assertTrue( isset( $kv['foo'] ) );
        self::assertFalse( isset( $kv['baz'] ) );
    }


    public function testOffsetSet() : void {
        $kv = new KV( ':memory:' );
        $kv['foo'] = 'bar';
        self::assertSame( 'bar', $kv['foo'] );
    }


    /** @noinspection PhpConditionAlreadyCheckedInspection */
    public function testOffsetUnset() : void {
        $kv = new KV( ':memory:' );
        $kv[ 'foo' ] = 'bar';
        unset( $kv[ 'foo' ] );
        self::assertFalse( isset( $kv[ 'foo' ] ) );
    }


}