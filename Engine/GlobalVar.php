<?php

    namespace Tk\Engine;

    class GlobalVar {

        public static function get( string $_name ) {

            global $_global;

            return array_key_exists( $_name, $_global ) ? $_global[ $_name ] : null;

        }

        public static function set( string $_name, $_value ) : void {

            global $_global;

            $_global[ $_name ] = $_value;

        }

        public static function add(string $_name, $_value ) : void {

            global $_global;

            if( key_exists( $_name, $_global ) ) $_global[ $_name ] = array_merge( $_global[ $_name ], $_value );
            else $_global[ $_name ] = $_value;

        }

    }

?>