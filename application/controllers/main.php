<?php  
/**
* 
*/
class Main extends CI_Controller
{
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('User');
		$this->output->enable_profiler();
	}

	public function index(){
		$this->load->view('index');
	}

	public function add_friend($user_id1,$user_id2){
		$this->User->add_friend($user_id1,$user_id2);
		redirect('/login/profile');
	}

	public function remove_as_friend($user_id1,$user_id2){
		$this->User->remove_as_friend($user_id1,$user_id2);
		redirect('/login/profile');
	}

	public function show_profile($id){
		$user = $this->User->get_user_by_id($id);
		$data = array('user'=>$user);
		$this->load->view('user_profile',$data);
	}

}
?>