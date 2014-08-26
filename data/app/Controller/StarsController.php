<?php
App::uses('AppController', 'Controller');
/**
 * Stars Controller
 *
 * @property Star $Star
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class StarsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session', 'RequestHandler');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Star->recursive = 0;
		$this->set('stars', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		// if (!$this->Star->exists($id)) {
		// 	throw new NotFoundException(__('Invalid star'));
		// }
		// $options = array('conditions' => array('Star.' . $this->Star->primaryKey => $id));
		// $this->set('star', $this->Star->find('first', $options));

		if (empty($id)) {
			throw new NotFoundException(__('Invalid star'));
		}
		
		$options = array(
			'conditions' => array(
				'Star.ra_deg <=' => 120,
				'Star.ra_deg >=' => 0,
				'Star.de_deg <=' => 90,
				'Star.de_deg >=' => 0,
				'Star.vmag <' => 6,
				'Star.vmag >' => 0,		
			)
		);
		$x = 0;
		$y = 0;
		if( !empty($this->request['url']['no'])){
			switch ($this->request['url']['no']) {
				case 1:
					$options['conditions']['Star.ra_deg <='] = 120;
					$options['conditions']['Star.ra_deg >='] = 0;
					$options['conditions']['Star.de_deg <='] = 90;
					$options['conditions']['Star.de_deg >='] = 0;
					break;
				case 2:
					$options['conditions']['Star.ra_deg <='] = 180;
					$options['conditions']['Star.ra_deg >='] = 60;
					$options['conditions']['Star.de_deg <='] = 90;
					$options['conditions']['Star.de_deg >='] = 0;
					$x = 1;	
					break;
				case 3:
					$options['conditions']['Star.ra_deg <='] = 240;
					$options['conditions']['Star.ra_deg >='] = 120;
					$options['conditions']['Star.de_deg <='] = 90;
					$options['conditions']['Star.de_deg >='] = 0;
					$x = 2;
					break;
				case 4:
					$options['conditions']['Star.ra_deg <='] = 300;
					$options['conditions']['Star.ra_deg >='] = 180;
					$options['conditions']['Star.de_deg <='] = 90;
					$options['conditions']['Star.de_deg >='] = 0;
					$x = 3;
					break;
				case 5:
					$options['conditions']['Star.ra_deg <='] = 360;
					$options['conditions']['Star.ra_deg >='] = 240;
					$options['conditions']['Star.de_deg <='] = 90;
					$options['conditions']['Star.de_deg >='] = 0;
					$x = 4;
					break;
				case 6:
					$options['conditions']['Star.ra_deg <='] = 120;
					$options['conditions']['Star.ra_deg >='] = 0;
					$options['conditions']['Star.de_deg <='] = 45;
					$options['conditions']['Star.de_deg >='] = -45;
					$y = 1;
					break;
				case 7:
					$options['conditions']['Star.ra_deg <='] = 180;
					$options['conditions']['Star.ra_deg >='] = 60;
					$options['conditions']['Star.de_deg <='] = 45;
					$options['conditions']['Star.de_deg >='] = -45;
					$x = 1;
					$y = 1;	
					break;
				case 8:
					$options['conditions']['Star.ra_deg <='] = 240;
					$options['conditions']['Star.ra_deg >='] = 120;
					$options['conditions']['Star.de_deg <='] = 45;
					$options['conditions']['Star.de_deg >='] = -45;
					$x = 2;
					$y = 1;
					break;
				case 9:
					$options['conditions']['Star.ra_deg <='] = 300;
					$options['conditions']['Star.ra_deg >='] = 180;
					$options['conditions']['Star.de_deg <='] = 45;
					$options['conditions']['Star.de_deg >='] = -45;
					$x = 3;
					$y = 1;
					break;
				case 10:
					$options['conditions']['Star.ra_deg <='] = 360;
					$options['conditions']['Star.ra_deg >='] = 240;
					$options['conditions']['Star.de_deg <='] = 45;
					$options['conditions']['Star.de_deg >='] = -45;
					$x = 4;
					$y = 1;
					break;
				case 11:
					$options['conditions']['Star.ra_deg <='] = 120;
					$options['conditions']['Star.ra_deg >='] = 0;
					$options['conditions']['Star.de_deg <='] = 0;
					$options['conditions']['Star.de_deg >='] = -90;
					$y = 2;
					break;
				case 12:
					$options['conditions']['Star.ra_deg <='] = 180;
					$options['conditions']['Star.ra_deg >='] = 60;
					$options['conditions']['Star.de_deg <='] = 0;
					$options['conditions']['Star.de_deg >='] = -90;
					$x = 1;
					$y = 2;	
					break;
				case 13:
					$options['conditions']['Star.ra_deg <='] = 240;
					$options['conditions']['Star.ra_deg >='] = 120;
					$options['conditions']['Star.de_deg <='] = 0;
					$options['conditions']['Star.de_deg >='] = -90;
					$x = 2;
					$y = 2;
					break;
				case 14:
					$options['conditions']['Star.ra_deg <='] = 300;
					$options['conditions']['Star.ra_deg >='] = 180;
					$options['conditions']['Star.de_deg <='] = 0;
					$options['conditions']['Star.de_deg >='] = -90;
					$x = 3;
					$y = 2;
					break;
				case 15:
					$options['conditions']['Star.ra_deg <='] = 360;
					$options['conditions']['Star.ra_deg >='] = 240;
					$options['conditions']['Star.de_deg <='] = 0;
					$options['conditions']['Star.de_deg >='] = -90;
					$x = 4;
					$y = 2;
					break;
					
			}
		}		
		$starData = $this->Star->find('all', $options);
		$this->log($starData);
		$stars = array();
		foreach($starData as $data){
			$stars[$data['Star']['columns']] = array(
				'star' => floor($data['Star']['vmag']), 
				'x' => $data['Star']['ra_deg']*6 - 350*$x, 
				'y' => $data['Star']['de_deg']*4 + 200*$y
			);
		}


		// if( !empty($this->request['url']['no']) && $this->request['url']['no'] < 100){
		// 	foreach($stars as &$star){
		// 		$star['x'] = $star['x'] + 100;
		// 		$star['y'] = $star['y'] + 100;
		// 	}
		// }


		$this->set(array(
			'stars' => $stars,
			'_serialize' => array('stars')
		));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Star->create();
			if ($this->Star->save($this->request->data)) {
				$this->Session->setFlash(__('The star has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The star could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Star->exists($id)) {
			throw new NotFoundException(__('Invalid star'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Star->save($this->request->data)) {
				$this->Session->setFlash(__('The star has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The star could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Star.' . $this->Star->primaryKey => $id));
			$this->request->data = $this->Star->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Star->id = $id;
		if (!$this->Star->exists()) {
			throw new NotFoundException(__('Invalid star'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Star->delete()) {
			$this->Session->setFlash(__('The star has been deleted.'));
		} else {
			$this->Session->setFlash(__('The star could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Star->recursive = 0;
		$this->set('stars', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Star->exists($id)) {
			throw new NotFoundException(__('Invalid star'));
		}
		$options = array('conditions' => array('Star.' . $this->Star->primaryKey => $id));
		$this->set('star', $this->Star->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Star->create();
			if ($this->Star->save($this->request->data)) {
				$this->Session->setFlash(__('The star has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The star could not be saved. Please, try again.'));
			}
		}
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Star->exists($id)) {
			throw new NotFoundException(__('Invalid star'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Star->save($this->request->data)) {
				$this->Session->setFlash(__('The star has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The star could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Star.' . $this->Star->primaryKey => $id));
			$this->request->data = $this->Star->find('first', $options);
		}
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Star->id = $id;
		if (!$this->Star->exists()) {
			throw new NotFoundException(__('Invalid star'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Star->delete()) {
			$this->Session->setFlash(__('The star has been deleted.'));
		} else {
			$this->Session->setFlash(__('The star could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
