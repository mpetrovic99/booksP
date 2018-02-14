<?php

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Form;
use Phalcon\Mvc\Models;
use Phalcon\Mvc\Model\Query;





class InviteController extends ControllerBase
{


    public function indexAction()
    {

        $form = new InviteForm();
        $this->view->form=$form;
        if($this->request->getPost('pozovi')<>null) {
            $emailt = $this->request->getPost("email");
            $checke = Usersb::findFirst("email = '$emailt'");

                if (!$form->isValid($this->request->getPost())) {

                    // If the form failed validation, add the errors to the flash error message.
                    foreach ($form->getMessages() as $message) {
                        $this->flashSession->error($message->getMessage());

                    }
                    //return $this->response->redirect('signup');
                }
                else if ($checke <> null) {
                $this->flashSession->error("Ovaj korisnik je već registriran!");
            }else{
                    $this->sendEmail();
                }
        }


        $form1 = new AddgroupsForm();
        $this->view->fa=$form1;

        if($this->request->getPost('dodaj')) {

            $groupt = $this->request->getPost("nameG");
            $checke1 = Groupsb::findFirst("nameG = '$groupt'");

                if (!$form1->isValid($this->request->getPost())) {

                    // If the form failed validation, add the errors to the flash error message.
                    foreach ($form1->getMessages() as $message1) {
                        $this->flashSession->error($message1->getMessage());

                    }

                }else if ($checke1 <> null) {
                        $this->flashSession->error("Grupa pod ovim nazivom već postoji!");
                    }
                    else{
                        $this->addGroup();
                }
        }
    }

    public function sendEmail()
    {
        $email = $this->request->getPost('email');

        $transport = (new Swift_SmtpTransport($this->getDI()->get('emailEmail'), $this->getDI()->get('emailPort'), $this->getDI()->get('emailHost')))
            ->setUsername($this->getDI()->get('emailUsername'))
            ->setPassword($this->getDI()->get('emailPass'))
        ;

        // Create the Mailer using your created Transport
        $mailer = new Swift_Mailer($transport);

        // Create a message
        $message = (new Swift_Message('Pozivnica za Hexis Knjigu'))
            ->setFrom(['mariopetrovic99999@gmail.com' => 'Hexis Knjiga'])
            ->setTo([$email])
            ->setBody("'Dobili ste pozivnicu za korištenje \"Moje knjige! Besplatno se registrirajte. link: grupa: '.$groupt.'\"'"
            );
        // Send the message
        $result = $mailer->send($message);
        return $result;


    }


    public function addGroup()
    {

        $group = new Groupsb();

        // Store and check for errors
        $success = $group->save(
            $this->request->getPost(),
            array('nameG')
        );

        if ($success) {
            $this->flashSession->error("Uspješno ste dodali grupu!");
            // return $this->response->redirect('index');
        } else {
            echo "Niste upisali sve podatke: ";
            foreach ($user->getMessages() as $message) {
                echo $message->getMessage(), "<br/>";
            }
        }

    }




}