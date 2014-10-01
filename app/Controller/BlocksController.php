<?php
App::uses('AppController', 'Controller');
/**
 * Blocks Controller
 *
 * @property Block $Block
 * @property PaginatorComponent $Paginator
 */

class BlocksController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() 
	{
		$this->set('title_for_layout',__('List Blocks.'));
		$admin = $this->Session->read('Auth.User.admin');
		if ($admin == true)
		{
			$this->Block->recursive = 0;
			$this->set('blocks', $this->Paginator->paginate());
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
		$this->set('title_for_layout',__('View Block.'));
		$admin = $this->Session->read('Auth.User.admin');
		if ($admin == true)
		{
			if (!$this->Block->exists($id)) 
			{
				throw new NotFoundException(__('Invalid block'));
			}
			$options = array('conditions' => array('Block.' . $this->Block->primaryKey => $id));
			$this->set('block', $this->Block->find('first', $options));
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
 * admin_add method
 *
 * @return void
 */
	public function admin_add() 
	{
		$this->set('title_for_layout',__('Add Block.'));
		$admin = $this->Session->read('Auth.User.admin');
		if ($admin == true)
		{
			if ($this->request->is('post')) 
			{
				$this->Block->create();
				if ($this->Block->save($this->request->data)) 
				{
					$this->Session->setFlash(__('The block has been saved.'), 'default', array('class' => 'success'));
					return $this->redirect(array('action' => 'index'));
				} 
				else 
				{
					$this->Session->setFlash(__('The block could not be saved. Please, try again.'));
				}
			}
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
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) 
	{
		$this->set('title_for_layout',__('Edit Block.'));
		$admin = $this->Session->read('Auth.User.admin');
		if ($admin == true)
		{
			if (!$this->Block->exists($id)) 
			{
				throw new NotFoundException(__('Invalid block'));
			}
			if ($this->request->is(array('post', 'put'))) 
			{
				if ($this->Block->save($this->request->data)) 
				{
					$this->Session->setFlash(__('The block has been saved.'), 'default', array('class' => 'success'));
					return $this->redirect(array('action' => 'index'));
				} 
				else 
				{
					$this->Session->setFlash(__('The block could not be saved. Please, try again.'));
				}
			} 
			else 
			{
				$options = array('conditions' => array('Block.' . $this->Block->primaryKey => $id));
				$this->request->data = $this->Block->find('first', $options);
			}
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
			$this->Block->id = $id;
			if (!$this->Block->exists()) 
			{
				throw new NotFoundException(__('Invalid block'));
			}
			$this->request->allowMethod('post', 'delete');
			if ($this->Block->delete()) 
			{
				$this->Session->setFlash(__('The block has been deleted.'), 'default', array('class' => 'success'));
			} 
			else 
			{
				$this->Session->setFlash(__('The block could not be deleted. Please, try again.'));
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

/**
 * index method
 *
 * @return void
 */
	public function index() 
	{
		$this->Block->recursive = 0;
		$this->set('blocks', $this->Paginator->paginate());
	}
}
