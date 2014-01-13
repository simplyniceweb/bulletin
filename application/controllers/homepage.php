<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Homepage extends CI_Controller {

	public function __construct() {
		parent::__construct();
    }

	public function index() {
		$mysession = $this->session->userdata('logged');
		if(!$mysession) redirect('login');
		
		// Expiration		
		$expire = $this->db->query("SELECT * FROM bulletin WHERE announcement_end < NOW()");
		$status = array(
			'announcement_status' => 1
		);
		
		if($expire->num_rows() > 0) {
			foreach($expire->result() as $exp) {
				$this->db->where('announcement_id', $exp->announcement_id);
				$this->db->update('bulletin', $status);
			}
		}

		// General category
		$this->db->from('bulletin');
		$this->db->where('announcement_category', 0);
		$this->db->where('announcement_status', 0);
		$this->db->order_by("announcement_id", "desc"); 
		$announcement = $this->db->get();
		
		// Department category
		$this->db->from('department');
		$this->db->where('department_status', 0);
		if($mysession['user_level'] != 99) {
			$this->db->where('department_id', $mysession['department']);
		}
		$department = $this->db->get();
		
		// Department activity counter
		$this->db->from('bulletin');
		if($mysession['user_level'] != 99) {
			$this->db->where('announcement_category', $mysession['department']);
		}
		$this->db->where('announcement_status', 0);
		$count_dept = $this->db->get();
		
		// General activity counter
		$this->db->from('bulletin');
		$this->db->where('announcement_status', 0);
		$this->db->where('announcement_category', 0);
		$count_gen = $this->db->get();
		
		$data = array(
			'session'      => $mysession,
			'announcement' => $announcement->result(),
			'department'   => $department->result(),
			'general'      => $count_gen->num_rows(),
			'counter'      => $count_dept->num_rows()
		);
		
		$this->load->view('bulletin_board', $data);
	}
	
	public function switch_tab() {
		if( !$this->input->is_ajax_request() ) return false;
		$mysession = $this->session->userdata('logged');
		if(!$mysession) redirect('index');

		$category = $this->input->post('tab_id');

		$this->db->from('bulletin');
		$this->db->where('announcement_category', $category);
		$this->db->where('announcement_status', 0);
		$this->db->order_by("announcement_id", "desc"); 
		$announcement = $this->db->get();
		
		$data = array(
			'announcement' => $announcement->result()
		);
		
		$this->load->view('includes/tab', $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */