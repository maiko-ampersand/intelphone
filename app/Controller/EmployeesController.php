<?php
App::uses('AppController', 'Controller');
/**
 * Employees Controller
 *
 * @property Employee $Employee
 * @property PaginatorComponent $Paginator
 * @property SecurityComponent $Security
 */
class EmployeesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Security', 'Auth');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->loadModel('Department');
		$this->Employee->recursive = 0;
		$data = $this->Employee->find(
		    'all',
		    array('user_id' => $this->Auth->user('id'))
		);
	    $this->Paginator->settings = array(
	        'conditions' => array('user_id' => $this->Auth->user('id')),
	    );
		$this->set('employees', $this->Paginator->paginate());


		$departments = $this->Department->find('list');
		$this->set(compact('departments'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Employee->exists($id)) {
			throw new NotFoundException(__('Invalid employee'));
		}
		$options = array('conditions' => array('Employee.' . $this->Employee->primaryKey => $id));
		$this->set('employee', $this->Employee->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->request->data['Employee']['user_id'] = $this->Auth->user('id');
			$this->Employee->create();
			if ($this->Employee->save($this->request->data)) {
				$this->Session->setFlash(__('The employee has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The employee could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Employee->exists($id)) {
			throw new NotFoundException(__('Invalid employee'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$this->request->data['Employee']['user_id'] = $this->Auth->user('id');
			if ($this->Employee->save($this->request->data)) {
				$this->Session->setFlash(__('The employee has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The employee could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Employee.' . $this->Employee->primaryKey => $id));
			$this->request->data = $this->Employee->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Employee->id = $id;
		if (!$this->Employee->exists()) {
			throw new NotFoundException(__('Invalid employee'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Employee->delete()) {
			$this->Session->setFlash(__('The employee has been deleted.'));
		} else {
			$this->Session->setFlash(__('The employee could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function beforeFilter() {
		$this->loadModel('Department');
		$options = array('conditions' => array('Department.user_id'=> $this->Auth->user('id')));
		$departments = $this->Department->find('list',$options);
		$this->set(compact('departments'));
	}
}
