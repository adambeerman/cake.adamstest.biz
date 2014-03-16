<?php
App::uses('UnitType', 'Model');

/**
 * UnitType Test Case
 *
 */
class UnitTypeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.unit_type',
		'app.unit',
		'app.plant',
		'app.business_unit',
		'app.refinery',
		'app.company',
		'app.equipment',
		'app.user',
		'app.plants_user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->UnitType = ClassRegistry::init('UnitType');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->UnitType);

		parent::tearDown();
	}

}
