<?php
App::uses('AppController', 'Controller');
/**
 * Classrooms Controller
 *
 * @property Classroom $Classroom
 * @property PaginatorComponent $Paginator
 */
class ClassroomsController extends AppController {

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
	public function admin_index() 
	{
		$this->set('title_for_layout',__('List Classrooms.'));
		$admin = $this->Session->read('Auth.User.admin');
		if ($admin == true)
		{
			$this->Classroom->recursive = 0;
			$this->set('classrooms', $this->Paginator->paginate());
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
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) 
	{
		$this->set('title_for_layout',__('View Classroom.'));
		//Recupera a informção do usuário autenticado
		$admin = $this->Session->read('Auth.User.admin');
		if ($admin == true)
		{
			if (!$this->Classroom->exists($id)) {
				throw new NotFoundException(__('Invalid classroom'));
			}

			$options = array(
				'fields' => 'Checklist.*, User.username, Block.*, Classroom.*',
				'joins' => array(
					array(
						'table' => 'checklists',
						'type' => 'INNER',
						'alias' => 'Checklist',
						'conditions' => 'Classroom.id = Checklist.classroom_id'
					),
					array(
						'table' => 'users',
						'type' => 'INNER',
						'alias' => 'User',
						'conditions' => 'User.id = Checklist.user_id'
					),
					array(
						'table' => 'blocks',
						'type' => 'INNER',
						'alias' => 'Block',
						'conditions' => 'Block.id = Classroom.block_id'
					)),
					'conditions' => 'Checklist.classroom_id = '. $id,
					'recursive' => -1
					);
			$result = $this->Classroom->find('all', $options);
			$this->set('classroom', $result);
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
 * add method
 *
 * @return void
 */
	public function admin_add() 
	{
		$this->set('title_for_layout',__('Add Classrooms.'));
		$admin = $this->Session->read('Auth.User.admin');
		if ($admin == true)
		{
			if ($this->request->is('post')) 
			{
				$this->Classroom->create();
				if ($this->Classroom->save($this->request->data)) 
				{
					$this->Session->setFlash(__('The classroom has been saved.'), 'default', array('class' => 'success'));
					return $this->redirect(array('action' => 'index'));
				} 
				else 
				{
					$this->Session->setFlash(__('The classroom could not be saved. Please, try again.'));
				}
			}
			$blocks = $this->Classroom->Block->find('list');
			$this->set(compact('blocks'));
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
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) 
	{
		$this->set('title_for_layout',__('Edit Classrooms.'));
		$admin = $this->Session->read('Auth.User.admin');
		if ($admin == true)
		{
			if (!$this->Classroom->exists($id)) 
			{
				throw new NotFoundException(__('Invalid classroom'));
			}
			if ($this->request->is(array('post', 'put'))) 
			{
				if ($this->Classroom->save($this->request->data)) 
				{
					$this->Session->setFlash(__('The classroom has been saved.'), 'default', array('class' => 'success'));
					return $this->redirect(array('action' => 'index'));
				} 
				else 
				{
					$this->Session->setFlash(__('The classroom could not be saved. Please, try again.'));
				}
			} else {
				$options = array('conditions' => array('Classroom.' . $this->Classroom->primaryKey => $id));
				$this->request->data = $this->Classroom->find('first', $options);
			}
			$blocks = $this->Classroom->Block->find('list');
			$this->set(compact('blocks'));
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
 * delete method
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
			$this->Classroom->id = $id;
			if (!$this->Classroom->exists()) 
			{
				throw new NotFoundException(__('Invalid classroom'));
			}
			$this->request->allowMethod('post', 'delete');
			if ($this->Classroom->delete()) 
			{
				$this->Session->setFlash(__('The classroom has been deleted.'), 'default', array('class' => 'success'));
			} 
			else 
			{
				$this->Session->setFlash(__('The classroom could not be deleted. Please, try again.'));
			}
			return $this->redirect(array('action' => 'index'));
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
}
