<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Guestbook extends CI_Controller
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
		$data['title'] = 'Guest Book';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		// $data['guestbook'] = $this->db->get('guestbook')->result_array();
		$this->load->model('Servicetype_model', 'servicetype');
		$data['guestbook'] = $this->servicetype->getServicetype();
		$data['servicetype'] = $this->db->get('servicetype')->result_array();
		// Set validation rules
		$this->form_validation->set_rules('name_guest', 'Nama', 'required');
		$this->form_validation->set_rules('instansi', 'Nama Instansi', 'required');
		$this->form_validation->set_rules('servicetype_id', 'Service Type', 'required');
		$this->form_validation->set_rules('no_telp', 'No Telepon', 'required');
		$this->form_validation->set_rules('kepentingan', 'Kepentingan', 'required');
		$this->form_validation->set_rules('waktu_kedatangan', 'Waktu Kedatangan', 'required');
		$this->form_validation->set_rules('waktu_kepulangan', 'Waktu Kepulangan', 'required');
		$this->form_validation->set_rules('date_created', 'Tanggal Dibuat', 'required');
		$this->form_validation->set_rules('status', 'Status', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('guestbook/index', $data);
			$this->load->view('templates/footer');
		} else {
			$data = [
				'name_guest' => htmlspecialchars($this->input->post('name_guest', true)),
				'instansi' => htmlspecialchars($this->input->post('instansi', true)),
				'servicetype_id' => htmlspecialchars($this->input->post('servicetype_id', true)),
				'no_telp' => htmlspecialchars($this->input->post('no_telp', true)),
				'kepentingan' => htmlspecialchars($this->input->post('kepentingan', true)),
				'waktu_kedatangan' => htmlspecialchars($this->input->post('waktu_kedatangan', true)),
				'waktu_kepulangan' => htmlspecialchars($this->input->post('waktu_kepulangan', true)),
				'date_created' => htmlspecialchars($this->input->post('date_created', true)),
				'status' => htmlspecialchars($this->input->post('status', true))
			];
			$this->db->insert('guestbook', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Tamu baru telah ditambahkan!</div>');
			redirect('guestbook');
		}
	}

	public function edit($id)
	{
		$data['title'] = 'Edit Guest Book';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['guestbook'] = $this->db->get_where('guestbook', ['id' => $id])->row_array();
		$data['servicetype'] = $this->db->get('servicetype')->result_array();

		// Set validation rules
		$this->form_validation->set_rules('name_guest', 'Nama', 'required');
		$this->form_validation->set_rules('instansi', 'Nama Instansi', 'required');
		$this->form_validation->set_rules('servicetype_id', 'Service Type', 'required');
		$this->form_validation->set_rules('no_telp', 'No Telepon', 'required');
		$this->form_validation->set_rules('kepentingan', 'Kepentingan', 'required');
		$this->form_validation->set_rules('waktu_kedatangan', 'Waktu Kedatangan', 'required');
		$this->form_validation->set_rules('waktu_kepulangan', 'Waktu Kepulangan', 'required');
		$this->form_validation->set_rules('date_created', 'Tanggal Dibuat', 'required');
		$this->form_validation->set_rules('status', 'Status', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('guestbook/edit', $data); // Ganti dengan view edit
			$this->load->view('templates/footer');
		} else {
			$data = [
				'name_guest' => htmlspecialchars($this->input->post('name_guest', true)),
				'instansi' => htmlspecialchars($this->input->post('instansi', true)),
				'servicetype_id' => htmlspecialchars($this->input->post('servicetype_id', true)),
				'no_telp' => htmlspecialchars($this->input->post('no_telp', true)),
				'kepentingan' => htmlspecialchars($this->input->post('kepentingan', true)),
				'waktu_kedatangan' => htmlspecialchars($this->input->post('waktu_kedatangan', true)),
				'waktu_kepulangan' => htmlspecialchars($this->input->post('waktu_kepulangan', true)),
				'date_created' => htmlspecialchars($this->input->post('date_created', true)),
				'status' => htmlspecialchars($this->input->post('status', true))
			];
			$this->db->update('guestbook', $data, ['id' => $id]);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Tamu telah diperbarui!</div>');
			redirect('guestbook');
		}
	}

	public function delete($id)
	{
		$this->db->delete('guestbook', ['id' => $id]);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Tamu telah dihapus!</div>');
		redirect('guestbook');
	}

	// public function add()
	// {
	// 	$data['title'] = 'Tambah Quest Book';
	// 	$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

	// 	// Set validation rules
	// 	$this->form_validation->set_rules('name', 'Nama', 'required');
	// 	$this->form_validation->set_rules('no_tel', 'No Telepon', 'required');
	// 	$this->form_validation->set_rules('keperluan', 'Keperluan', 'required');
	// 	$this->form_validation->set_rules('waktu_kedatangan', 'Waktu Kedatangan', 'required');
	// 	$this->form_validation->set_rules('waktu_kepergian', 'Waktu Kepergian', 'required');
	// 	$this->form_validation->set_rules('created_date', 'Tanggal Dibuat', 'required');
	// 	$this->form_validation->set_rules('status', 'Status', 'required');

	// 	if ($this->form_validation->run() == false) {
	// 		$this->load->view('templates/header', $data);
	// 		$this->load->view('templates/sidebar', $data);
	// 		$this->load->view('templates/topbar', $data);
	// 		$this->load->view('guestbook/index', $data); // View untuk form tambah
	// 		$this->load->view('templates/footer');
	// 	} else {
	// 		$data = [
	// 			'name' => htmlspecialchars($this->input->post('name', true)),
	// 			'no_tel' => htmlspecialchars($this->input->post('no_tel', true)),
	// 			'keperluan' => htmlspecialchars($this->input->post('keperluan', true)),
	// 			'waktu_kedatangan' => htmlspecialchars($this->input->post('waktu_kedatangan', true)),
	// 			'waktu_kepergian' => htmlspecialchars($this->input->post('waktu_kepergian', true)),
	// 			'created_date' => htmlspecialchars($this->input->post('created_date', true)),
	// 			'status' => htmlspecialchars($this->input->post('status', true))
	// 		];
	// 		$this->db->insert('quest_book', $data);
	// 		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data baru telah ditambahkan!</div>');
	// 		redirect('guestbook'); // Redirect ke halaman guestbook
	// 	}
	// }

}
