<?php
App::uses('AppController', 'Controller');

/**
 * Checklists Controller
 *
 * @property Checklist $Checklist
 * @property PaginatorComponent $Paginator
 */
class ChecklistsController extends AppController {

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
	public function index() 
	{
		//Recupera o bloco do usuário autenticado
		$block_id = $this->Session->read('Auth.User.block_id');
		//Recupera o turno do usuário autenticado
		$shift = $this->Session->read('Auth.User.shift');
		//Mescla acento no turno para pesquisa no banco
		$shift = "'" . $shift . "'";
		//Calcula informações de data
		$tmz = time() - (3600 * 27);
		$format = 'Y-m-d';
		$time = ' 00:00:00';
		//Pega a data do dia corrente
		$today = date($format) . $time;
		//Pega a data do dia anterior
		$yesterday = gmdate($format, $tmz) . $time;
		//Opções de filtragem das informações do checklist
		$options = array(
			'fields' => 'DISTINCT Checklist.*, User.*, Classroom.*',
			'joins' => array(
				array(
					'table' => 'classrooms',
					'type' => 'INNER',
					'conditions' => 'Checklist.classroom_id = Classroom.id'
					),
				array(
					'table' => 'users',
					'type' => 'INNER', 
					'conditions' => 'Checklist.user_id = User.id'
					),
				array(
					'table' => 'classrooms',
					'alias' => 'Classroom1',
					'type' => 'INNER',
					'conditions' => 'classrooms.block_id = User.block_id')),
			'conditions' => array(
					'User.block_id = ' . $block_id,
					'User.shift <> ' .  $shift,
					'OR' => array(
					'Checklist.created >= \''. $yesterday . '\'')));
		$this->set('checklists', $this->Checklist->find('all', $options));
	}

