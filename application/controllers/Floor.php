<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Floor extends CI_Controller
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
		$data['title'] = 'Floor';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['floor'] = $this->db->get('floor')->result_array();

		$this->form_validation->set_rules('floor', 'Floor', 'required');
		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('floor/index', $data);
			$this->load->view('templates/footer');
		} else {
			$data = [
				'floor' => htmlspecialchars($this->input->post('floor', true))
			];
			$this->db->insert('floor', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Floor baru telah ditambahkan!</div>');
			redirect('floor');
		}
	}

	public function edit($id)
	{
		$data['title'] = 'Edit Floor';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		
		// Ambil data floor berdasarkan id
		$data['floor'] = $this->db->get_where('floor', ['id' => $id])->row_array();

		$this->form_validation->set_rules('floor', 'Floor', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('floor/edit', $data);
			$this->load->view('templates/footer');
		} else {
			$data = [
				'floor' => htmlspecialchars($this->input->post('floor', true))
			];
			
			$this->db->where('id', $id);
			$this->db->update('floor', $data);
			
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Floor berhasil diupdate!</div>');
			redirect('floor');
		}
	}

	public function delete($id)
	{
		// Hapus data floor berdasarkan id
		$this->db->where('id', $id);
		$this->db->delete('floor');

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Floor berhasil dihapus!</div>');
		redirect('floor');
	}
}
