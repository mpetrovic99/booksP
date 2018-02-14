<?php

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Form;
use Phalcon\Mvc\Models;


class LoginController extends ControllerBase
{

    public function indexAction()
    {
        $form = new LoginForm();
        $this->view->form=$form;




        if ($this->request->isPost()) {

            // Validate the form data posted
            if (!$form->isValid($this->request->getPost())) {

                // If the form failed validation, add the errors to the flash error message.
                foreach ($form->getMessages() as $message) {
                    $this->flashSession->error($message->getMessage());

                }
                //return $this->response->redirect('login');
            } else {


                $this->loginFun();

            }
        }


    }


    public function loginFun()
    {

        $password = $this->request->getPost("password");
                $username = $this->request->getPost("username");
                $user = Usersb::findByUsername($username)->getFirst();
                $login = Usersb::findFirst("username = '$username' and password='$password'");
                if ($login <> null) {

                    //echo $user->id;
                    //$test = $this->session->set("user_id", $user->id);
                    $this->session->set("user_id", $user->id);
                    $this->response->redirect('index');
                    //echo $test;
                } else {
                    $this->flashSession->error("Neispravno korisničko ime i/ili lozinka!");
                }
            }
}