	/**
 * myindex method
 *
 * @return void
 */
	public function myindex() 
	{
		//Recupera o bloco do usuário autenticado
		$block_id = $this->Session->read('Auth.User.block_id');
		//Recupera o turno do usuário autenticado
		$shift = $this->Session->read('Auth.User.shift');
		//Mescla acento no turno para pesquisa no banco
		$shift = "'" . $shift . "'";
		//Calcula informações de data
		$tmz = time() - (3600 * 27);
		$format = 'Y-m-d';
		$time = ' 00:00:00';
		//Pega a data do dia corrente
		$today = date($format) . $time;
		//Pega a data do dia anterior
		$yesterday = gmdate($format, $tmz) . $time;
		//Opções de filtragem das informações do checklist
		$options = array(
			'fields' => 'DISTINCT Checklist.*, User.*, Classroom.*',
			'joins' => array(
				array(
					'table' => 'classrooms',
					'type' => 'INNER',
					'conditions' => 'Checklist.classroom_id = Classroom.id'
					),
				array(
					'table' => 'users',
					'type' => 'INNER', 
					'conditions' => 'Checklist.user_id = User.id'
					),
				array(
					'table' => 'classrooms',
					'alias' => 'Classroom1',
					'type' => 'INNER',
					'conditions' => 'classrooms.block_id = User.block_id')),
				'conditions' => array(
						'User.block_id = ' . $block_id,
						'User.shift = ' .  $shift,
						'OR' => array(
						'Checklist.created >= \''. $yesterday . '\'')));
		$this->set('checklists', $this->Checklist->find('all', $options));
	}

/**
 * report method
 *
 * @return void
 */
	public function report()
	{
		$format = 'Y-m-d H:m:s';
		$tmz = time() - (3600 * 3);
		$today = gmdate($format, $tmz);
		$compToday = date('Y-m-d');
		//Recupera o bloco do usuário autenticado
		$id_user = $this->Session->read('Auth.User.id');
		//Recupera a informção do usuário autenticado
		$block_user = $this->Session->read('Auth.User.block_id');
		//Recupero a ultima informação do ultimo report
		$report = explode(' ', $this->Session->read('Auth.User.lastreport'));
		if($compToday != $report[0])
		{
			if ($this->request->is('post')) 
			{
				$this->Checklist->create();
				//Verifica se salvou os dados no BD
				if ($this->Checklist->saveAll($this->request->data['Classroom'])) 
				{
					//Exibe mensagem de sucesso
					$this->Session->setFlash(__('The checklist has been saved.'), 'default', array('class' => 'success'));
					//Carrega o Model User
					$this->loadModel('User');
					//Recupera as informações do usuário autenticado no Auth Component
					$this->User->data['User'] = $this->Session->read('Auth.User');
					//Define o LASTREPORT do usuário
					$this->User->data['User']['lastreport'] = $today;
					//Configura a data para adicionar no banco
					$today = '\'' . $today . '\'';
					//Atualiza no Banco de dados o LASTREPORT do usuário
					$this->User->updateAll(array('lastreport' => $today),array(
						'User.id' => $this->User->data['User']['id']));
					//Atualiza a informação LASTREPORT do uduário autenticado
					$this->_refreshAuth('lastreport', $this->User->data['User']['lastreport']);
					/*
					//Verifica se é possivel salvar o usuário
					if ($this->User->save($this->User->data['User'])) 
					{
						
						$this->User->data['User']['lastreport'] = $today;
						//Salva no Banco de dados o LASTREPORT do usuário
						$this->User->saveField('lastreport', $this->User->data['User']['lastreport']);
						$this->User->data['User'] = $this->Session->read('Auth.User');
						$this->User->data['User']['lastreport'] = $today;
						$this->_refreshAuth('lastreport', $this->User->data['User']['lastreport']);
						echo $this->Session->read('Auth.User.lastreport');
						echo "<pre>";print_r($this->Session->read('Auth.User'));echo "</pre>";
					}*/
				} 
				//Caso exista um erro de gravação, exibe uma mensagem de erro
				else
				{
					$this->Session->setFlash(__('The checklist could not be saved. Please, try again.'));
				}
				return $this->redirect(array('action' => 'myindex'));
			}
			$options = array(
				'conditions' => 'User.id = ' . $id_user);
			$users = $this->Checklist->User->find('list', $options);
			$options = array(
				'conditions' => 'block_id = ' . $block_user);
			$classrooms = $this->Checklist->Classroom->find('list', $options);
			$this->set(compact('users', 'classrooms', 'date'));
		}
		else
		{
			$this->Session->setflash(__('You\'ve done a report today.'));
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
		$admin = $this->Session->read('Auth.User.admin');
		if ($admin == true)
		{
			if (!$this->Checklist->exists($id)) 
			{
				throw new NotFoundException(__('Invalid checklist'));
			}
			$options = array('conditions' => array('Checklist.' . $this->Checklist->primaryKey => $id));
			$result = $this->Checklist->find('first', $options);
			$this->set('checklist', $result);
			$options = array('conditions' => 'Block.id = '.$result['User']['block_id']);
			$this->loadModel('Block');
			$result = $this->Block->find('first', $options);
			$block = $result['Block'];
			$this->set('block',$block);
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
		$admin = $this->Session->read('Auth.User.admin');
		if ($admin == true)
		{	
			//Recupera a informção do usuário autenticado
			$block_user = $this->Session->read('Auth.User.block_id');
			if ($this->request->is('post')) 
			{
				$this->Checklist->create();
				if ($this->Checklist->save($this->request->data)) 
				{
					$this->Session->setFlash(__('The checklist has been saved.'), 'default', array('class' => 'success'));
					return $this->redirect(array('action' => 'index'));
				} 
				else 
				{
					$this->Session->setFlash(__('The checklist could not be saved. Please, try again.'));
				}
			}
			$users = $this->Checklist->User->find('list');
			$options = array(
				'conditions' => 'block_id = ' . $block_user);
			$classrooms = $this->Checklist->Classroom->find('list', $options);
			$this->set(compact('users', 'classrooms'));
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
		$admin = $this->Session->read('Auth.User.admin');
		if ($admin == true)
		{
			if (!$this->Checklist->exists($id)) 
			{
				throw new NotFoundException(__('Invalid checklist'));
			}
			if ($this->request->is(array('post', 'put'))) 
			{
				if ($this->Checklist->save($this->request->data)) 
				{
					$this->Session->setFlash(__('The checklist has been saved.'), 'default', array('class' => 'success'));
					return $this->redirect(array('action' => 'index'));
				} 
				else 
				{
					$this->Session->setFlash(__('The checklist could not be saved. Please, try again.'));
				}
			} 
			else 
			{
				$options = array('conditions' => array('Checklist.' . $this->Checklist->primaryKey => $id));
				$this->request->data = $this->Checklist->find('first', $options);
			}
			$users = $this->Checklist->User->find('list');
			$classrooms = $this->Checklist->Classroom->find('list');
			$this->set(compact('users', 'classrooms'));
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
		//Recupera a informção do usuário autenticado
		$admin = $this->Session->read('Auth.User.admin');
		//Verifica se é administrador, se for lista todos os usuários
		if ($admin == true)
		{
			$this->Checklist->id = $id;
			if (!$this->Checklist->exists()) 
			{
				throw new NotFoundException(__('Invalid checklist'));
			}
			$this->request->allowMethod('post', 'delete');
			if ($this->Checklist->delete()) 
			{
				$this->Session->setFlash(__('The checklist has been deleted.'), 'default', array('class' => 'success'));
			} 
			else 
			{
				$this->Session->setFlash(__('The checklist could not be deleted. Please, try again.'));
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
