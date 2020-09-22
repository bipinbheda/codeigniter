<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('news_model');
        $this->load->helper('url_helper');
        $this->load->helper('form');
        $this->load->helper('MY_common_helper');
	    $this->load->library('form_validation');
	    $this->load->library('session');
	    // $this->session = session();

	    $this->status = array('Pending','Cancel','Completed');
    }
	public function index()
    {
        $data['news'] = $this->news_model->get_news();
        $data['title'] = 'List News.';
        $this->load->view('templates/header',$data);
        $this->load->view('news/index', $data);
        $this->load->view('templates/footer');
    }

    public function view($slug = NULL)
    {
    	if($slug)
        	$data['news'] = $this->news_model->get_news($slug);
        else 
        	$data['news'] = $this->news_model->get_news();

        $data['title'] = 'News';
        $data['status'] = $this->status;
        $this->load->view('templates/header',$data);
        $this->load->view('news/index', $data);
        $this->load->view('templates/footer');
    }

    public function create()
	{
	    $data['title'] = 'Create a news item';

	    $this->form_validation->set_rules('title', 'Title', 'required');
	    $this->form_validation->set_rules('text', 'Text', 'required');

	    if ($this->form_validation->run() === FALSE)
	    {
	        $this->load->view('templates/header', $data);
	        $this->load->view('news/create');
	        $this->load->view('templates/footer');
	    }
	    else
	    {
	        $this->news_model->set_news();
	        $this->session->set_flashdata('message', 'User Has been created.');
	        redirect('/news');
	    }
	}

	public function update($id='')
	{
		$data['title'] = 'Update item';
		$data['news'] = $this->news_model->get_news($id);
		$data['news_id'] = $id;

	    $this->form_validation->set_rules('title', 'Title', 'required');
	    $this->form_validation->set_rules('text', 'Text', 'required');

	    if ($this->form_validation->run() === FALSE) {
	        $this->load->view('templates/header',$data);
	        $this->load->view('news/create',$data);
	        $this->load->view('templates/footer');
	    } else {
	    	$this->session->set_flashdata('message', 'User Has been Updated.');
	        $this->news_model->update_news($id);
	        redirect('/news');
	    } 
	}

	public function update_status($id)
	{
		$json_return = $this->news_model->update_status($id);
		echo json_decode($json_return);
		exit();
	}

	public function delete($id='')
	{
		$this->news_model->delete_news($id);
		$this->session->set_flashdata(['message'=> 'User Has been Deleted.','type'=>'danger']);
		// $this->session->set_flashdata('type', 'danger');
        redirect('/news');
	}
}
