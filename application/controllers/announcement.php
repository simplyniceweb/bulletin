<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Announcement extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('parser');
    }

	public function index() {
		$mysession = $this->session->userdata('logged');
		if(!$mysession) redirect('login');

		$announcement_id = $this->uri->segment(2);
		$this->db->from('bulletin');
		$this->db->where('announcement_status', 0);
		$this->db->where('announcement_id', $announcement_id);
		$announcement = $this->db->get();

		$data = array(
			'title'        => 'Announcement',
			'id'           => $announcement_id,
			'session'      => $mysession,
			'announcement' => $announcement->result()
		);

		$this->parser->parse('list', $data);
	}
	
	public function edit() {
		$mysession = $this->session->userdata('logged');
		if(!$mysession) redirect('login');

		$announcement_id =  $this->uri->segment(3);

		$this->db->from('department');
		$this->db->where('department_status', 0);
		$this->db->order_by("department_id", "desc"); 
		$department = $this->db->get();
		
		$this->db->from('bulletin');
		$this->db->where('announcement_status', 0);
		$this->db->where('announcement_id', $announcement_id);
		$announcement = $this->db->get();

		$data = array(
			'session'         => $mysession,
			'department'      => $department->result(),
			'action'          => $announcement_id,
			'announcement'     => $announcement->result()
		);
		
		$this->load->view('bulletin', $data);
	}
	
	public function image() {
		$image_id = $this->input->post('image_id');
		$data = array(
			'status' => 1
		);

		$this->db->from('announcement_image');
		$this->db->where('image_id', $image_id);
		$check = $this->db->get();
		
		if($check->num_rows() <= 0) return "error";

		$this->db->where('image_id', $image_id);
		$this->db->update('announcement_image', $data);
		return TRUE;
	}
	
	public function section() {
		$announce_id = $this->input->post('announce_id');
		$data = array(
			'announcement_status' => 1
		);
		
		$this->db->from('bulletin');
		$this->db->where('announcement_id', $announce_id);
		$check = $this->db->get();
		
		if($check->num_rows() <= 0) return "error";
		
		$this->db->where('announcement_id', $announce_id);
		$this->db->update('bulletin', $data);
		return TRUE;
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */