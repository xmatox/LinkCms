<?php
class UsersController extends AppController {
	public $helpers = array('Js');

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('add','admin_user'); // Letting users register themselves
	}

	function admin_user() {
		
		if ($this->Auth->login()) {
			if(Configure::read('Parameter.production'))
				$this->redirect("/");
			else
				$this->redirect("/p/1");
		} else {
			$this->Session->setFlash(__('Invalid username or password, try again'));
		}
	}
	public function admin_login() {
		if ($this->Auth->login()) {
			//$this->redirect($this->Auth->redirect());
			if(Configure::read('Parameter.production'))
				$this->redirect("/");
			else
				$this->redirect("/p/1");
		} else {
			$this->Session->setFlash(__('Invalid username or password, try again'));
		}
	}

	public function admin_logout() {
		$this->redirect($this->Auth->logout());
	}

	function admin_index($id = null) {
		if(!$id){
			$c = $this->User->find("all");
		}else{
			$c = $this->User->find("all", array(
				"conditions" => "User.group_id=$id"
			));
		}
		$this->set('users', $c);
	}
	function admin_list($id = null) {
		if(!$id){
			$c = $this->User->find("all");
		}else{
			$c = $this->User->find("all", array(
				"conditions" => "User.group_id=$id"
			));
		}
		$this->set('users', $c);
	}

	function admin_edit($id = null) {
		if (!empty($this->data)) {
			$this->User->create();
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The user has been saved', true));
				$this->redirect(array('action' => 'list'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
			}
		}
		
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
			unset($this->request->data['User']['password']);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for user', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->User->delete($id)) {
			$this->Session->setFlash(__('User deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('User was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
