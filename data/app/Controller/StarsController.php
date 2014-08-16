<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */


class StarsController extends AppController {

	public $uses = array();
	public $components = array('RequestHandler');

	public function view($id) {
		$stars['1'] = array('star' =>1, 'x' => 00, 'y' => 00);
		$stars['2'] = array('star' =>3, 'x' => 200, 'y' => 300);
		$stars['3'] = array('star' =>2, 'x' => 300, 'y' => 100);
		$stars['4'] = array('star' =>3, 'x' => 400, 'y' => 300);
		$stars['5'] = array('star' =>1, 'x' => 555, 'y' => 333);
		$stars['6'] = array('star' =>3, 'x' => 600, 'y' => 400);
		$stars['7'] = array('star' =>2, 'x' => 700, 'y' => 400);
		$stars['8'] = array('star' =>1, 'x' => 800, 'y' => 700);
		$stars['9'] = array('star' =>3, 'x' => 900, 'y' => 500);
		$stars['10'] = array('star' =>2, 'x' => 1000, 'y' => 100);
		$stars['11'] = array('star' =>3, 'x' => 150, 'y' => 130);
		$stars['12'] = array('star' =>3, 'x' => 250, 'y' => 150);
		$stars['13'] = array('star' =>3, 'x' => 350, 'y' => 250);
		$stars['14'] = array('star' =>3, 'x' => 450, 'y' => 350);
		$stars['15'] = array('star' =>3, 'x' => 550, 'y' => 50);
		$stars['16'] = array('star' =>3, 'x' => 650, 'y' => 180);
		$stars['17'] = array('star' =>3, 'x' => 750, 'y' => 350);
		$stars['18'] = array('star' =>3, 'x' => 850, 'y' => 30);
		$stars['19'] = array('star' =>3, 'x' => 950, 'y' => 250);
		$stars['20'] = array('star' =>3, 'x' => 1050, 'y' => 150);
		$stars['21'] = array('star' =>3, 'x' => 120, 'y' => 320);
		$stars['22'] = array('star' =>3, 'x' => 220, 'y' => 350);
		$stars['23'] = array('star' =>3, 'x' => 320, 'y' => 450);
		$stars['24'] = array('star' =>3, 'x' => 420, 'y' => 350);
		$stars['25'] = array('star' =>3, 'x' => 520, 'y' => 550);
		$stars['26'] = array('star' =>3, 'x' => 620, 'y' => 390);
		$stars['27'] = array('star' =>3, 'x' => 720, 'y' => 250);
		$stars['28'] = array('star' =>3, 'x' => 820, 'y' => 400);
		$stars['29'] = array('star' =>3, 'x' => 920, 'y' => 150);
		$stars['40'] = array('star' =>3, 'x' => 1250, 'y' => 220);

		$this->set(array(
		'stars' => $stars,
		'_serialize' => array('stars')
		));
    }	
}
