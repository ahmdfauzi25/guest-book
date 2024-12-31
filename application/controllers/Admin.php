<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('email')) {
			redirect('auth');
		}
	}
	public function index()
	{
		$data['title'] = 'Dashboard';
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
		$this->load->view('admin/index', $data);
		$this->load->view('templates/footer');
	}


	public function role()
	{
		$data['title'] = 'Role';
		// $this->session->set_userdata($data);
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['role'] = $this->db->get('user_role')->result_array();


		$this->form_validation->set_rules('role', 'Role', 'required');
		// $this->form_validation->set_rules('menu_id', 'Menu', 'required');
		// $this->form_validation->set_rules('url', 'url', 'required');
		// $this->form_validation->set_rules('icon', 'icon', 'required');

		if ($this->form_validation->run() == false) {
			// $this->load->view('templates/header', $data);
			// $this->load->view('templates/sidebar', $data);
			// $this->load->view('templates/topbar', $data);
			// $this->load->view('menu/submenu', $data);
			// $this->load->view('templates/footer');
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/role', $data);
			$this->load->view('templates/footer');
		} else {
			$data = [
				'role' => $this->input->post('role'),
				// 'menu_id' => $this->input->post('menu_id'),
				// 'url' => $this->input->post('url'),
				// 'icon' => $this->input->post('icon'),
				// 'is_active' => $this->input->post('is_active')
			];
			$this->db->insert('user_role', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New Submenu Added!</div>');
			redirect('admin/role');
		}
	}

	

	public function roleAccess($role_id)
	{
		$data['title'] = 'Role Access';
		// $this->session->set_userdata($data);
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();

		$this->db->where('id !=', 1);
		$data['menu'] = $this->db->get('user_menu')->result_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/role-access', $data);
		$this->load->view('templates/footer');
	}

	public function changeAccess()
	{
		$menu_id = $this->input->post('menuId');
		$role_id = $this->input->post('roleId');

		$data = [
			'role_id' => $role_id,
			'menu_id' => $menu_id
		];

		$result = $this->db->get_where('user_access_menu', $data);
		if ($result->num_rows() < 1) {
			$this->db->insert('user_access_menu', $data);
		} else {
			$this->db->delete('user_access_menu', $data);
		}
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Access Change!</div>');
	}

	public function roleEdit($role_id)
	{
		$data['title'] = 'Edit Role';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		
		// Ambil data role berdasarkan id
		$data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();

		$this->form_validation->set_rules('role', 'Role', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/role-edit', $data);
			$this->load->view('templates/footer');
		} else {
			$data = [
				'role' => $this->input->post('role')
			];
			
			$this->db->where('id', $role_id);
			$this->db->update('user_role', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Role berhasil diubah!</div>');
			redirect('admin/role');
		}
	}

	public function roleDelete($role_id)
	{
		// Cek apakah role masih memiliki user yang menggunakannya
		$users_with_role = $this->db->get_where('user', ['role_id' => $role_id])->num_rows();
		
		if ($users_with_role > 0) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Role tidak dapat dihapus karena masih digunakan!</div>');
		} else {
			// Hapus akses menu untuk role ini
			$this->db->delete('user_access_menu', ['role_id' => $role_id]);
			
			// Hapus role
			$this->db->delete('user_role', ['id' => $role_id]);
			
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Role berhasil dihapus!</div>');
		}
		
		redirect('admin/role');
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

	public function account()
	{
		
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		// Menambahkan kode untuk mengambil semua data user
		$data['all_users'] = $this->db->get('user')->result_array();

		$this->form_validation->set_rules('name', 'Name', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
			'is_unique' => 'This Email Already Register!'
		]);
		$this->form_validation->set_rules('password1', 'Password', 'required|trim|matches[password2]', [
			'matches' => 'password dont match!'
			// 'min_length' => 'Password too short!'
		]);
		$this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
		if ($this->form_validation->run() == false) {
			$data['title'] = 'Account';
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/account', $data);
			$this->load->view('templates/footer');
		} else {
			$data = [
				'name' => htmlspecialchars($this->input->post('name', true)),
				'email' => htmlspecialchars($this->input->post('email', true)),
				'image' => 'default.jpg',
				'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
				'role_id' => 2,
				'is_active' => 1,
				'date_created' => time()
			];
			$this->db->insert('user', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Akun berhasil dibuat!</div>');
			redirect('admin/account');
		}
	}

	public function deleteaccount($user_id)
	{
		// Cek apakah pengguna ada
		$user = $this->db->get_where('user', ['id' => $user_id])->row_array();
		
		if (!$user) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Akun tidak ditemukan!</div>');
			redirect('admin/account');
		} else {
			// Hapus akun
			$this->db->delete('user', ['id' => $user_id]);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Akun berhasil dihapus!</div>');
			redirect('admin/account');
		}
	}

	public function countGoodFeedback()
	{
		$this->db->where('rating >=', 3); // Menghitung rating 3-5
		$total_good_feedback = $this->db->count_all_results('feedback'); // Asumsi tabel feedback ada

		// Mengembalikan total feedback baik
		return $total_good_feedback;
	}

	public function countBadFeedback()
	{
		$this->db->where('rating <=', 2); // Menghitung rating 1-2
		$total_bad_feedback = $this->db->count_all_results('feedback'); // Asumsi tabel feedback ada

		// Mengembalikan total feedback buruk
		return $total_bad_feedback;
	}

	public function countFeedbackSubmitted()
	{
		$total_feedback_submitted = $this->db->count_all_results('feedback'); // Menghitung total feedback yang sudah diisi
		return $total_feedback_submitted; // Mengembalikan total feedback yang sudah diisi
	}


	
}
