<?php
App::uses('AppController', 'Controller');
App::uses('CakeLog', 'Log');
Configure::write('debug', 0);
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {

/**
 * Helpers
 *
 * @var array
 */
	public $helpers = array('Js');


    public function beforeFilter(){
        parent::beforeFilter();
        $this->Auth->allow('add','getcall','forwarder','gram','test');
    }


/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}

    /**
     * add method
     *
     * @return void
     */
	public function add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'));
				//return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}
	}

	public function getcall() {
		$this->layout = '';
		$this->autoRender = false;
header("content-type: text/xml");
echo '<?xml version="1.0" encoding="UTF-8"?>';
echo <<< EOL
<Response>
	<Gather action="/users/forwarder" numDigits="2">
	<Say language="ja-jp">内線番号を入力してください</Say>
	</Gather>
	<Record maxLength="60" action="/users/forwarder" />
</Response>
EOL;
	    die;
	}

	public function forwarder() {
		$this->layout = '';
		$this->autoRender = false;
	    header("content-type: text/xml");
	    echo '<?xml version="1.0" encoding="UTF-8"?>';
		$options = array('conditions' => array('User.phoneno' => $_REQUEST['CalledVia']));
		$findUser = $this->User->find('first', $options);
        $depyomi = '';
        $empyomi = '';
        $phoneno = null;

		if(count($findUser) == 0){
			print '<Response><Say language="ja-jp">この電話番号は、利用登録されていません</Say></Response>';
		}
		else{

			$user_pushed = (int) $_REQUEST['Digits'];
			$this->log($user_pushed);
			$findUser = $findUser['User'];

			if(isset($_REQUEST['Digits']) && $_REQUEST['Digits'] != '' && $_REQUEST['Digits'] != '#') {
				$this->loadModel('Department');
				$this->loadModel('Employee');
				
				$options = array('conditions' => array('Department.user_id'=> $findUser['id']));
				$departments = $this->Department->find('list',$options);

				$options = array('conditions' => array('Employee.foword_no'=> $_REQUEST['Digits']));
				$employees = $this->Employee->find('first',$options);
				
				$depyomi = $departments[$employees['Employee']['department_id']].'の';
				$empyomi = explode(',',$employees['Employee']['first_name']);
				$empyomi = $empyomi[0];
				$phoneno = $employees['Employee']['phone_no'];

			}
			else {
//				$buff = file_get_contents($_REQUEST['RecordingUrl']);
//				// 録音データ・営業本部佐藤
//				//$buff = file_get_contents('http://api.twilio.com/2010-04-01/Accounts/AC81fcd98c1e2c0840832685e3de0a6444/Recordings/REd7914a3d4bd03de0c50fef65952a1c3e');
//				$amiVoice = new AmiDSRHTTP('http://asr3.amivoice.com:24500/recognize','http://'.$_SERVER['SERVER_NAME'].'/gram/'.$findUser['id'].'.gram');
//				// 肩書と名前が返ってくる
//				$result = $amiVoice->speechRecognition($buff);
//				$this->loadModel('Department');
//				$this->loadModel('Employee');
//				$options = array('conditions' => array('Department.id'=> $result[0]));
//				$departments = $this->Department->find('first',$options);
//				$depyomi = explode(',',$departments['Department']['yomi']);
//
//				$options = array('conditions' => array('Employee.id'=> $result[1]));
//				$employees = $this->Employee->find('first',$options);
//				$empyomi = explode(',',$employees['Employee']['first_name']);
//				$phoneno = $employees['Employee']['phone_no'];
//
//				if(isset($depyomi[0]) && $depyomi[0] != '') {
//					$depyomi = $depyomi[0].'の' ;
//				}
//				else {
//					$depyomi = '';
//				}
//				$empyomi = $empyomi[0];
			}


			print '<Response>';
			print '<Say language="ja-jp">'.$depyomi.$empyomi.' に、電話をおつなぎします。</Say>';
			print '<Dial callerId="+81 50-3159-7408">+'.$phoneno.'</Dial>';
			print '</Response>';
		}

//		if($result === false){
//			print "<Response><Say language=\"ja-jp\">もう一度、部署めいと名前を発話し、シャープを押してください</Say><Record maxLength=\"30\" action=\"recorded.php\" /></Response>";
//		}
	}

	public function test () {
//		$this->layout = '';
//		$this->autoRender = false;
//
//		$this->loadModel('Department');
//		$this->loadModel('Employee');
//
//		$options = array('conditions' => array('Employee.foword_no'=> '11'));
//        $departments = $this->Department->find('list',$options);
//		$employees = $this->Employee->find('first',$options);
//
//		$depyomi = $departments[$employees['Employee']['department_id']];
////		$empyomi = explode(',',$employees['Employee']['first_name']);
//print_r($depyomi);
//				die;
//
//		$buff = file_get_contents('http://api.twilio.com/2010-04-01/Accounts/AC81fcd98c1e2c0840832685e3de0a6444/Recordings/REd7914a3d4bd03de0c50fef65952a1c3e');
//		$amiVoice = new AmiDSRHTTP('http://asr3.amivoice.com:24500/recognize','http://'.$_SERVER['SERVER_NAME'].'/gram/'.$user_id.'.gram');
//		// $amiVoice = new AmiDSRHTTP("http://asr3.amivoice.com:24500/recognize","http://180.235.252.33/twilio/20140326/a_sasaki/dialer/dialer.gram");
//
//		$result = $amiVoice->speechRecognition($buff);
//
//		$this->loadModel('Department');
//		$this->loadModel('Employee');
//		$options = array('conditions' => array('Department.id'=> $result[0]));
//		$departments = $this->Department->find('first',$options);
//
//		$options = array('conditions' => array('Employee.id'=> $result[1]));
//		$employees = $this->Employee->find('first',$options);
//
//		$depyomi = explode(',',$departments['Department']['yomi']);
//		$empyomi = explode(',',$employees['Employee']['first_name']);
//		print_r($depyomi[0]);
//		print_r($empyomi[0]);
	}

	public function gram($user_id) {
		$this->layout = '';
		$this->autoRender = false;

  		$file_name = '/canvases/cci3c1v/data/axc/app/webroot/gram/'.$user_id.'.gram';

		$gram = array();

		$gram[] = '# JSGF V1.0 UTF-8;';
		$gram[] = 'grammar dialer;';
		// 全部署取得
		// 部署所属ユーザ取得

		$this->loadModel('Department');
		$this->loadModel('Employee');

		
		$options = array('conditions' => array('Department.user_id' => $user_id));
		$departments = $this->Department->find('all', $options);

		$gramparts = array();
		foreach ($departments as $value) {
			$department = $value['Department'];
			$gramparts[] = ' <dep'.$department['id'].'> ';
		}

		$gram[] = 'public <dialer> = ('.implode('|', $gramparts).') [さん|くん|さま];';
		$gram[] = '';

		foreach ($departments as $value) {
			$department = $value['Department'];
		
			$options = array('conditions' => array(
				'Employee.department_id' => $department['id'],
				'Employee.user_id' => $user_id
			));
			$employees = $this->Employee->find('all', $options);
			$gramparts_last = array();
//			$gramparts_first = array();
			foreach ($employees as $employees_value) {
				$employee = $employees_value['Employee'];
				$gramparts_last[] = ' '.$employee['id'].' ';
			}
			$gram[] = '<dep'.$department['id'].'> = '.$department['id'].' [の] ('.implode('|', $gramparts_last).');';
		}
		$gram[] = '';

		foreach ($departments as $value) {
			$department = $value['Department'];

			$dep_yomi = explode(',', $department['yomi']);
			foreach ($dep_yomi as $yomi) {
				$gram[] = '//addWord '.$department['id'].' '.$yomi;
			}
		}
		$gram[] = '';

		foreach ($departments as $value) {
			$department = $value['Department'];

			$options = array('conditions' => array(
				'Employee.department_id' => $department['id'],
				'Employee.user_id' => $user_id
			));
			$employees = $this->Employee->find('all', $options);
//			$gramparts_last = array();
//			$gramparts_first = array();
			foreach ($employees as $employees_value) {
				$employee = $employees_value['Employee'];
				$namae_yomi = explode(',', $employee['first_name']);
				foreach ($namae_yomi as $yomi) {
					$gram[] = '//addWord '.$employee['id'].' '.$yomi;
				}
			}
		}

		if(file_exists($file_name)) {
			unlink($file_name);
		}

    	touch( $file_name);
		$handle = fopen($file_name, 'w');
		foreach ($gram as $value) {
			fwrite($handle, mb_convert_encoding($value."\r\n",'UTF-8'));
		}
		fclose($handle);
		return;
	}
    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
	public function edit($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'));
//				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
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
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->User->delete()) {
			$this->Session->setFlash(__('The user has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user could not be deleted. Please, try again.'));
		}
//		return $this->redirect(array('action' => 'index'));
	}
}
