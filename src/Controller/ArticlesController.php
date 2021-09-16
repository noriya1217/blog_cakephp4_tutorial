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

        $categories = $this->Articles->Categories->find('treeList');
        $this->set(compact('categories'));
    }


    public function edit($id = null) {
        $article = $this->Articles->get($id);
        if ($this->request->is(['post', 'put'])) {
            $this->Articles->patchEntity($article, $this->request->getData());
            if($this->Articles->save($article)) {
                $this->Flash->success(__('記事が更新されました。'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('記事の更新が出来ませんでした。'));
        }

        $this->set('article', $article);
    }


    public function delete($id) {
        $this->request->allowMethod(['post', 'delete']);

        $article = $this->Articles->get($id);
        if ($this->Articles->delete($article)) {
            $this->Flash->success(__('ID：{0}の記事が削除されました。', h($id)));
            return $this->redirect(['action' => 'index']);
        }
    }

}
