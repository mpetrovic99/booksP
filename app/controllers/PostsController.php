<?php

use Phalcon\Mvc\Controller;

class PostsController extends ControllerBase
{
    public function indexAction()
    {

    }

    public function showAction($postId)
    {
        // Pass the $postId parameter to the view
        $this->view->postId = $postId;
    }
}