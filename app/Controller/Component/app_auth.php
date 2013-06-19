<?php
App::import('Component', 'Auth');
 
class AppAuthComponent extends AuthComponent
{
	/**
	 * Configuration par défaut
	 *
	 * @var array
	 */
	var $defaults = array(
		'userModel'      => 'User',
		'userScope'      => array(),
		'fields'         => null,
		'loginAction'    => null,
		'loginRedirect'  => null,
		'logoutRedirect' => null,
		'autoRedirect'   => true,
		'loginError'     => "Identifiant ou mot de passe incorrects.",
		'authError'      => "Vous devez vous identifier pour acc&eacute;der &agrave; cette page.",
		'flashElement'   => 'default',
	);
 
	/**
	 * Configurations possibles en fonction du préfixe de la route
	 *
	 * @var array
	 */
	var $configs = array(
		'admin' => array(
			'userModel'      => 'User',
			//'userScope'      => array('User.disabled' => 0),
			'fields'         => array('username' => 'login', 'password' => 'pass'),
			//'fields'         => array('username' => 'username', 'password' => 'password'),
			'loginAction'    => array('controller' => 'users', 'action' => 'login', 'admin' => true),
			'loginRedirect'  => array('controller' => 'evenements', 'action' => 'list', 'admin' => true),
			'logoutRedirect' => array('controller' => 'users', 'action' => 'login', 'admin' => true),
			//'flashElement'   => 'admin_notice',
		),
		'membre' => array(
			'userModel'      => 'Member',
			'userScope'      => array('Member.registration_state' => 1),
			//'fields'         => array('username' => 'email', 'password' => 'password'),
			'fields'         => array('username' => 'username', 'password' => 'password'),
			'loginAction'    => array('controller' => 'members', 'action' => 'login', 'membre' => false),
			'loginRedirect'  => array('controller' => 'pages', 'action' => 'display', 'membre' => false),
			//'logoutRedirect' => array('controller' => 'members', 'action' => 'login', 'membre' => false),
			//'flashElement'   => 'public_notice'
		),
	);
 
	/**
	 * Démarrage du composant.
	 * Autorisation si pas de préfixe dans la Route qui a conduit ici.
	 *
	 * @param object $controller Le contrôleur qui a appelé le composant.
	 */
	function startup(&$controller)
	{
		$prefix = null;
 
		if(empty($controller->params['prefix']))
		{
			$this->allow();
		}
		else
		{
			$prefix = $controller->params['prefix'];
		}
 
		// Cas spécial des actions de login et logout, pour lesquelles le préfixe n'existe pas
		if(in_array($controller->action, array('login', 'logout')))
		{
			switch($controller->name)
			{
				case 'Users':
					$prefix = 'admin';
					break;
 
				case 'Members':
					$prefix = 'membre';
					break;
			}
		}
 
		$this->_setup($prefix);
 
		parent::startup($controller);
	}
 
	/**
	 * Définition des variables de config en fonction d'un préfixe
	 *
	 * @param string $prefix
	 */
	function _setup($prefix)
	{
		$settings = $this->defaults;
 
		if(array_key_exists($prefix, $this->configs))
		{
			$settings = array_merge($settings, $this->configs[$prefix]);
		}
 
		$this->_set($settings);
	}
}
?>