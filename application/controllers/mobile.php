<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mobile extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
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
			'categories' => $categories,
			'cities' => $cities
		);
		$this->load->view('mobile/index_view', $data);
	}

	function category($category)
	{
		$query = $this->db_model->getcategory($category, 100, 0);
		$data = array(
			'query' => $query['rows'],
			'title' => $category
		);
		$this->load->view('mobile/deals_view', $data);
	}
	
	function city($city)
	{
		$query = $this->db_model->getcity($city, 100, 0);
		$data = array(
			'query' => $query['rows'],
			'title' => $city
		);
		$this->load->view('mobile/deals_view', $data);
	}
	
	function deal($id)
	{
		$data['query'] = $this->db_model->getdeal($id);
		$this->load->view('mobile/deal_view', $data);
	}

}