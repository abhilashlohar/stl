<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * RequestLeaves Controller
 *
 * @property \App\Model\Table\RequestLeavesTable $RequestLeaves
 */
class RequestLeavesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Employees', 'LeaveTypes', 'Companies']
        ];
        $requestLeaves = $this->paginate($this->RequestLeaves);

        $this->set(compact('requestLeaves'));
        $this->set('_serialize', ['requestLeaves']);
    }

    /**
     * View method
     *
     * @param string|null $id Request Leave id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $requestLeave = $this->RequestLeaves->get($id, [
            'contain' => ['Employees', 'LeaveTypes', 'Companies']
        ]);

        $this->set('requestLeave', $requestLeave);
        $this->set('_serialize', ['requestLeave']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$this->viewBuilder()->layout('index_layout');
		$s_employee_id=$this->viewVars['s_employee_id'];
		$session = $this->request->session();
		$st_company_id = $session->read('st_company_id');
		$Employee = $this->RequestLeaves->Employees->get($s_employee_id);
        $requestLeave = $this->RequestLeaves->newEntity();
        if ($this->request->is('post')) {
            $requestLeave = $this->RequestLeaves->patchEntity($requestLeave, $this->request->data);
            if ($this->RequestLeaves->save($requestLeave)) {
                $this->Flash->success(__('The request leave has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The request leave could not be saved. Please, try again.'));
            }
        }
        $employees = $this->RequestLeaves->Employees->find('list');
        $leaveTypes = $this->RequestLeaves->LeaveTypes->find('list');
        $companies = $this->RequestLeaves->Companies->find('list');
        $this->set(compact('requestLeave', 'employees', 'leaveTypes', 'companies','Employee'));
        $this->set('_serialize', ['requestLeave']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Request Leave id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $requestLeave = $this->RequestLeaves->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $requestLeave = $this->RequestLeaves->patchEntity($requestLeave, $this->request->data);
            if ($this->RequestLeaves->save($requestLeave)) {
                $this->Flash->success(__('The request leave has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The request leave could not be saved. Please, try again.'));
            }
        }
        $employees = $this->RequestLeaves->Employees->find('list', ['limit' => 200]);
        $leaveTypes = $this->RequestLeaves->LeaveTypes->find('list', ['limit' => 200]);
        $companies = $this->RequestLeaves->Companies->find('list', ['limit' => 200]);
        $this->set(compact('requestLeave', 'employees', 'leaveTypes', 'companies'));
        $this->set('_serialize', ['requestLeave']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Request Leave id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $requestLeave = $this->RequestLeaves->get($id);
        if ($this->RequestLeaves->delete($requestLeave)) {
            $this->Flash->success(__('The request leave has been deleted.'));
        } else {
            $this->Flash->error(__('The request leave could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
