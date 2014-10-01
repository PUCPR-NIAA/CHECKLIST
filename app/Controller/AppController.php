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
class AppController extends Controller 
{
	//Componentes utilizados por toda a aplicação
	public $components = array('Session', 'Cookie', 'Auth');

	public function beforeFilter() 
	{
	
		$this->Auth->authenticate = array(
            AuthComponent::ALL => array(
            	//Define qual Model usar
                'userModel' => 'User',
                //O campo usado para logar
                'fields' => array(
                    'username' => 'username',
                    'password' => 'password'
                    )
                ),
            'Form',
            );   
		// Autorização feita pelo auth nos controladores, usando a função isAuthorized
		$this->Auth->authorize = 'controller'; 

 		// Redireciona o usuário para a requisição anterior que foi negada após o login
		$this->Auth->autoRedirect = 0;

		// Action da tela de login
		$this->Auth->loginAction = array(
			'admin' => false,
			'controller' => 'users',
			'action' => 'login'
		);
		
		// Action da tela após o login (com sucesso)
		$this->Auth->loginRedirect = array(
			'admin' => false,
			'controller' => 'checklists',
			'action' => 'index'
		);
		
		// Action para redirecionamento após o logout
		$this->Auth->logoutRedirect = array(
			'admin' => false,
			'controller' => 'users',
			'action' => 'login'
		);
		
		// Mensagens de erro
		$this->Auth->loginError = __('User or password invalid', true);
		$this->Auth->authError = __('You need to login to access this page', true);

		//Restringindo acesso ao prefixo 'ADMIN'
		if (!isset($this->params['admin']) || !$this->params['admin'])
		{
			//Nega acesso sempre que a rota for /admin
			$this->Auth->deny('*');
		}
		else
		{
			//Permite acesso a todas as rotas que não forem /admin
			$this->Auth->allow('*');
		}
		//Páginas permitidas para acesso ao usuário sem estar logado
        $this->Auth->allowedActions = array('controller' => 'users', 'action' => 'login'); 
        //Define que o usuário está logado
        $this->set('logged_in', $this->Auth->loggedIn());
        //Recupera os dados do usuário corrente
        $this->set('current_user', $this->Auth->user());
	}

	function isAuthorized()
	{
		return true;
	}
/**
 * Atualiza infomações do Auth Component da sessão
 * @param string $field
 * @param string $value
 * @param string $model
 * @return void 
 */
	public function _refreshAuth($field = '', $value = '', $model = 'User') 
	{
		if (!empty($field) && !empty($value)) 
		{ 
			$this->Session->write('Auth.' . $model . '.' . $field, $value);
		} 
		else 
		{
			if (isset($this->$model)) 
			{
				$this->Auth->login($this->$model->read(false, $this->Auth->$model('id')));
			} 
			else 
			{
				$this->Auth->login(ClassRegistry::init($model)->findById($this->Auth->$model('id')));
			}
		}
	}
}
