<?php


declare( strict_types = 1 );


namespace JDWX\Web\Auth;


enum Level: int {


    case BANNED     = -1000;

    case PUBLIC     = 0;

    case USER       = 5000;

    case ADMIN      = 9001;

    case IMPOSSIBLE = 100_000_000;


    public function is( Level|int $i_levelCheck ) : bool {
        if ( is_int( $i_levelCheck ) ) {
            return $this->value == $i_levelCheck;
        }
        return $this == $i_levelCheck;
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
