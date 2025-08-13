<?php


declare( strict_types = 1 );


namespace Routes;


use ExampleHtmlPage;
use JDWX\Web\Auth\Routes\PublicRoute;
use JDWX\Web\Framework\Response;
use JDWX\Web\Framework\ResponseInterface;


class ExampleLoginRoute extends PublicRoute {


    private string $stError = '';

    private string $stUsername = '';


    protected function handleGET( string $i_stUri, string $i_stPath, array $i_rUriParameters ) : ?ResponseInterface {
        if ( $this->isLoggedIn() ) {
            return $this->respondAlreadyLoggedIn();
        }
        return $this->respondLoginForm();
    }


    protected function handlePOST( string $i_stUri, string $i_stPath, array $i_rUriParameters ) : ?ResponseInterface {
        $this->stUsername = $this->request()->postEx( 'username' )->asString();
        $rAuthData = [
            'password' => $this->request()->postEx( 'password' )->asString(),
        ];
        $cred = $this->tryLogin( $this->stUsername, $rAuthData );
        if ( is_string( $cred ) ) {
            $this->stError = $cred;
            return $this->handleGET( $i_stUri, $i_stPath, $i_rUriParameters );
        }
        return Response::redirectTemporaryWithGet( '/user' );
    }


    private function respondAlreadyLoggedIn() : ResponseInterface {
        $page = new ExampleHtmlPage( 'Login' );
        $page->addContent(
            '<p>You are already logged in.</p>'
            . '<p><a href="/user">Go to user page</a></p>'
        );
        return Response::page( $page );
    }


    private function respondLoginForm() : ResponseInterface {
        $page = new ExampleHtmlPage( 'Login' );
        $page->addContent(
            '<label for="error"></label> '
            . '<span id="error" style="color: red;">' . $this->stError . '</span>'
            . '<br><br>'
            . '<form method="post">'
            . '<label for="username">Username:</label> '
            . '<input type="text" id="username" name="username" required value="' . $this->stUsername . '">'
            . '<br>'
            . '<label for="password">Password:</label> '
            . '<input type="password" id="password" name="password" required>'
            . '<br>'
            . '<label for="submit"></label> '
            . '<input id="submit" type="submit" value="Login">'
            . '</form>'
        );
        return Response::page( $page );
    }


}