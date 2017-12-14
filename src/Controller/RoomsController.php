<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Rooms Controller
 *
 * @property \App\Model\Table\RoomsTable $Rooms
 *
 * @method \App\Model\Entity\Room[] paginate($object = null, array $settings = [])
 */
class RoomsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $rooms = $this->paginate($this->Rooms);

        $this->set(compact('rooms'));
        $this->set('_serialize', ['rooms']);
    }

    /**
     * View method
     *
     * @param string|null $id Room id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $room = $this->Rooms->get($id, [
            'contain' => ['Showtimes']
        ]);

        $this->set('room', $room);
        $this->set('_serialize', ['room']);
        
        $lundi = strotime('monday this week');
        $mardi = strotime('+1 this week');
        $mercredi = strotime('+2 this week');
        $jeudi = strotime('+3 this week');
        $vendredi = strotime('+4 this week');
        $samedi = strotime('+5 this week');
        $dimanche = strotime('+6 this week');
        $lundisuiv = strotime('+7 this week');
        
        
        
        $query = $movie->find('Showtimes')
            ->where(['room_id'=>$id])
            ->where(['debut <='=>$lundi])
            ->where(['debut >='=>$mardi]);
        $query = $movie->find('Showtimes')
            ->where(['room_id'=>$id])
            ->where(['debut >='=>$mardi])
            ->where(['debut <'=>$mercredi]);
        $query = $movie->find('Showtimes')
            ->where(['room_id'=>$id])
            ->where(['debut <='=>$mercredi])
            ->where(['debut >='=>$jeudi]);
        $query = $movie->find('Showtimes')
            ->where(['room_id'=>$id])
            ->where(['debut <='=>$jeudi])
            ->where(['debut >='=>$vendredi]);
        $query = $movie->find('Showtimes')
            ->where(['room_id'=>$id])
            ->where(['debut <='=>$vendredi])
            ->where(['debut >='=>$samedi]);
        $query = $movie->find('Showtimes')
            ->where(['room_id'=>$id])
            ->where(['debut <='=>$samedi])
            ->where(['debut >='=>$dimanche]);
    $query = $movie->find('Showtimes')
            ->where(['room_id'=>$id])
            ->where(['debut <='=>$dimanche])
            ->where(['debut >='=>$lundisuiv]);
            
    $this->set('semaine',[0=>$lundiag,
                          1=>$mardiag,
                          2=>$mercrediag,
                          3=>$jeudiag,
                          4=>$vendrediag,
                          5=>$samediag,
                          7=>$dimancheag,
                          8=>$ludisuivag]);
                          
    $this->set('jours',[0=>'lundi'.date('d-m-Y',$lundi),
                        1=>'mardi'.date('d-m-Y',$mardi),
                        2=>'mercredi'.date('d-m-Y',$mercredi),
                        3=>'jeudi'.date('d-m-Y',$jeudi),
                        4=>'vendredi'.date('d-m-Y',$vendredi),
                        5=>'samedi'.date('d-m-Y',$samedi),
                        6=>'dimanche'.date('d-m-Y',$dimanche),
                        5=>'lundisuiv'.date('d-m-Y',$lundisuiv)]);
                        
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $room = $this->Rooms->newEntity();
        if ($this->request->is('post')) {
            $room = $this->Rooms->patchEntity($room, $this->request->getData());
            if ($this->Rooms->save($room)) {
                $this->Flash->success(__('The room has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The room could not be saved. Please, try again.'));
        }
        $this->set(compact('room'));
        $this->set('_serialize', ['room']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Room id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $room = $this->Rooms->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $room = $this->Rooms->patchEntity($room, $this->request->getData());
            if ($this->Rooms->save($room)) {
                $this->Flash->success(__('The room has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The room could not be saved. Please, try again.'));
        }
        $this->set(compact('room'));
        $this->set('_serialize', ['room']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Room id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $room = $this->Rooms->get($id);
        if ($this->Rooms->delete($room)) {
            $this->Flash->success(__('The room has been deleted.'));
        } else {
            $this->Flash->error(__('The room could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
