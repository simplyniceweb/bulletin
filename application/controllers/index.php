<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {

	public function __construct() {
		parent::__construct();
    }

	public function index() {
		$mysession = $this->session->userdata('logged');
		if(!$mysession) redirect('login');
		
		if($mysession['user_level'] == 0) redirect('homepage');
		
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
		
		$this->db->from('bulletin');
		$this->db->where('announcement_status', 0);
		$this->db->order_by("announcement_id", "desc"); 
		$announcement = $this->db->get();
		
		$data = array(
			'session' => $mysession,
			'announcement' => $announcement->result()
		);
		
		$this->load->view('admin_page', $data);
	}
	
	public function calendar() {
		$year = $this->uri->segment(2);
		$month = $this->uri->segment(3);
		$activity = NULL;

		$prefs = array (
			'show_next_prev'  => TRUE,
			'next_prev_url'   => 'http://localhost/bulletin/calendar'
		);

		$this->db->from('bulletin');
		$this->db->where('announcement_status', 0);
		$this->db->like('announcement_start', $year."-".$month);
		$announcement = $this->db->get();

		if($announcement->result() > 0) {
			foreach($announcement->result() as $result) {
				$date = $result->announcement_start;
				$all = explode(" ", $date);
				$day = explode("-", $all[0]);
				$no = $day[2]; 
				$activity[$no] = base_url()."a/".$result->announcement_id."";
			}
		}
		
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
		
		$this->load->library('calendar', $prefs);
		echo $this->calendar->generate($year, $month, $activity);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */