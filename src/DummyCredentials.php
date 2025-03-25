<?php


declare( strict_types = 1 );


namespace JDWX\Web\Login;


class DummyCredentials extends AbstractCredentials {


    public const int LEVEL_BANNED = 0;

    public const int LEVEL_PUBLIC = 1;

    public const int LEVEL_USER   = 2;

    public const int LEVEL_ADMIN  = 3;


    public function __construct( private readonly ?string $nstUserId = null,
                                 private readonly ?string $nstToken = null,
                                 private readonly int     $uLevel = self::LEVEL_PUBLIC ) {}


    public function aaa( string $i_stMethod, string $i_stUri, string $i_stPath ) : string|true {
        return true;
    }


    public function getExpirationTime() : int {
        return 2 ** 31 - 1;
    }


    public function getToken() : ?string {
        return $this->nstToken;
    }


    public function getUserId() : ?string {
        return $this->nstUserId;
    }


    public function isAdmin() : bool {
        return $this->uLevel === self::LEVEL_ADMIN;
    }


    public function isBanned() : bool {
        return $this->uLevel === self::LEVEL_BANNED;
    }


    public function isPublic() : bool {
        return $this->uLevel === self::LEVEL_PUBLIC;
    }


    public function isUser() : bool {
        return $this->uLevel === self::LEVEL_USER;
    }


}