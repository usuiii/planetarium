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
				'Star.de_deg <=' => 120,
				'Star.de_deg <=' => 120,
				'Star.vmag <' => 5,
				'Star.vmag >' => 0,		
			)
		);
		$starData = $this->Star->find('all', $options);
		$this->log($starData);
		$stars = array();
		foreach($starData as $data){
			$stars[$data['Star']['columns']] = array(
				'star' => floor($data['Star']['vmag']), 
				'x' => $data['Star']['ra_deg']*6, 
				'y' => $data['Star']['de_deg']*4
			);
		}


		if( !empty($this->request['url']['no']) && $this->request['url']['no'] < 100){
			foreach($stars as &$star){
				$star['x'] = $star['x'] + 100;
				$star['y'] = $star['y'] + 100;
			}
		}


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
