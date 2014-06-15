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

        if ($this->request->is(array('post', 'put'))) {
            $this->request->data['Option']['user_id'] = $this->Auth->user('id');
            if ($this->Option->save($this->request->data)) {
                $this->Session->setFlash(__('The Option has been saved.'));
//                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The Option could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Option.user_id' => $this->Auth->user('id')));
            $this->request->data = $this->Option->find('first', $options);
        }
	}
}
