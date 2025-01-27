<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Room extends CI_Controller
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
		$data['title'] = 'Room';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['room'] = $this->db->get('room')->result_array();

		$this->form_validation->set_rules('room', 'Room', 'required');
		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('room/index', $data);
			$this->load->view('templates/footer');
		} else {
			$data = [
				'room' => htmlspecialchars($this->input->post('room', true))
			];
			$this->db->insert('room', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Floor baru telah ditambahkan!</div>');
			redirect('room');
		}
	}

	public function edit($id)
	{
		$data['title'] = 'Edit Room';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		
		// Ambil data floor berdasarkan id
		$data['floor'] = $this->db->get_where('room', ['id' => $id])->row_array();

		$this->form_validation->set_rules('room', 'Room', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('room/edit', $data);
			$this->load->view('templates/footer');
		} else {
			$data = [
				'room' => htmlspecialchars($this->input->post('room', true))
			];
			
			$this->db->where('id', $id);
			$this->db->update('room', $data);
			
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Room berhasil diupdate!</div>');
			redirect('room');
		}
	}

	public function delete($id)
	{
		// Hapus data floor berdasarkan id
		$this->db->where('id', $id);
		$this->db->delete('room');

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Room berhasil dihapus!</div>');
		redirect('Room');
	}
}
