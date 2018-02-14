<?php

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Form;
use Phalcon\Mvc\Models;
use Phalcon\Mvc\Model\Query;


class GroupsController extends ControllerBase
{


    public function indexAction()
    {
        $form = new GroupsForm();
        $this->view->form=$form;


        if ($this->request->isPost()) {
            $this->groupsAction();
        }
    }




    public function groupsAction()
    {
        $user=$this->session->get("user_id");
        $mjesec = $this->request->getPost("mjesec");
        $godina = $this->request->getPost("godina");
        $group = $this->request->getPost("grupa");

        //$books = $this->modelsManager->executeQuery('SELECT * FROM Booksb B INNER JOIN RatingsB R on R.bookIdR = B.id   where   R.userIdR ='.$user.' order by R.ratingR desc');




        $books = $this->modelsManager->createBuilder()

            ->columns(array('Booksb.*', 'RatingsB.*', 'Usersb.*'))
            ->from(array('Booksb' => 'Booksb'))
            ->from(array('Usersb' => 'Usersb'))
            ->leftJoin('Booksb', 'Booksb.idUserBo = Usersb.id ', 'Booksb')
            ->leftJoin('RatingsB', 'RatingsB.BookIdR = Booksb.id', 'RatingsB')
            ->where('RatingsB.userIdR = :user: and MONTH(Booksb.dateB) = :mjesec: and YEAR(Booksb.dateB) = :godina: and Usersb.groupId = :group:')
            ->orderby('RatingsB.ratingR desc')
            ->getQuery()->execute(array('user' => $user,'mjesec' => $mjesec, 'godina' => $godina, 'group' => $group));
        //var_dump($books->getmysql());die();






        $this->view->books = $books;

        //var_dump($books);
        //die();

    }

}