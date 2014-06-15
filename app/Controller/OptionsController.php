<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class OptionsController extends AppController {

/**
 * Components
 *
 * @var array
 */
    public $uses = Array('User');

	public function index() {

		$this->loadModel('Option');

		$options = array('conditions' => array('Option.user_id' => $this->Auth->user('id')));
		$finduser = $this->Option->find('all', $options);

		$this->set('usercount',count($finduser));
	}
}
