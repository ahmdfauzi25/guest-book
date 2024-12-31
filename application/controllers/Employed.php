<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Employed extends CI_Controller
{
	// public function __construct()
	// {
	// 	parent::__construct();
	// 	if (!$this->session->userdata('email')) {
	// 		redirect('auth');
	// 	}
	// }
	public function index()
	{
		$data['title'] = 'Employed';
		// $this->session->set_userdata($data);
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$this->load->model('Employed_model', 'jobtitle');
		$this->load->model('Employed_model', 'departement');
		$data['employed'] = $this->jobtitle->getJobtitle();
		$data['employed'] = $this->departement->getDepartement();
		$data['jobtitle'] = $this->db->get('jobtitle')->result_array();
		$data['departement'] = $this->db->get('departement')->result_array();
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required');
		$this->form_validation->set_rules('nik', 'NIK', 'required');
		$this->form_validation->set_rules('nip', 'NIP', 'required');
		$this->form_validation->set_rules('jobtitle_id', 'Jobtitle', 'required');
		$this->form_validation->set_rules('departement_id', 'Departement', 'required');
		$this->form_validation->set_rules('address', 'Address', 'required');


		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('employed/index', $data);
			$this->load->view('templates/footer');
		} else {
			$data = [
				'name' => $this->input->post('name'),
				'tanggal_lahir' => $this->input->post('tanggal_lahir'),
				'nik' => $this->input->post('nik'),
				'nip' => $this->input->post('nip'),
				'jobtitle_id' => $this->input->post('jobtitle_id'),
				'departement_id' => $this->input->post('departement_id'),
				'address' => $this->input->post('address'),
				'is_active' => $this->input->post('is_active'),
				'created_date' => time()
			];
			$this->db->insert('employed', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New Employed Added!</div>');
			redirect('employed');
		}
	}

	public function edit($id)
	{
		$data['title'] = 'Edit Employed';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		
		// Mengambil data employed berdasarkan id
		$data['employed'] = $this->db->get_where('employed', ['id' => $id])->row_array();
		// Mengambil data jobtitle dan departement untuk dropdown
		$data['jobtitle'] = $this->db->get('jobtitle')->result_array();
		$data['departement'] = $this->db->get('departement')->result_array();

		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required');
		$this->form_validation->set_rules('nik', 'NIK', 'required');
		$this->form_validation->set_rules('nip', 'NIP', 'required');
		$this->form_validation->set_rules('jobtitle_id', 'Jobtitle', 'required');
		$this->form_validation->set_rules('departement_id', 'Departement', 'required');
		$this->form_validation->set_rules('address', 'Address', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('employed/edit', $data);
			$this->load->view('templates/footer');
		} else {
			$data = [
				'name' => $this->input->post('name'),
				'tanggal_lahir' => $this->input->post('tanggal_lahir'),
				'nik' => $this->input->post('nik'),
				'nip' => $this->input->post('nip'),
				'jobtitle_id' => $this->input->post('jobtitle_id'),
				'departement_id' => $this->input->post('departement_id'),
				'address' => $this->input->post('address'),
				'is_active' => $this->input->post('is_active')
			];
			
			$this->db->where('id', $id);
			$this->db->update('employed', $data);
			
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data karyawan berhasil diperbarui!</div>');
			redirect('employed');
		}
	}

	public function delete($id)
	{
		// Hapus data karyawan berdasarkan id
		$this->db->where('id', $id);
		$this->db->delete('employed');
		
		// Set flash message
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data karyawan berhasil dihapus!</div>');
		
		// Redirect kembali ke halaman employed
		redirect('employed');
	}
}
