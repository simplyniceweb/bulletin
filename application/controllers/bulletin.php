<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bulletin extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('MY_Upload');
    }

	public function index() {
		$mysession = $this->session->userdata('logged');
		if(!$mysession) redirect('login');

		$this->db->from('department');
		$this->db->where('department_status', 0);
		$this->db->order_by("department_id", "desc"); 
		$department = $this->db->get();

		$data = array(
			'session'      => $mysession,
			'department'   => $department->result(),
			'action'       => 0,
			'announcement' => NULL
		);
		
		$this->load->view('bulletin', $data);
	}
	
	public function process() {
		$mysession = $this->session->userdata('logged');
		if(!$mysession) redirect('login');
		
		$action = $this->input->post('action');
		
		$date = date("Y-m-d");
		$data = array(
			'announcement_category' => $this->input->post("announcement_category"),
			'announcement_start' => $this->input->post("announcement_start"),
			'announcement_end' => $this->input->post("announcement_end"),
			'announcement_title' => $this->input->post("announcement_title"),
			'announcement_description' => $this->input->post("announcement_description"),
		);

		if($data['announcement_start'] < $date) {
			redirect("bulletin?date=start_less");
		}
		
		if($data['announcement_end'] < $data['announcement_start']) {
			redirect("bulletin?date=end_less");
		}
		
		if($data['announcement_end'] == $data['announcement_start']) {
			redirect("bulletin?date=equal");
		}
		
		if($action == 0) {
			$this->db->insert('bulletin', $data);
			$announcement_id = $this->db->insert_id();
		} else {
			$this->db->where('announcement_id', $action);
			$this->db->update('bulletin', $data);
			$announcement_id = $action;
		}

		$this->upload->initialize(array(
			"upload_path" => "assets/announcement/",
			"allowed_types" => 'gif|jpg|png|jpeg',
			"max_size" => '2000',
			"encrypt_name" => 'TRUE',
			"remove_spaces" => 'TRUE',
			"is_image" => '1'
		));

		if($this->upload->do_multi_upload("announcement_image")){
			$image = $this->upload->get_multi_upload_data();
			foreach($image as $array) {
				$upload = array(
					'image_name'  => $array['file_name'],
					'announcement_id' => $announcement_id
				);
				
				$this->db->insert('announcement_image', $upload);
			}
		}
		
		if($action == 0) {
			redirect('bulletin?add=true');
		} else {
			redirect('/a/e/'.$action.'?update=true');
		}
	}
	
	public function lists() {
		$mysession = $this->session->userdata('logged');
		if(!$mysession) redirect('login');

		$announcement_id = $this->uri->segment(3);
		$data = array(
			'id' => $announcement_id,
			'session' => $mysession
		);

		$this->load->view('list', $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */