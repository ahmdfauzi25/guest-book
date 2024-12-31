<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Feedback extends CI_Controller
{
	// public function __construct()
	// {
	// 	parent::__construct();
	// 	// Hapus pengecekan login
	// 	// if (!$this->session->userdata('email')) {
	// 	// 	redirect('auth');
	// 	// }

	// public function index()
	// {
	// 	$data['title'] = 'Feedback';
	// 	// $this->session->set_userdata($data);
	// 	$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
	// 	// $data['total_guests'] = $this->countGuestsToday();
	// 	// $data['total_guests_month'] = $this->countGuestsPerMonth();
	// 	// $data['guestbook'] = $this->db->get_where('guestbook', ['date_created' => date('Y-m-d')])->result_array();
	// 	// $this->load->model('Servicetype_model', 'servicetype');
	// 	$data['feedback'] = $this->db->get('feedback')->result_array();
	// 	$this->form_validation->set_rules('date_created', 'Tanggal', 'required');
	// 	$this->form_validation->set_rules('name', 'Name', 'required');
	// 	$this->form_validation->set_rules('jenis_layanan', 'Jenis Layanan', 'required');
	// 	$this->form_validation->set_rules('kriteria_penilaian', 'Kriteria Penilaian', 'required');
	// 	$this->form_validation->set_rules('skor_penilain', 'Skor Penilaian', 'required');
	// 	$this->form_validation->set_rules('saran_masukan', 'Saran Dan Masukan', 'required');
	// 	$this->form_validation->set_rules('status', 'Status', 'required');
		
	// 	if ($this->form_validation->run() == false) {
	// 		$this->load->view('templates/header', $data);
	// 		$this->load->view('templates/sidebar', $data);
	// 		$this->load->view('templates/topbar', $data);
	// 		$this->load->view('feedback/index', $data);
	// 		$this->load->view('templates/footer');
	// 	} else {
	// 		$data = [
	// 			'date_created' => $this->input->post('tanggal', true),
	// 			'name' => $this->input->post('name', true),
	// 			'jenis_layanan' => $this->input->post('jenis_layanan', true),
	// 			'kriteria_penilaian' => $this->input->post('kriteria_penilaian', true),
	// 			'skor_penilain' => $this->input->post('skor_penilain', true),
	// 			'saran_masukan' => $this->input->post('saran_masukan', true),
	// 			'status' => $this->input->post('status', true)
	// 		];

	// 		$this->db->insert('feedback', $data);
	// 		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">✅ Feedback baru telah ditambahkan!</div>');
	// 		redirect('feedback');
	// 	}
	// }

	public function index()
	{
		$data['title'] = 'Feedback';
		// $this->session->set_userdata($data);
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['feedback'] = $this->db->get('feedback')->result_array();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('feedback/index', $data);
		$this->load->view('templates/footer');
	}

	public function create()
	{
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('rating', 'Rating', 'required');
		$this->form_validation->set_rules('comments', 'Comments', 'required');

		if ($this->form_validation->run() == false) {
			// Jika validasi gagal, kembali ke form
			$data['title'] = 'Feedback Form';
			// $this->load->view('templates/header', $data);
			$this->load->view('feedback/create', $data);
			// $this->load->view('templates/footer');
		} else {
			// Jika validasi berhasil, simpan data ke database
			$data = [
				'name' => $this->input->post('name', true),
				'email' => $this->input->post('email', true),
				'rating' => $this->input->post('rating', true),
				'comments' => $this->input->post('comments', true),
				'submit_date' => time(),
			];

			$this->db->insert('feedback', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">✅ Feedback baru telah ditambahkan!</div>');
			redirect('auth');
		}
	}

	
	// {
	// 	$data['title'] = 'Feedback Berhasil';
	// 	$this->load->view('feedback/success', $data);
	// }
}
