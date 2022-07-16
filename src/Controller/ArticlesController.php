<?php

    namespace App\Controller;

    class ArticlesController extends AppController{

        var $uses = array('Comments', 'Articles');

        public $components = ['Flash'];



        public function index(){

            $comments2 = $this->loadModel('Comments');

            $articles = $this->Articles->find('all');
            $this->set(compact('articles'));

            $comm = $comments2->find('all');
            $this->set(compact('comm'));

            $comment = $comments2->newEntity();

            if ($this->request->is('post')) {

                //$datos = $this->request->getData();
                //debug($datos);                

                $comment = $comments2->patchEntity($comment, $this->request->getData());
                //debug($comment);
                //die();
                if ($comments2->save($comment)) {          

                    $this->Flash->success(__('Su comentario ah sido guardado.'));
                    return $this->redirect(['action' => 'index']);
                    
                }else{
                    $this->Flash->error(__('No se pudo agregar el comentario.'));
                }
            }
            $this->set('comment', $comment);

        }

        public function view($id = null){

            $article = $this->Articles->get($id);
            $this->set(compact('article'));
            
        }

        public function add(){

            $article = $this->Articles->newEntity();
           
            if ($this->request->is('post')) {

                $article = $this->Articles->patchEntity($article, $this->request->getData());
                if ($this->Articles->save($article)) {

                    $this->Flash->success(__('Su articulo a sido guardado.'));
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('Unable to add your article.'));
            }
            $this->set('article', $article);
        }

        public function edit($id = null){

            $article = $this->Articles->get($id);

            if ($this->request->is(['post', 'put'])) {

                $this->Articles->patchEntity($article, $this->request->getData());

                if ($this->Articles->save($article)) {

                    $this->Flash->success(__('Tu artículo ha sido actualizado.'));
                    return $this->redirect(['action' => 'index']);
                }

                $this->Flash->error(__('Tu artículo no se ha podido actualizar.'));
            }

            $this->set('article', $article);

        }


        public function delete($id){

            $this->request->allowMethod(['post', 'delete']);

            $article = $this->Articles->get($id);

            if ($this->Articles->delete($article)) {

                $this->Flash->success(__('El artículo con id: {0} ha sido eliminado.', h($id)));
                return $this->redirect(['action' => 'index']);
            }
        }
    }

?>