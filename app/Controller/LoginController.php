<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class LoginController extends AppController {

/**
 * Components
 *
 * @var array
 */
    public $uses = Array('User');

	public function index() {

        $this->layout = '';
        if($this->request->is('post')) {
            if($this->Auth->login()) {
                return $this->redirect($this->Auth->loginRedirect);
            } else {
                $this->Session->setFlash(__('Username or password is incorrect'), 'default', array(), 'auth');
            }
        }
	}

    public function logout($id = null){
        $this->Auth->logout();
        $this->redirect($this->Auth->logout());
    }

    public function beforeFilter() {
        $this->Auth->allow('login');
    }
}
