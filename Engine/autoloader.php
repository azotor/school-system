<?php

    function AutoLoader( string $_className ) : void {
        
        $fileName = substr( str_replace( '\\', '/', $_className ), strlen( 'Tk/' ) ) . '.php';

        if( file_exists( $fileName ) )
            require_once $fileName;

    }

    spl_autoload_register( 'AutoLoader' );

?>