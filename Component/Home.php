<?php

    namespace Tk\Component;

    use Tk\Engine\Component;

    class Home extends Component {

        public function render() : string {
            return '<div>
                <Klocek />
            </div>';
        }

    }

?>