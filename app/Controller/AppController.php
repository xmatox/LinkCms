<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	public $components = array(
        'Session',
        'Formate',
        'Ipcountry',
        'Auth' => array(
            'loginRedirect' => array('controller' => 'rubriques', 'action' => 'list', 'admin' => true),
            'logoutRedirect' => array('controller' => 'rubriques', 'action' => 'view',1, 'admin' => false)
        )
    );
	
    function beforeFilter() {
		// meta par defaut
		/*$this->set('title_for_layout', "");
		$this->set('metadesc_for_layout', "");
		$this->set('metakey_for_layout', "");*/
        //$this->Auth->allow('edit', 'index');
        //
		if(!Configure::read('Parameter')){
			$this->loadModel('Parametre');
			$DataParams = $this->Parametre->liste();
			Configure::write('Parameter', $DataParams);
		}
		//
		$this->set('_prefix', "cms_");
		if(isset($this->params['prefix']) && $this->params['prefix'] == 'admin'){
			//$this->layout = 'admin_default';
			$this->layout = 'admin_user';
			//
			$this->loadModel('Catadmin');
			$catM = $this->Catadmin->getCat(0);
			$this->set('catM', $catM);
		}else if((strtolower($this->params['controller'])=="graphelements" && strtolower($this->params['action'])=="css") || (strtolower($this->params['controller'])=="styles" && strtolower($this->params['action'])=="cssgeneral")){
			$this->layout = 'css';
			$this->Auth->allow($this->action);
		}else if(!Configure::read('Parameter.production') && !$this->params->url){
			$this->layout = 'construction';
			$this->Auth->allow($this->action);
		}else{
			$this->layout = 'default';
			$this->Auth->allow($this->action);

		}
		
		//
		if(!Configure::read('Config.languages')){
			$this->loadModel('Language');
			if(isset($this->params['prefix']) && $this->params['prefix'] == 'admin'){
				$DataLang = $this->Language->listeadmin();
			}else{
				$DataLang = $this->Language->liste();
			}
			
			Configure::write('Config.languages',$DataLang);
		}
		if(strtolower($this->params['controller'])!="languages" && strtolower($this->params['action'])!="nlg"){
			if(isset($this->params['language'])){
				if(in_array($this->params['language'],Configure::read('Config.languages'))){
					$this->Session->write('User.language',$this->params['language']);
					$this->redirect(array('controller'=>$this->params['controller'],'action'=>$this->params['action'])+$this->params['pass']);
					
				}
			}
		}
		//
		if(!$this->Session->read('User.language')){
			//$ipcountry = $this->Ipcountry->getCountry();
			$ipcountry = $this->Ipcountry->getDomaine();
			if($ipcountry=="default"){
				$this->Session->write('User.language',Configure::read('Parameter.langue'));
				Configure::write('Config.language',Configure::read('Parameter.langue'));
			}else{
				$this->Session->write('User.language',$ipcountry);
				Configure::write('Config.language',$ipcountry);
			}
		}else{
			Configure::write('Config.language',$this->Session->read('User.language'));
		}
		
		//
		if(strtolower($this->params['controller'])=="rubriques" && strtolower($this->params['action'])=="view"){
			Configure::write('Page.id',$this->params['pass'][0]);
		}
    }

}
