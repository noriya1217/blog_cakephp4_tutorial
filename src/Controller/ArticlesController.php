<?php
declare(strict_types=1);

namespace App\Controller;

use App\Controller\AppController;

/**
 * Articles Controller
 *
 * @property \App\Model\Table\ArticlesTable $Articles
 * @method \App\Model\Entity\Article[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ArticlesController extends AppController {

    public function initialize(): void {
        parent::initialize();
        $this->loadComponent('Flash');
    }

    public function index(){
        $articles = $this->Articles->find('all');
        $this->set(compact('articles'));
    }


    public function view($id = null){
        $article = $this->Articles->get($id);
        $this->set(compact('article'));
    }


    public function add() {
        $article = $this->Articles->newEmptyEntity();
        if($this->request->is('post')) {
            $article = $this->Articles->patchEntity($article, $this->request->getData());
            if($this->Articles->save($article)) {
                $this->Flash->success(__('記事が保存されました'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('記事の保存ができませんでした'));
        }
        $this->set('article', $article);
    }

}
