<?php


declare( strict_types = 1 );


namespace Routes;


use ExampleHtmlPage;
use JDWX\Web\Framework\Response;
use JDWX\Web\Framework\ResponseInterface;
use JDWX\Web\Login\SignupRoute;


class ExampleSignupRoute extends SignupRoute {


    private string $stUsername = '';

    private string $stLevel = 'user';

    private ?string $nstError = null;


    protected function handleGET( string $i_stUri, string $i_stPath ) : ?ResponseInterface {
        $page = new ExampleHtmlPage( 'Signup' );
        $stUserSelected = $this->stLevel === 'user' ? ' selected' : '';
        $stAdminSelected = $this->stLevel === 'admin' ? ' selected' : '';
        $page->addContent(
            '<label for="error"></label> '
            . '<span id="error" style="color: red;">' . $this->nstError . '</span>'
            . '<br><br>'
        );
        $page->addContent( '<form method="post">'
            . '<label for="username">Username:</label> '
            . '<input type="text" id="username" name="username" required value="' . $this->stUsername . '">'
            . '<br>'
            . '<label for="password">Password:</label> '
            . '<input type="password" id="password" name="password" required>'
            . '<br>'
            . '<label for="level">Level:</label> '
            . '<select id="level" name="level">'
            . '<option value="user"' . $stUserSelected . '>User</option>'
            . '<option value="admin"' . $stAdminSelected . '>Admin</option>'
            . '</select>'
            . '<br>'
            . '<label for="submit"></label> '
            . '<input id="submit" type="submit" value="Signup">'
            . '</form>'
        );

        return Response::page( $page );
    }


    protected function handlePOST( string $i_stUri, string $i_stPath ) : ?ResponseInterface {
        $this->stUsername = $this->request()->postEx( 'username' )->asString();
        $rAuthData = [
            'password' => $this->request()->postEx( 'password' )->asString(),
        ];
        $bst = $this->managerEx()->signUp( $this->stUsername, $rAuthData );
        if ( is_string( $bst ) ) {
            $this->nstError = $bst;
            return $this->handleGET( $i_stUri, $i_stPath );
        }

        $page = new ExampleHtmlPage( 'Signup' );
        $page->addContent( 'Signup successful.' );
        return Response::page( $page );
    }


}