<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
	// public function __construct()
	// {
	// 	parent::__construct();
	// 	is_logged_in();
	// }
	public function index()
	{
		$data['title'] = 'Menu Management';
		// $this->session->set_userdata($data);
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['menu'] = $this->db->get('user_menu')->result_array();

		$this->form_validation->set_rules('menu', 'Menu', 'required');
		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('menu/index', $data);
			$this->load->view('templates/footer');
		} else {
			$this->db->insert('user_menu', ['menu' => $this->input->post('menu')]);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New menu Added!</div>');
			redirect('menu');
		}
	}


	public function submenu()
	{
		$data['title'] = 'Sub-Menu Management';
		// $this->session->set_userdata($data);
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$this->load->model('Menu_model', 'menu');
		$data['subMenu'] = $this->menu->getSubMenu();
		$data['menu'] = $this->db->get('user_menu')->result_array();

		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('menu_id', 'Menu', 'required');
		$this->form_validation->set_rules('url', 'url', 'required');
		$this->form_validation->set_rules('icon', 'icon', 'required');


		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('menu/submenu', $data);
			$this->load->view('templates/footer');
		} else {
			$data = [
				'title' => $this->input->post('title'),
				'menu_id' => $this->input->post('menu_id'),
				'url' => $this->input->post('url'),
				'icon' => $this->input->post('icon'),
				'is_active' => $this->input->post('is_active')
			];
			$this->db->insert('user_sub_menu', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New Submenu Added!</div>');
			redirect('menu/submenu');
		}
	}

	public function edit($id)
	{
		$data['title'] = 'Edit Menu';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['menu'] = $this->db->get_where('user_menu', ['id' => $id])->row_array();

		$this->form_validation->set_rules('menu', 'Menu', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('menu/edit', $data);
			$this->load->view('templates/footer');
		} else {
			$this->db->where('id', $id);
			$this->db->update('user_menu', ['menu' => $this->input->post('menu')]);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Menu has been updated!</div>');
			redirect('menu');
		}
	}

	public function delete($id)
	{
		$this->db->delete('user_menu', ['id' => $id]);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Menu has been deleted!</div>');
		redirect('menu');
	}

	public function editsubmenu($id)
	{
		$data['title'] = 'Edit Sub Menu';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		
		// Ambil data submenu yang akan diedit
		$data['subMenu'] = $this->db->get_where('user_sub_menu', ['id' => $id])->row_array();
		// Ambil data menu untuk dropdown
		$data['menu'] = $this->db->get('user_menu')->result_array();

		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('menu_id', 'Menu', 'required');
		$this->form_validation->set_rules('url', 'URL', 'required');
		$this->form_validation->set_rules('icon', 'Icon', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('menu/editsubmenu', $data);
			$this->load->view('templates/footer');
		} else {
			$data = [
				'title' => $this->input->post('title'),
				'menu_id' => $this->input->post('menu_id'),
				'url' => $this->input->post('url'),
				'icon' => $this->input->post('icon'),
				'is_active' => $this->input->post('is_active')
			];

			$this->db->where('id', $id);
			$this->db->update('user_sub_menu', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Sub menu has been updated!</div>');
			redirect('menu/submenu');
		}
	}

	public function submenuDelete($id)
	{
		// Hapus submenu berdasarkan id
		$this->db->delete('user_sub_menu', ['id' => $id]);	
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Submenu berhasil dihapus!</div>');
		redirect('menu/submenu');
	}
}
