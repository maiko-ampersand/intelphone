<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
    public $uses = Array('User');
    public $components = Array(
        'Session',
        'Auth' => Array(
            'loginRedirect' => Array('controller'  => 'mypage', 'action' => 'index'),
            'logoutRedirect' => Array('controller' => 'login', 'action' => 'index'),
            'loginAction' => Array('controller' => 'login', 'action' => 'index'),
            'authenticate' => Array('Form' => Array('fields' => Array('username' => 'phoneno')))
        )
    );


	public function beforeFilter(){
	    parent::beforeFilter();
        if($this->Auth->loggedIn()) {
            $this->Auth->allow('display', 'index');
            $user = $this->User->find('first', array(
                'conditions' => array('id' => $this->Auth->user('id'))
            ));
            $user = $user['User'];
            $this->set('user',$user);
        }
        // else {
        //     return $this->redirect($this->Auth->loginAction);   
        // }
	}
}
