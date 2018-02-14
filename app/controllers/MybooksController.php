<?php

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Form;
use Phalcon\Mvc\Models;
use Phalcon\Mvc\Model\Query;


class MybooksController extends ControllerBase
{


    public function indexAction()
    {
        $form = new MybooksForm();
        $this->view->form=$form;


        if ($this->request->isPost()) {
            $this->mybooksAction();
            }
        }




    public function mybooksAction()
    {
        /*
        $userId=$this->session->get("user_id");
        $books = Booksb::find(

            [
                "idUserBo = '$userId'",
                "order" => "id",
            ]
        );
        $this->view->books = $books;
        foreach ($books as $book) {
            echo $book->nameBo, "\n";
        }*/
        $user=$this->session->get("user_id");
        $mjesec = $this->request->getPost("mjesec");
        $godina = $this->request->getPost("godina");

        //$books = $this->modelsManager->executeQuery('SELECT * FROM Booksb B INNER JOIN RatingsB R on R.bookIdR = B.id   where   R.userIdR ='.$user.' order by R.ratingR desc');



        $books = $this->modelsManager->createBuilder()
            ->columns(array('Booksb.*', 'RatingsB.*'))
            ->from(array('Booksb' => 'Booksb'))
            ->leftJoin('RatingsB', 'RatingsB.BookIdR = Booksb.id', 'RatingsB')
            ->where('RatingsB.userIdR = :user: and MONTH(Booksb.dateB) = :mjesec: and YEAR(Booksb.dateB) = :godina:')
            ->orderby('RatingsB.ratingR desc')
            ->getQuery()->execute(array('user' => $user,'mjesec' => $mjesec, 'godina' => $godina));



        $this->view->books = $books;

        //var_dump($books);
        //die();

    }

}