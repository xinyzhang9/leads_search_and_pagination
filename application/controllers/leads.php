<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class leads extends CI_Controller {
  public function __construct()
  {
    parent::__construct();
    $this->load->model("lead");
    $this->output->enable_profiler();
  }
  public function index_json()
  {
    $data["leads"] = $this->lead->all();
    echo json_encode($data);
  }

  public function index_html()
  {
    $data["leads"] = $this->lead->all();
    $this->load->view('/partials/leads',$data);
  }

  //display in one page
  public function search(){
    if (empty($form_info['date_from']) || empty($form_info['date_to'])) {
      $this->index_html();
    }else{
      if (empty($form_info['name'])) {
        $info = array(
                    'date_from'=>$form_info['date_from'],
                    'date_to'=>$form_info['date_to']);
        $data['leads'] = $this->lead->search_date($info);
      }else{
        list($first_name,$last_name) = explode(' ', $form_info['name']);
        $info = array('first_name'=> $first_name,
                    'last_name'=>$last_name,
                    'date_from'=>$form_info['date_from'],
                    'date_to'=>$form_info['date_to']);
        $data['leads'] = $this->lead->search($info);
      }
      
      $this->load->view('/partials/leads',$data);
    }
  }

  public function pagination(){
    $form_info = $this->input->post();
    if (empty($form_info['date_from']) || empty($form_info['date_to'])) {
      $info = array('start'=>($form_info['page']-1)*5,
                    'num_each_page'=>5);
      $data['leads'] = $this->lead->pagination_all($info);
      $this->load->view('/partials/leads',$data);
    }else{
      if (empty($form_info['name'])) {
        $info = array(
                    'date_from'=>$form_info['date_from'],
                    'date_to'=>$form_info['date_to'],
                    'start'=>($form_info['page']-1)*5,
                    'num_each_page'=>5);
        $data['leads'] = $this->lead->pagination_date($info);
      }else{
        list($first_name,$last_name) = explode(' ', $form_info['name']);
        $info = array('first_name'=> $first_name,
                    'last_name'=>$last_name,
                    'date_from'=>$form_info['date_from'],
                    'date_to'=>$form_info['date_to'],
                    'start'=>($form_info['page']-1)*5,
                    'num_each_page'=>5);
        $data['leads'] = $this->lead->pagination($info);
      }
      
      $this->load->view('/partials/leads',$data);
    }

  }
  public function index()
  {
    $this->load->view('index');
  }
}

?>
