<?php

namespace Post\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Post\Service\PostServiceInterface;

class PostListController extends AbstractActionController {

    public function __construct(PostServiceInterface $postService) {
        $this->postService = $postService;
    }

    public function indexAction() {
        return new ViewModel(array(
            'posts' => $this->postService->findAllPosts()
        ));
    }

    public function testAction() {
        $id = $this->params()->fromRoute('id');
        $data = $this->postService->findPost($id);
        return new ViewModel(array(
            'posts' => $data
        ));
    }

}
