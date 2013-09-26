<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Facebook_model');
		#$this->is_loggin_in();
		$this->load->library('pagination');
		$this->load->helper('form');
	}

	function is_loggin_in()
	{
		$fb_data = $this->session->userdata('fb_data');
		if((!$fb_data['uid']) or (!$fb_data['me'])) {
			redirect($this->facebook->getLoginUrl(array('scope' => 'email')));
		}
		$query = $this->db_model->getwhere('users', array('fb_uid' => $fb_data['uid']));
		if($query->num_rows() > 0) {
			$row = $query->row();
		}
		if($row->level != '1')
		{
			$this->load->view('admin/no_permission');
		}
	}

	function index()
	{
		$this->load->view('admin/admin_view');
	}

	function getid($db = NULL, $by = NULL, $id = NULL)
	{
		if(isset($id))
			echo json_encode($this->db_model->getid($db, $by, $id));

		$input = $this->input->post();
		if($this->input->post() != NULL) {
			$this->db_model->db_updata($db, $by, $id, $input);
		}
	}

	function deals($by = 'id', $order = 'asc', $offset = 0)
	{
		$query = $this->db_model->getdeals(10, $offset, $by, $order);

		$sorts = array(
			'id' => 'ID',
			'title' => '標題',
			'price' => '價格',
			'worth' => '原價',
			'city' => '城市',
			'category' => '分類',
			'endtime' => '結束時間'
		);
		$categories = array(
			array('Diet', '飲食'),
			array('Travel','旅遊' ),
			array('Clothing', '服飾'),
			array('Beauty', '美容'),
			array('Other', '其他')
		);
		$cities = array(
			'Taipei' => '台北',
			'Taichung' => '台中',
			'Tainan' => '台南',
			'Kaohsiung' => '高雄',
			'Keelung' => '基隆',
			'Hsinchu' => '新竹',
			'Chiayi' => '嘉義',
			'Taoyuan' => '桃園',
			'Miaoli' => '苗栗',
			'Changhua' => '彰化',
			'Nantou' => '南投',
			'Yunlin' => '雲林',
			'Pingtung' => '屏東',
			'Yilan' => '宜蘭',
			'Hualien' => '花蓮',
			'Taitung' => '台東',
			'Other' => '其他'
		);

		$config['per_page'] = 10;
		$config['base_url'] = site_url("admin/deals/$by/$order");
		$config['total_rows'] = $query['num_rows'];
		$config['uri_segment'] = 5;
		$this->pagination->initialize($config);

		$data = array(
			'query' => $query['rows'],
			'sorts' => $sorts,
			'by' => $by,
			'order' => $order,
			'categories' => $categories,
			'cities' => $cities,
			'pagination' =>$this->pagination->create_links()
		);
		$this->load->view('admin/admin_deals', $data);
	}

	function users($offset = 0)
	{
		$query = $this->db_model->getusers(10, $offset);

		$sorts = array(
			'id' => 'ID',
			'fb_uid' => 'FBUID',
			'email' => '電子信箱',
			'like' => '喜歡',
			'level' => '等級',
			'sub' => '訂閱'
		);
		$categories = array(
			array('飲食', 'Diet'),
			array('旅遊', 'Travel'),
			array('服飾', 'Clothing'),
			array('美容', 'Beauty'),
			array('其他', 'Other')
		);

		$config['per_page'] = 10;
		$config['base_url'] = site_url('admin/users');
		$config['total_rows'] = $query['num_rows'];
		$config['uri_segment'] = 3;
		$this->pagination->initialize($config);

		$data = array(
			'query' => $query['rows'],
			'sorts' => $sorts,
			'categories' => $categories,
			'pagination' => $this->pagination->create_links()
		);
		$this->load->view('admin/admin_users', $data);
	}

}
