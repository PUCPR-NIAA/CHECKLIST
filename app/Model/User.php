<?php
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 * @property Block $Block
 * @property Checklist $Checklist
 */
class User extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Block' => array(
			'className' => 'Block',
			'foreignKey' => 'block_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Checklist' => array(
			'className' => 'Checklist',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'username' => array(
                'Not empty' => array(
                        'rule' => 'notEmpty',
                        'message' => 'Enter your username'
                )
        ),
		'password' => array(
                'Not empty' => array(
                        'rule' => 'notEmpty',
                        'message' => 'Enter your password'
                ),
                'Match passwords' => array(
                        //Chama a funcão para verificar se as senhas coincidem
                        'rule' => 'matchPasswords',
                        'message' => 'Your passwords didn\'t match'
                )
        ),
        'password_confirmation' => array(
                'Not empty' => array(
                        'rule' => 'notEmpty',
                        'message' => 'Confirm your password'
                )
        )
	);

	//Nome do Model
	public $name = 'User';

	//Encriptar a senha antes de salvar no banco de dados
	public function beforeSave($option = array())
	{
		if (!empty($this->data['User']['password']))
		{
			$this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
		}
		return true;
	}
	
	/*
	Verifica se a confirmação da senha combina com a senha digitada
	anteriormente
	*/
	public function matchPasswords($data)
    {
        if($this->$data['password'] == $this->data['password_confirmation'])
        {
                return TRUE;
        }
        $this->invalidate('password_confirmation', 'Your passwords didn\'t match');
        return FALSE;
    }
}
