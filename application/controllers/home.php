<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('pagination');
		$this->load->library('user_agent');
		$this->load->model('Facebook_model');
	}

	function index($by = 'id', $offset = 0)
	{
		if($this->agent->is_mobile())
		{
			redirect(site_url('mobile'));
		}

		$query = $this->db_model->getdeals(5, $offset, $by, 'asc');

		$fb_data = $this->session->userdata('fb_data');

		$config['base_url'] = site_url("home/index/$by/");
		$config['total_rows'] = $query['num_rows'];
		$this->pagination->initialize($config);

		$categories = array(
			array('飲食', 'Diet', $this->db_model->getcategory('Diet')),
			array('旅遊', 'Travel', $this->db_model->getcategory('Travel')),
			array('服飾', 'Clothing', $this->db_model->getcategory('Clothing')),
			array('美容', 'Beauty', $this->db_model->getcategory('Beauty')),
			array('其他', 'Other', $this->db_model->getcategory('Other'))
		);
		$cities = array(
			array('台北', 'Taipei', $this->db_model->getcity('Taipei')),
			array('台中', 'Taichung', $this->db_model->getcity('Taichung')),
			array('台南', 'Tainan', $this->db_model->getcity('Tainan')),
			array('高雄', 'Kaohsiung', $this->db_model->getcity('Kaohsiung')),
			array('基隆', 'Keelung', $this->db_model->getcity('Keelung')),
			array('新竹', 'Hsinchu', $this->db_model->getcity('Hsinchu')),
			array('嘉義', 'Chiayi', $this->db_model->getcity('Chiayi')),
			array('桃園', 'Taoyuan', $this->db_model->getcity('Taoyuan')),
			array('苗栗', 'Miaoli', $this->db_model->getcity('Miaoli')),
			array('彰化', 'Changhua', $this->db_model->getcity('Changhua')),
			array('南投', 'Nantou', $this->db_model->getcity('Nantou')),
			array('雲林', 'Yunlin', $this->db_model->getcity('Yunlin')),
			array('屏東', 'Pingtung', $this->db_model->getcity('Pingtung')),
			array('宜蘭', 'Yilan', $this->db_model->getcity('Yilan')),
			array('花蓮', 'Hualien', $this->db_model->getcity('Hualien')),
			array('台東', 'Taitung', $this->db_model->getcity('Taitung')),
			array('其他', 'Other', $this->db_model->getcity('Other'))
		);

		$data = array(
			'query' => $query['rows'],
			'action' => $this->input->post('action'),
			'categories' => $categories,
			'cities' => $cities,
			'fb_data' => $fb_data,
			'pagination' => $this->pagination->create_links(),
			'title' => '首頁',
			'main' => 'home_view'
		);
		$this->load->view('includes/template', $data);

		if($fb_data['uid']) {
			$data = array(
				'fb_uid' => $fb_data['uid'],
				'email' => $fb_data['me']['email']
			);
			$this->db_model->check_insert('users', array('fb_uid' => $fb_data['uid']), $data);
		}
	}

	function frame($id)
	{
		$data['query'] = $this->db_model->getdeal($id);

/*
		$fb_data = $this->session->userdata('fb_data');
		if(($fb_data['uid'])) {
			$query = $this->db_model->getwhere('users', array('fb_uid' => $fb_data['uid']));
			if($query->num_rows() > 0) {
				$row = $query->row();
			}
			echo $data['query']->row()->category;
		}
*/

		$this->load->view('frame_view', $data);
	}

	function search()
	{
		$title = $this->input->post('search');

		$data = array(
			'query' => $this->db_model->getsearch($title),
			'pagination' => '',
			'action' => $this->input->post('action'),
			'title' => '搜尋',
			'main' => 'home_view'
		);
		$this->load->view('includes/template', $data);
	}

	function autocomplete()
	{
		$term = $this->input->post('term');
		$query = $this->db_model->getsearch($term);

		$titles = array();
		foreach ($query->result() as $row) {
			array_push($titles, $row->title);
		}
		echo json_encode($titles);
	}

	function city($city, $offset = 0)
	{
		$query = $this->db_model->getcity($city, 5, $offset);

		$config['base_url'] = site_url("home/city/$city/");
		$config['total_rows'] = $query['num_rows'];
		$this->pagination->initialize($config);

		$data = array(
			'query' => $query['rows'],
			'pagination' => $this->pagination->create_links(),
			'action' => $this->input->post('action'),
			'title' => $city,
			'main' => 'home_view'
		);
		$this->load->view('includes/template', $data);
	}

	function category($category, $offset = 0)
	{
		$query = $this->db_model->getcategory($category, 5, $offset);

		$config['base_url'] = site_url("home/category/$category/");
		$config['total_rows'] = $query['num_rows'];
		$this->pagination->initialize($config);

		$data = array(
			'query' => $query['rows'],
			'pagination' => $this->pagination->create_links(),
			'action' => $this->input->post('action'),
			'title' => $category,
			'main' => 'home_view'
		);
		$this->load->view('includes/template', $data);
	}

}