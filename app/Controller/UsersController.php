<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');
	var $paginate = array(
		'limit' => 30);



/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) 
	{
		$this->set('title_for_layout',__('View your information.'));
		if (!$this->User->exists($id)) {
				throw new NotFoundException(__('Invalid user'));
			}
			$options = array(
				'fields' => 'Checklist.*, Classroom.*, User.*, Block.*',
				'joins' => array(
					array(
						'table' => 'checklists',
						'type' => 'INNER',
						'alias' => 'Checklist',
						'conditions' => 'Checklist.user_id = User.id'
					),
					array(
						'table' => 'classrooms',
						'type' => 'INNER',
						'alias' => 'Classroom',
						'conditions' => 'Checklist.classroom_id = Classroom.id'
					),
					array(
						'table' => 'blocks',
						'type' => 'INNER',
						'alias' => 'Block',
						'conditions' => 'User.block_id = Block.id'
					)),
				'recursive' => -1,
				'conditions' => 'User.id = '. $id
				);
			$related = $this->User->find('all', $options);
			$options = array('conditions' => 'User.id = '. $id);
			$user = $this->User->find('first', $options);
			$this->set(compact('related', 'user'));
	}

/**
 * changePassword method
 *
 * @param string $id
 * @return Logout
 */
	public function changePassword($id = null)
	{
		$this->set('title_for_layout',__('Change My Password.'));
		$this->User->id = $id;
		if (!$this->User->exists()) 
		{
        	$this->Session->setFlash(__('Invalid user!'));
        	$this->redirect(array(
				'controller' => 'checklists',
				'action' => 'index',
				'admin' => false));
    	}
    	if ($this->Auth->user('id')!= $id) 
    	{
        	$this->Session->setflash(__('You don\'t have permission to access this page!'));
        	$this->redirect(array('controller' => 'checklists',
				'action' => 'index',
				'admin' => false));
        }
    	if ($this->request->is(array('post', 'put'))) 
		{
			if ($this->User->save($this->request->data)) 
			{
				$this->User->saveField('password', $this->request->data['User']['password']);
				$this->Session->setFlash(__('The password has been changed.'), 'default', array('class' => 'success'));
				return $this->redirect($this->Auth->logout());
			}
			else
			{
				$this->Session->setFlash(__('The password could not be changed. Please, try again.'));
				$this->redirect(array(
					'controller' => 'checklists',
					'action' => 'index',
					'admin' => false));
			}
		}	
		$this->request->data = $this->User->read(null, $id);
		unset($this->request->data['User']['password']);		
	}

