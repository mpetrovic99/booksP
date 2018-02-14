<?php

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Form;
use Phalcon\Mvc\Models;

class SignupController extends ControllerBase
{

	public function indexAction()
	{

        $form = new SignupForm();
        $this->view->form=$form;

        $groupsnames = Groupsb::find(array(

            'columns' => 'id, nameG'
        ));
        $groupId=[];
        $usert = $this->request->getPost("username");
        $emailt = $this->request->getPost("email");
        $checku = Usersb::findFirst("username = '$usert'");
        $checke = Usersb::findFirst("email = '$emailt'");
        foreach ($groupsnames as $row) {
            //echo "'$row->id'"." =>".  "'$row->nameG',";
            $groupId[$row->id]=$row->nameG;
        }
        $this->form->groupId = $groupId;
        $form->bind($_POST, $groupId);


        if($this->request->isPost()) {
            if (!$form->isValid($this->request->getPost())) {

                // If the form failed validation, add the errors to the flash error message.
                foreach ($form->getMessages() as $message) {
                    $this->flashSession->error($message->getMessage());

                }
                //return $this->response->redirect('signup');
            }


            //$testu=$robot->username;
            else if($checku<>null){
                $this->flashSession->error("Iskorišteno korisničko ime!");
                //return $this->response->redirect('signup');
            }

            else if($checke<>null){
                $this->flashSession->error("Iskorišten e-mail!");
                //return $this->response->redirect('signup');
            }




            else {
                $this->registerFun();
            }
        }
	}




	public function registerFun()
	{



        //$form = new SignupForm();
        // Validate the form data posted




	    $user = new Usersb();



		// Store and check for errors
		$success = $user->save(
			$this->request->getPost(),
			array('username', 'name', 'surname', 'email', 'password', 'groupId' )
		);

		if ($success) {
			//echo "Uspješno ste se registrirali!";
            //echo $this->tag->linkTo("index", "Home");
            $this->flashSession->error("Uspješna registracija!");
            return $this->response->redirect('index');
		} else {
			echo "Niste upisali sve podatke: ";
			foreach ($user->getMessages() as $message) {
				echo $message->getMessage(), "<br/>";
			}
		}



	}

}
