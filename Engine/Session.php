<?php

    namespace Tk\Engine;

    class Session {

        public static function start() : void { session_start(); }

        public static function destroy() : void { session_destroy(); }

        public static function set( string $_name, string $_value ) : void { $_SESSION[ $_name ] = $_value; }

        public static function get( string $_name ) { return ( key_exists( $_name, $_SESSION ) ) ? $_SESSION[ $_name ] : false; }

        public static function remove( string $_name ) : void { unset( $_SESSION[ $_name ] ); }

    }

?>