/**
 * admin_changePassword method
 *
 * @param string $id
 * @return Controller => Checklists, Action => Index
 */
	public function admin_changePassword($id = null) 
	{
		$this->set('title_for_layout',__('Change Password.'));
		$this->User->id = $id;
		if (!$this->User->exists()) 
		{
        	$this->Session->setFlash(__('Invalid user!'));
        	$this->redirect(array(
				'controller' => 'checklists',
				'action' => 'index',
				'admin' => false));
    	}
    	//Recupera a informação do usuário autenticado
		$admin = $this->Session->read('Auth.User.admin');
		$username = null;
		$options = array(
			'conditions' => array(
				'User.' . $this->User->primaryKey => $id));
		$username = $this->User->find('first', $options);
		$username = $username['User']['username'];
		//Verifica se é administrador, se for lista todos os usuários
		if ($admin == false)
		{    	
        	$this->Session->setflash(__('You don\'t have permission to access this page!'));
        	$this->redirect(array('controller' => 'checklists',
				'action' => 'index',
				'admin' => false));
        }
    	if ($this->request->is(array('post', 'put'))) 
		{
			if ($this->User->save($this->request->data)) 
			{
				$this->User->saveField('password', $this->request->data['User']['password']);
				$this->Session->setFlash(__('The password of the user %s has been changed successfully.', array($username)), 'default', array('class' => 'success'));
				return $this->redirect(array(
					'action' => 'index',
					'admin' => true));
			}
			else
			{
				$this->Session->setFlash(__('The password could not be changed. Please, try again.'));
				$this->redirect(array(
					'controller' => 'checklists',
					'action' => 'index',
					'admin' => false));
			}
		}	
		$this->request->data = $this->User->read(null, $id);
		unset($this->request->data['User']['password']);
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() 
	{
		$this->set('title_for_layout',__('List Users.'));
		//Recupera a informção do usuário autenticado
		$admin = $this->Session->read('Auth.User.admin');
		//Verifica se é administrador, se for lista todos os usuários
		if ($admin == true)
		{
			$this->User->recursive = 0;
			$this->set('users', $this->Paginator->paginate());
		}
		//Senão exibe uma mensagem de sem acesso e redireciona para a página de checklist
		else
		{
			$this->Session->setflash(__('You don\'t have permission to access this page'));
			return $this->redirect(array('controller' => 'checklists',
				'action' => 'index',
				'admin' => false));
		}
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) 
	{
		$this->set('title_for_layout',__('View information.'));
		$admin = $this->Session->read('Auth.User.admin');
		if ($admin == true)
		{
			if (!$this->User->exists($id)) {
				throw new NotFoundException(__('Invalid user'));
			}
			$options = array(
				'fields' => 'Checklist.*, Classroom.*, User.*, Block.*',
				'joins' => array(
					array(
						'table' => 'checklists',
						'type' => 'INNER',
						'alias' => 'Checklist',
						'conditions' => 'Checklist.user_id = User.id'
					),
					array(
						'table' => 'classrooms',
						'type' => 'INNER',
						'alias' => 'Classroom',
						'conditions' => 'Checklist.classroom_id = Classroom.id'
					),
					array(
						'table' => 'blocks',
						'type' => 'INNER',
						'alias' => 'Block',
						'conditions' => 'User.block_id = Block.id'
					)),
				'recursive' => -1,
				'conditions' => 'User.id = '. $id
				);
			$related = $this->User->find('all', $options);
			$options = array('conditions' => 'User.id = '. $id);
			$user = $this->User->find('first', $options);
			$this->set('related', $related);
			$this->set(compact('user'));
		}
		else
		{
			$this->Session->setflash(__('You don\'t have permission to access this page'));
			return $this->redirect(array('controller' => 'checklists',
				'action' => 'index',
				'admin' => false));
		}
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() 
	{
		$this->set('title_for_layout',__('Add User.'));
		$admin = $this->Session->read('Auth.User.admin');
		if ($admin == true)
		{
			if ($this->request->is('post')) 
			{
				$this->User->create();
				if ($this->User->save($this->request->data)) 
				{
					$this->Session->setFlash(__('The user has been saved.'), 'default', array('class' => 'success'));
					return $this->redirect(array('action' => 'index'));
				} 
				else 
				{
					$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
				}
			}
			$blocks = $this->User->Block->find('list');
			$this->set(compact('blocks'));
		}
		else
		{
			$this->Session->setflash(__('You don\'t have permission to access this page'));
			return $this->redirect(array('controller' => 'checklists',
				'action' => 'index',
				'admin' => false));
		}
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) 
	{
		$this->set('title_for_layout',__('Edit User.'));
		$admin = $this->Session->read('Auth.User.admin');
		if ($admin == true)
		{
			if (!$this->User->exists($id)) 
			{
				throw new NotFoundException(__('Invalid user'));
			}
			if ($this->request->is(array('post', 'put'))) 
			{
				if ($this->User->save($this->request->data)) 
				{
					$this->Session->setFlash(__('The user has been saved.'), 'default', array('class' => 'success'));
					return $this->redirect(array('action' => 'index'));
				} 
				else 
				{
					$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
				}
			} 
			else 
			{
				$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
				$this->request->data = $this->User->find('first', $options);
			}
			$blocks = $this->User->Block->find('list');
			$this->set(compact('blocks'));
		}
		else
		{
			$this->Session->setflash(__('You don\'t have permission to access this page'));
			return $this->redirect(array('controller' => 'checklists',
				'action' => 'index',
				'admin' => false));
		}
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) 
	{
		$admin = $this->Session->read('Auth.User.admin');
		if ($admin == true)
		{
			$this->User->id = $id;
			if (!$this->User->exists()) 
			{
				throw new NotFoundException(__('Invalid user'));
			}
			$this->request->allowMethod('post', 'delete');
			if ($this->User->delete()) 
			{
				$this->Session->setFlash(__('The user has been deleted.'), 'default', array('class' => 'success'));
			} 
			else 
			{
				$this->Session->setFlash(__('The user could not be deleted. Please, try again.'));
			}
			return $this->redirect(array('action' => 'index'));
		}
		else
		{
			$this->Session->setflash(__('You don\'t have permission to access this page'));
			return $this->redirect(array('controller' => 'checklists',
				'action' => 'index',
				'admin' => false));
		}
	}

/**
 * login method
 *
 * @return void
 */
	public function login() 
	{
		$this->set('title_for_layout',__('Log in'));
		if ($this->request->is('post'))
		{
			if ($this->Auth->login())
			{
				return $this->redirect($this->Auth->redirect());
			}
			else
			{
				$this->Session->setFlash($this->Auth->authError);
				$this->redirect($this->Auth->loginAction);
			}
		}
	}

/**
 * login method
 *
 */
	public function logout()
	{
	    $this->Session->setFlash(__('You signed out successfully.'), 'default', array('class' => 'success'));
	    $this->redirect($this->Auth->logout());
	}
}
