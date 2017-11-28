<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Showtime Controller
 *
 *
 * @method \App\Model\Entity\Showtime[] paginate($object = null, array $settings = [])
 */
class ShowtimeController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $showtime = $this->paginate($this->Showtime);

        $this->set(compact('showtime'));
        $this->set('_serialize', ['showtime']);
    }

    /**
     * View method
     *
     * @param string|null $id Showtime id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $showtime = $this->Showtime->get($id, [
            'contain' => []
        ]);

        $this->set('showtime', $showtime);
        $this->set('_serialize', ['showtime']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $showtime = $this->Showtime->newEntity();
        if ($this->request->is('post')) {
            $showtime = $this->Showtime->patchEntity($showtime, $this->request->getData());
            if ($this->Showtime->save($showtime)) {
                $this->Flash->success(__('The showtime has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The showtime could not be saved. Please, try again.'));
        }
        $this->set(compact('showtime'));
        $this->set('_serialize', ['showtime']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Showtime id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $showtime = $this->Showtime->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $showtime = $this->Showtime->patchEntity($showtime, $this->request->getData());
            if ($this->Showtime->save($showtime)) {
                $this->Flash->success(__('The showtime has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The showtime could not be saved. Please, try again.'));
        }
        $this->set(compact('showtime'));
        $this->set('_serialize', ['showtime']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Showtime id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $showtime = $this->Showtime->get($id);
        if ($this->Showtime->delete($showtime)) {
            $this->Flash->success(__('The showtime has been deleted.'));
        } else {
            $this->Flash->error(__('The showtime could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
