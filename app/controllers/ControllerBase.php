<?php

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller {




    public function onConstruct () {

        //Base CSS
        $this->assets->addCss("assets/css/main.css");
        $this->assets->addCss("https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/base/jquery-ui.css",true);

        //Base JS
        $this->assets->addJs("assets/js/jquery.min.js");
        $this->assets->addJs("assets/js/skel.min.js");
        $this->assets->addJs("assets/js/util.js");
        $this->assets->addJs("assets/js/ie/respond.min.js");
        $this->assets->addJs("assets/js/main.js");
        $this->assets->addJs("https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js", true);
        $this->assets->addJs("https://code.jquery.com/ui/1.12.1/jquery-ui.js", true);


    }


}

