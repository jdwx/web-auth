<?php


declare( strict_types = 1 );


namespace JDWX\Web\Auth;


enum Level: int {


    case BANNED     = -1000;

    case PUBLIC     = 0;

    case USER       = 5000;

    case ADMIN      = 9001;

    case IMPOSSIBLE = 100_000_000;


    public static function fromName( string $i_stName ) : self {
        $level = self::tryFromName( $i_stName );
        if ( $level instanceof self ) {
            return $level;
        }
        throw new \InvalidArgumentException( "Invalid level name: {$i_stName}" );
    }


    public static function tryFromName( string $i_stName ) : ?self {
        return match ( strtolower( trim( $i_stName ) ) ) {
            'banned' => self::BANNED,
            'public' => self::PUBLIC,
            'user' => self::USER,
            'admin' => self::ADMIN,
            'impossible' => self::IMPOSSIBLE,
            default => null,
        };
    }


    public function is( Level|int $i_levelCheck ) : bool {
        if ( is_int( $i_levelCheck ) ) {
            return $this->value === $i_levelCheck;
        }
        return $this === $i_levelCheck;
    }


    public function isAbove( Level|int $i_levelCheck ) : bool {
        if ( is_int( $i_levelCheck ) ) {
            return $this->value > $i_levelCheck;
        }
        return $this->value > $i_levelCheck->value;
    }


    public function isAtLeast( Level|int $i_levelCheck ) : bool {
        if ( is_int( $i_levelCheck ) ) {
            return $this->value >= $i_levelCheck;
        }
        return $this->value >= $i_levelCheck->value;
    }


    public function isAtOrBelow( Level|int $i_levelCheck ) : bool {
        if ( is_int( $i_levelCheck ) ) {
            return $this->value <= $i_levelCheck;
        }
        return $this->value <= $i_levelCheck->value;
    }


    public function isBelow( Level|int $i_levelCheck ) : bool {
        if ( is_int( $i_levelCheck ) ) {
            return $this->value < $i_levelCheck;
        }
        return $this->value < $i_levelCheck->value;
    }


}
