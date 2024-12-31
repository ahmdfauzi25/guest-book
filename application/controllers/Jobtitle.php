<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jobtitle extends CI_Controller
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
		$data['title'] = 'Jobtitle';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['jobtitle'] = $this->db->get('jobtitle')->result_array();

		$this->form_validation->set_rules('jobtitle', 'Jobtitle', 'required');
		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('jobtitle/index', $data);
			$this->load->view('templates/footer');
		} else {
			$data = [
				'jobtitle' => htmlspecialchars($this->input->post('jobtitle', true))
			];
			$this->db->insert('jobtitle', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Jobtitle baru telah ditambahkan!</div>');
			redirect('jobtitle');
		}
	}

	public function edit($id)
	{
		$data['title'] = 'Edit jobtitle';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		
		// Mengambil data departemen berdasarkan id
		$data['jobtitle'] = $this->db->get_where('jobtitle', ['id' => $id])->row_array();

		$this->form_validation->set_rules('jobtitle', 'Jobtitle', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('departement/edit', $data);
			$this->load->view('templates/footer');
		} else {
			$data = [
				'jobtitle' => htmlspecialchars($this->input->post('jobtitle', true))
			];
			
			$this->db->where('id', $id);
			$this->db->update('jobtitle', $data);
			
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Jobtitle berhasil diperbarui!</div>');
			redirect('jobtitle');
		}
	}

	public function delete($id)
	{
		// Hapus data departemen berdasarkan id
		$this->db->where('id', $id);
		$this->db->delete('jobtitle');
		
		// Set flash message
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Jobtitle berhasil dihapus!</div>');
		
		// Redirect kembali ke halaman departement
		redirect('jobtitle');
	}
}
