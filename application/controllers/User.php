<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
	public function __construct()
	{	
		parent::__construct();
		if (!$this->session->userdata('email')) {
			redirect('auth');
		}
	}

	public function dashboard()
	{
		$data['title'] = 'Dashboard Operator';
		// $this->session->set_userdata($data);
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['total_guests'] = $this->countGuestsToday();
		$data['total_guests_month'] = $this->countGuestsPerMonth();
		$data['total_good_feedback'] = $this->countGoodFeedback();
		$data['total_bad_feedback'] = $this->countBadFeedback();
		$data['guestbook'] = $this->db->get_where('guestbook', ['date_created' => date('Y-m-d')])->result_array();
		$this->load->model('Servicetype_model', 'servicetype');
		$data['servicetype'] = $this->db->get('servicetype')->result_array();
		$data['total_feedback_submitted'] = $this->countFeedbackSubmitted();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('user/dashboard', $data);
		$this->load->view('templates/footer');
	}
	public function index()
	{
		$data['title'] = 'My Profile';
		// $this->session->set_userdata($data);
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('user/index', $data);
		$this->load->view('templates/footer');
	}

	public function edit()
	{
		$data['title'] = 'Edit Profile';
		// $this->session->set_userdata($data);
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->form_validation->set_rules('name', 'Full Name', 'required|trim');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('user/edit', $data);
			$this->load->view('templates/footer');
		} else {
			$name = $this->input->post('name');
			$email = $this->input->post('email');

			// cek jika ada gambar yang akan uploud
			$uploud_image = $_FILES['image']['name'];

			if ($uploud_image) {
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size'] = '2048';
				$config['upload_path'] = './assets/img/profile/';

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('image')) {
					$old_image = $data['user']['image'];
					if ($old_image != 'default.jpg') {
						unlink(FCPATH . 'assets/img/profile/' . $old_image);
					}

					$new_image = $this->upload->data('file_name');
					$this->db->set('image', $new_image);
				} else {
					echo $this->upload->display_errors();
				}
			}


			$this->db->set('name', $name);
			$this->db->where('email', $email);
			$this->db->update('user');
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your profile has been updated!</div>');
			redirect('auth');
		}
	}

	public function countGuestsToday()
	{
		$today = date('Y-m-d'); // Mendapatkan tanggal hari ini
		$this->db->where('date(date_created)', $today);
		$total_guests = $this->db->count_all_results('guestbook');

		// Mengembalikan total tamu hari ini
		return $total_guests; // Mengubah dari menyimpan pesan ke session
	}

	public function countGuestsPerMonth()
	{
		$month = date('m'); // Mendapatkan bulan saat ini
		$year = date('Y'); // Mendapatkan tahun saat ini
		$this->db->where('MONTH(date_created)', $month);
		$this->db->where('YEAR(date_created)', $year);
		$total_guests_month = $this->db->count_all_results('guestbook');

		// Mengembalikan total tamu per bulan
		return $total_guests_month;
	}

	public function countGoodFeedback()
	{
		$today = date('Y-m-d'); // Mendapatkan tanggal hari ini
		$this->db->where('rating >=', 3); // Menghitung rating 3-5
		$this->db->where('DATE(submit_date)', $today); // Filter berdasarkan tanggal
		$total_good_feedback = $this->db->count_all_results('feedback'); // Asumsi tabel feedback ada

		// Mengembalikan total feedback baik
		return $total_good_feedback;
	}

	public function countBadFeedback()
	{
		$today = date('Y-m-d'); // Mendapatkan tanggal hari ini
		$this->db->where('rating <=', 2); // Menghitung rating 1-2
		$this->db->where('DATE(submit_date)', $today); // Filter berdasarkan tanggal
		$total_bad_feedback = $this->db->count_all_results('feedback'); // Asumsi tabel feedback ada

		// Mengembalikan total feedback buruk
		return $total_bad_feedback;
	}

	public function countFeedbackSubmitted()
	{
		$today = date('Y-m-d'); // Mendapatkan tanggal hari ini
		$this->db->where('DATE(submit_date)', $today); // Filter berdasarkan tanggal
		$total_feedback_submitted = $this->db->count_all_results('feedback'); // Menghitung total feedback yang sudah diisi
		return $total_feedback_submitted; // Mengembalikan total feedback yang sudah diisi
	}

}
