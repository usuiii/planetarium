<?php
/**
 * StarFixture
 *
 */
class StarFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'columns' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'ra_deg' => array('type' => 'float', 'null' => false, 'default' => null, 'unsigned' => false),
		'de_deg' => array('type' => 'float', 'null' => false, 'default' => null, 'unsigned' => false),
		'multi_flag' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 1, 'unsigned' => false),
		'vmag' => array('type' => 'float', 'null' => false, 'default' => null, 'unsigned' => false),
		'variable_flg' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 1, 'unsigned' => false),
		'login_id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'greek_name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'other_name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'columns' => 1,
			'ra_deg' => 1,
			'de_deg' => 1,
			'multi_flag' => 1,
			'vmag' => 1,
			'variable_flg' => 1,
			'login_id' => 'Lorem ipsum dolor sit amet',
			'greek_name' => 'Lorem ipsum dolor sit amet',
			'other_name' => 'Lorem ipsum dolor sit amet',
			'modified' => '2014-08-21 17:24:30',
			'created' => '2014-08-21 17:24:30'
		),
	);

}
