<?php
use Phalcon\Mvc\Controller;

class UserController extends ControllerBase
{
    public function removeAction()
    {
        // Remove a session variable
        $this->session->remove("user_id");

    }

    public function logoutAction()
    {
        // Destroy the whole session
        $this->session->destroy();
        $this->response->redirect('index');
        /*
        return $this->dispatcher->forward(array(
            "controller" => "index",
            "action" => "index"
        ));*/
    }
}