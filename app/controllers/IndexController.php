<?php

use Phalcon\Mvc\Controller;

class IndexController extends ControllerBase
{

	public function indexAction()
	{
       // $this->view->set("user_id", $this->session->get("user_id"));
        $this->view->user_id = $this->session->get("user_id");

        //$this->view->setTemplateAfter('header');




    }






   /* protected function initialize()
    {
       // $this->view->setTemplateAfter('header');
    } VAŽNOOO ne ide!*/

}
