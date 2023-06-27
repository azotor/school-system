<?php

    namespace Tk\Config;

    define( 'PROTOCOL', strtolower( explode( '/', $_SERVER[ 'SERVER_PROTOCOL' ] )[ 0 ] ) ?? 'http' );
    define( 'SERVER_NAME', PROTOCOL . '://' . trim( $_SERVER[ 'SERVER_NAME' ], '/' ) );
    define( 'DOCUMENT_ROOT', $_SERVER[ 'DOCUMENT_ROOT' ] );

    class Path {

        const PROTOCOL = PROTOCOL;
        const SUB_DIR = '/system_szkola/';
        const SERVER = SERVER_NAME . self::SUB_DIR;
        const ROOT = DOCUMENT_ROOT . self::SUB_DIR;
        const VIEW = self::ROOT . 'View/';
        const COMPONENT = self::ROOT . 'Component/';

    }

?>