<?php

    //declare( strict_types = 1 );

    error_reporting(E_ALL);
    ini_set("display_errors", 1);

    require_once __DIR__ . '/Engine/autoloader.php';

    use Tk\Engine\ControllerLoader;
    use Tk\Engine\GlobalVar;
    use Tk\Engine\Parser;
    use Tk\Engine\View;

    $_global = [];

    GlobalVar::set( '_parser', new Parser() );
    GlobalVar::set( '_view', new View() );

    new ControllerLoader();
    
?>