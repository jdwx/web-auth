<?php


declare( strict_types = 1 );


trait ExampleRouteTrait {


    public function nav() : string {
        $st = '<nav>';
        foreach ( self::ROUTES as $stName => $stPath ) {
            $st .= '<a href="' . $stPath . '">' . $stName . '</a>';
        }
        $st .= '</nav>';
        return $st;
    }


}