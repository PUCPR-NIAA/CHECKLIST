<?php
App::uses('Checklist', 'Model');

/**
 * Checklist Test Case
 *
 */
class ChecklistTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.checklist',
		'app.user',
		'app.block',
		'app.classroom'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Checklist = ClassRegistry::init('Checklist');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Checklist);

		parent::tearDown();
	}

}
