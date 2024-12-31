<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Servicetype extends CI_Controller
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
		$data['title'] = 'Service Type';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['servicetype'] = $this->db->get('servicetype')->result_array();

		$this->form_validation->set_rules('service_type', 'Service Type', 'required');
		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('servicetype/index', $data);
			$this->load->view('templates/footer');
		} else {
			$data = [
				'service_type' => htmlspecialchars($this->input->post('service_type', true))
			];
			$this->db->insert('servicetype', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Service Type baru telah ditambahkan!</div>');
			redirect('servicetype');
		}
	}

	public function edit($id)
	{
		$data['title'] = 'Edit Service Type';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		
		// Ambil data servicetype berdasarkan id
		$data['servicetype'] = $this->db->get_where('servicetype', ['id' => $id])->row_array();

		$this->form_validation->set_rules('service_type', 'Service Type', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('servicetype/edit', $data);
			$this->load->view('templates/footer');
		} else {
			$data = [
				'service_type' => htmlspecialchars($this->input->post('service_type', true))
			];
			
			$this->db->where('id', $id);
			$this->db->update('servicetype', $data);
			
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Service Type berhasil diupdate!</div>');
			redirect('servicetype');
		}
	}

	public function delete($id)
	{
		// Hapus data servicetype berdasarkan id
		$this->db->where('id', $id);
		$this->db->delete('servicetype');

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Service Type berhasil dihapus!</div>');
		redirect('servicetype');
	}
}
