<?php

class Stores extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Franquicias';
		$this->load->model('model_stores');
	}

	public function index()
	{
		if(!in_array('viewStore', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->render_template('stores/index', $this->data);
	}

	public function fetchCategoryData()
	{
		if(!in_array('viewStore', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$result = array('data' => array());

		$data = $this->model_stores->getStoresData();

		foreach ($data as $key => $value) {
			// button
			$buttons = '';

			if(in_array('updateStore', $this->permission)) {
				$buttons = '<button type="button" class="btn btn-default" onclick="editFunc('.$value['id'].')" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i></button>';
			}

			if(in_array('deleteStore', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
			}

			$status = ($value['active'] == 1) ? '<span class="label label-success">Activa</span>' : '<span class="label label-warning">Inactiva</span>';

			$result['data'][$key] = array(
				$value['name'],
				$status,
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}

	public function create()
	{
		if(!in_array('createStore', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		$this->form_validation->set_rules('store_name', 'Store name', 'trim|required');
		$this->form_validation->set_rules('active', 'Active', 'trim|required');

		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if ($this->form_validation->run() == TRUE) {
        	$data = array(
        		'name' => $this->input->post('store_name'),
        		'active' => $this->input->post('active'),
        	);

        	$create = $this->model_stores->create($data);
        	if($create == true) {
        		$response['success'] = true;
        		$response['messages'] = 'Creado Exitosamente';
        	}
        	else {
        		$response['success'] = false;
        		$response['messages'] = 'Error en la base de datos al escribir la información';
        	}
        }
        else {
        	$response['success'] = false;
        	foreach ($_POST as $key => $value) {
        		$response['messages'][$key] = form_error($key);
        	}
        }

        echo json_encode($response);
	}

	public function fetchStoresDataById($id = null)
	{
		if($id) {
			$data = $this->model_stores->getStoresData($id);
			echo json_encode($data);
		}

	}

	public function update($id)
	{
		if(!in_array('updateStore', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		if($id) {
			$this->form_validation->set_rules('edit_store_name', 'Store name', 'trim|required');
			$this->form_validation->set_rules('edit_active', 'Active', 'trim|required');

			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

	        if ($this->form_validation->run() == TRUE) {
	        	$data = array(
	        		'name' => $this->input->post('edit_store_name'),
        			'active' => $this->input->post('edit_active'),
	        	);

	        	$update = $this->model_stores->update($id, $data);
	        	if($update == true) {
	        		$response['success'] = true;
	        		$response['messages'] = 'Actualizado Exitosamente';
	        	}
	        	else {
	        		$response['success'] = false;
	        		$response['messages'] = 'Error en la base de datos al escribir la información';
	        	}
	        }
	        else {
	        	$response['success'] = false;
	        	foreach ($_POST as $key => $value) {
	        		$response['messages'][$key] = form_error($key);
	        	}
	        }
		}
		else {
			$response['success'] = false;
    		$response['messages'] = 'Error porfavor refresque la página';
		}

		echo json_encode($response);
	}

	public function remove()
	{
		if(!in_array('deleteStore', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$store_id = $this->input->post('store_id');

		$response = array();
		if($store_id) {
			$delete = $this->model_stores->remove($store_id);
			if($delete == true) {
				$response['success'] = true;
				$response['messages'] = "Eliminado Exitosamente";
			}
			else {
				$response['success'] = false;
				$response['messages'] = "Error en la base de datos al escribir la información";
			}
		}
		else {
			$response['success'] = false;
			$response['messages'] = "Por favor refresque la página";
		}

		echo json_encode($response);
	}

}
