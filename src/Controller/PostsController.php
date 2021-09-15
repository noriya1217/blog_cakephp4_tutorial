<?php

namespace App\Controller;

class PostsController extends AppController {
    public function index(){
        $posts = $this->Posts->find('all');
    }

    public function view() {
        $this->set(compact(['id']));
    }
}

?>