<?php /** @noinspection PhpComposerExtensionStubsInspection */


declare( strict_types = 1 );


namespace JDWX\Web\Login;


use JDWX\Json\Json;


class KV implements \ArrayAccess {


    private \PDO $pdo;

    private \PDOStatement $stmtExists;

    private \PDOStatement $stmtGet;

    private \PDOStatement $stmtSet;

    private \PDOStatement $stmtDelete;


    public function __construct( string $i_stPath ) {
        $this->pdo = new \PDO( "sqlite:{$i_stPath}" );
        $this->pdo->setAttribute( \PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION );
        $this->pdo->exec( 'CREATE TABLE IF NOT EXISTS kv (
            key TEXT PRIMARY KEY, 
            value TEXT, 
            is_json INTEGER 
        )' );
        $this->stmtExists = $this->pdo->prepare( 'SELECT COUNT(*) FROM kv WHERE key = :key' );
        $this->stmtGet = $this->pdo->prepare( 'SELECT value, is_json FROM kv WHERE key = :key' );
        $this->stmtSet = $this->pdo->prepare( 'INSERT OR REPLACE INTO kv 
            (key, value, is_json) VALUES 
            (:key, :value, :is_json)'
        );
        $this->stmtDelete = $this->pdo->prepare( 'DELETE FROM kv WHERE key = :key' );
    }


    public function offsetExists( $offset ) : bool {
        $this->stmtExists->execute( [ ':key' => $offset ] );
        return (bool) $this->stmtExists->fetchColumn();
    }


    public function offsetGet( $offset ) : ?string|\JsonSerializable {
        $this->stmtGet->execute( [ ':key' => $offset ] );
        $row = $this->stmtGet->fetch( \PDO::FETCH_ASSOC );
        if ( $row === false ) {
            return null;
        }
        if ( $row[ 'is_json' ] ) {
            return Json::decode( $row[ 'value' ], true );
        }
    }


    /**
     * @param string $offset
     * @param string|\JsonSerializable $value
     */
    public function offsetSet( $offset, $value ) : void {
        if ( ! is_string( $value ) ) {
            $value = Json::encode( $value );
            $uIsJson = 1;
        } else {
            $uIsJson = 0;
        }
        $this->stmtSet->execute( [ ':key' => $offset, ':value' => $value ] );
    }


    /** @param string $offset */
    public function offsetUnset( $offset ) : void {
        $this->stmtDelete->execute( [ ':key' => $offset ] );
    }


}