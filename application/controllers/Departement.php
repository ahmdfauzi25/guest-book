<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Departement extends CI_Controller
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
		$data['title'] = 'Departement';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['departement'] = $this->db->get('departement')->result_array();

		$this->form_validation->set_rules('departement', 'Departement', 'required');
		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('departement/index', $data);
			$this->load->view('templates/footer');
		} else {
			$data = [
				'departement' => htmlspecialchars($this->input->post('departement', true))
			];
			$this->db->insert('departement', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Departemen baru telah ditambahkan!</div>');
			redirect('departement');
		}
	}

	public function edit($id)
	{
		$data['title'] = 'Edit Departement';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		
		// Mengambil data departemen berdasarkan id
		$data['departement'] = $this->db->get_where('departement', ['id' => $id])->row_array();

		$this->form_validation->set_rules('departement', 'Departement', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('departement/edit', $data);
			$this->load->view('templates/footer');
		} else {
			$data = [
				'departement' => htmlspecialchars($this->input->post('departement', true))
			];
			
			$this->db->where('id', $id);
			$this->db->update('departement', $data);
			
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Departemen berhasil diperbarui!</div>');
			redirect('departement');
		}
	}

	public function delete($id)
	{
		// Hapus data departemen berdasarkan id
		$this->db->where('id', $id);
		$this->db->delete('departement');
		
		// Set flash message
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Departemen berhasil dihapus!</div>');
		
		// Redirect kembali ke halaman departement
		redirect('departement');
	}
}
