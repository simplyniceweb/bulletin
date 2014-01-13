<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {

	public function __construct() {
		parent::__construct();
    }

	public function index() {
		$mysession = $this->session->userdata('logged');
		if($mysession) redirect('');

		$this->load->view('register');
	}
	
	public function process() {

		$mysession = $this->session->userdata('logged');
		if($mysession) redirect('main');

		$data = array(
			'user_name'     => $this->input->post('user_name'),
			'user_email'    => $this->input->post('user_email'),
			'user_password' => sha1($this->input->post('user_password')),
			'user_birthday' => $this->input->post('user_birthday'),
			'user_std_id'   => $this->input->post('user_std_id'),
		);
		
		$this->db->from('student_id');
		$this->db->where('unique', $data['user_std_id']);
		$validStudentId = $this->db->get();
		if($validStudentId->num_rows() < 1) redirect('register/?std_id=invalid');
		
		$this->db->from('users');
		$this->db->where('user_std_id', $data['user_std_id']);
		$usedStudentId = $this->db->get();
		if($usedStudentId->num_rows() > 0) redirect('register/?used_id=true');

		$this->db->insert('users', $data);

		redirect('register/?add=true');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */