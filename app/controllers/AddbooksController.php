<?php

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Form;
use Phalcon\Mvc\Models;


class AddbooksController extends ControllerBase
{


    public function indexAction()
    {
        $auto1 = "";
        $form = new AddbooksForm();
        $this->view->form = $form;

        //echo $this->session->get("user_id");
        $nameBo = $this->request->getPost("nameBo");
        $authorBo = $this->request->getPost("authorBo");
        $descriptionBo = $this->request->getPost("descriptionBo");

        $dateB = $this->request->getPost("dateB");

        $auto = Booksb::find(array(

            'columns' => 'nameBo'
        ));

        foreach ($auto as $row) {
            $auto1 = $auto1 . "'$row->nameBo',";
        }

        //$form->bind($_POST, $nameBo);
 /*       echo '<script>
    $(document).ready(function() {
        $("#nameBo").autocomplete({
            source: [
                 ' . $auto1 . '
            ],
            minLength: 1
        });
    });
</script>';
*/
        $this->view->auto1 = $auto1;

        $checkb = Booksb::findFirst("nameBo = '$nameBo'");


        if ($checkb <> null) {
            $this->flashSession->error("Ova knjiga je već dodana!");
        } else if ($this->request->isPost()) {

            if (!$form->isValid($this->request->getPost())) {

                // If the form failed validation, add the errors to the flash error message.
                foreach ($form->getMessages() as $message) {
                    $this->flashSession->error($message->getMessage());

                }


            } else {
                $this->addbooksAction();
            }
        }
    }


    public function addbooksAction()
    {

        $book = new Booksb();
        $success = $book->save(
            $this->request->getPost(),
            array('nameBo', 'authorBo', 'descriptionBo', 'idUserBo', 'dateB')
        );

        $books = Booksb::find();
        $id = $books->getLast()->id;
        $ratingR = $this->request->getPost("ratingR");
        $rating = new RatingsB();
        $idUserBo = $this->request->getPost("idUserBo");


        $success1 = $rating->save(
            [
                "userIdR" => $idUserBo,
                "ratingR" => $ratingR,
                "bookIdR" => $id,
            ]
        );

        if ($success and $success1) {
            $this->flashSession->error("Uspješno ste dodali knjigu!");
            return $this->response->redirect('index');
        } else {
            echo "Nešto nije ok: ";
            foreach ($book->getMessages() as $message) {
                echo $message->getMessage(), "<br/>";
            }
        }

    }

}