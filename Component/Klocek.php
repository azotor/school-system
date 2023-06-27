<?php

    namespace Tk\Component;

    use Tk\Engine\Component;

    class Klocek extends Component {

        public function render() : string {
            return '<div style="width:100px;height:100px;background-color:#f00;"></div>';
        }

    }

?>