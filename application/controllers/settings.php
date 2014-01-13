<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends CI_Controller {

	public function __construct() {
		parent::__construct();
    }

	public function index() {
		$mysession = $this->session->userdata('logged');
		if (!$mysession) redirect('index');

		$this->db->from('users');
		$this->db->where('user_id', $mysession['user_id']);
		$info = $this->db->get();

		$data = array(
			'session' => $mysession,
			'info'    => $info->result()
		);
		
		$this->load->view('settings', $data);
	}
	
	public function update() {
		$mysession = $this->session->userdata('logged');
		if(!$mysession) redirect('');
		
		$profile_picture = NULL;
		$original_image = $this->input->post('original_photo');	

		$config = array(
			'upload_path'   => 'assets/images/',
			'allowed_types' => 'gif|jpg|png',
			'is_image'      => 1,
			'encrypt_name'  => TRUE,
			'xss_clean'     => TRUE
		);
		
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if ( $this->upload->do_upload() ) {
			$upload_data = $this->upload->data();
			$profile_picture = $upload_data['file_name'];
			
			if($original_image != "") {
				$link = 'assets/images/'.$original_image;
				if(file_exists($link)) {
					unlink($link);
				}
			}
		} else if(! $this->upload->do_upload() && $original_image != "") {
			$profile_picture = $original_image;
		}
		
		$this->db->from('users');
		$this->db->where('user_id', $mysession['user_id']);
		$is_user = $this->db->get();
		
		if($is_user->num_rows > 0) {
			$data = array(
				'user_picture'      => $profile_picture,
				'user_name'            => $this->input->post('student_username'),
				'user_email'           => $this->input->post('student_email'),
				'user_civil_status'         => $this->input->post('civil_status'),
				'user_address'      => $this->input->post('student_address'),
				'user_phone_number' => $this->input->post('student_phone_number'),
				'user_birthday'        => $this->input->post('student_birthday'),
			);
			
			$this->db->where('user_id', $mysession['user_id']);
			$this->db->update('users', $data);
			
			redirect('settings/?update=true');
			
		} else {
			return FALSE;
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */