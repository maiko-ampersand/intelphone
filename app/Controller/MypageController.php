<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class MypageController extends AppController {

/**
 * Components
 *
 * @var array
 */
    public $uses = Array('User');

	public function index() {

		$this->loadModel('Employees');

		$options = array('conditions' => array('Employees.user_id' => $this->Auth->user('id')));
		$finduser = $this->Employees->find('all', $options);

		$this->set('usercount',count($finduser));
	}
}
