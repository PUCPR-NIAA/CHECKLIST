<?php
App::uses('AppModel', 'Model');
/**
 * Checklist Model
 *
 * @property User $User
 * @property Classroom $Classroom
 */
class Checklist extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => array('block_id', 'name'),
			'order' => '',
			'type' => 'INNER'
		),
		'Classroom' => array(
			'className' => 'Classroom',
			'foreignKey' => 'classroom_id',
			'conditions' => '',
			'fields' => array('block_id', 'name'),
			'order' => '',
			'type' => 'INNER'
		)
	);
}
