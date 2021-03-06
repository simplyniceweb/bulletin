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
		
		$activity = NULL;

		$prefs = array (
			'show_next_prev'  => TRUE,
			'next_prev_url'   => 'http://localhost/bulletin/calendar'
		);

		$prefs['template'] = '
		
		   {table_open}<table class="table col-md-6" border="0" cellpadding="0" cellspacing="0">{/table_open}
		
		   {heading_row_start}<tr class="header-calendar">{/heading_row_start}
		
		   {heading_previous_cell}<th><a href="javascript: void(0);" class="calendar-action" data-url="{previous_url}">&lt;&lt;</a></th>{/heading_previous_cell}
		   {heading_title_cell}<th style="text-align:center" colspan="{colspan}">{heading}</th>{/heading_title_cell}
		   {heading_next_cell}<th><a href="javascript: void(0);" class="calendar-action" data-url="{next_url}">&gt;&gt;</a></th>{/heading_next_cell}
		
		   {heading_row_end}</tr>{/heading_row_end}
		
		   {week_row_start}<tr>{/week_row_start}
		   {week_day_cell}<td>{week_day}</td>{/week_day_cell}
		   {week_row_end}</tr>{/week_row_end}
		
		   {cal_row_start}<tr>{/cal_row_start}
		   {cal_cell_start}<td>{/cal_cell_start}
		
		   {cal_cell_content}<a href="{content}">{day}</a>{/cal_cell_content}
		   {cal_cell_content_today}<div class="highlight badge"><a href="{content}">{day}</a></div>{/cal_cell_content_today}
		
		   {cal_cell_no_content}{day}{/cal_cell_no_content}
		   {cal_cell_no_content_today}<div class="highlight badge">{day}</div>{/cal_cell_no_content_today}
		
		   {cal_cell_blank}&nbsp;{/cal_cell_blank}
		
		   {cal_cell_end}</td>{/cal_cell_end}
		   {cal_row_end}</tr>{/cal_row_end}
		
		   {table_close}</table>{/table_close}
		';

		$this->db->from('bulletin');
		$this->db->where('announcement_status', 0);
		$this->db->like('announcement_start', date("Y-m"));
		$announcement = $this->db->get();

		if($announcement->num_rows > 0 ) {
			foreach($announcement->result() as $result) {
				$date = $result->announcement_start;
				$all = explode(" ", $date);
				$day = explode("-", $all[0]);
				$no = $day[2]; 
				$activity[$no] = base_url()."a/".$result->announcement_id."";
			}
		}

		$this->load->library('calendar', $prefs);

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
			'counter'      => $count_dept->num_rows(),
			'activity'     => $activity
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
