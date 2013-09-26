<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mail extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('email');
	}

	function index()
	{
		$query = $this->db_model->getmails();

		$this->email->set_newline("\r\n");
		$this->email->from('dobuy@gmail.com', 'Dobuy');
		$this->email->subject('每日精選折扣');

		if($query->num_rows() > 0) {
			foreach($query->result() as $row) {
				$query = $this->db_model->getmaildeals(5, 'price', 'asc', $row->like);
				$data = array('query' => $query, 'pagination' => '');
				$deals = $this->load->view('mail_view', $data, true);

				$this->email->to($row->email);
				$this->email->message($deals);

				if(!$this->email->send())
				{
					show_error($this->email->print_debugger());
				}
			}
		}
	}

}