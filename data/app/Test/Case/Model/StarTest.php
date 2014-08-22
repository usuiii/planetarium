<?php
App::uses('Star', 'Model');

/**
 * Star Test Case
 *
 */
class StarTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.star'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Star = ClassRegistry::init('Star');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Star);

		parent::tearDown();
	}

}
