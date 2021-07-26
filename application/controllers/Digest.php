<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Digest extends CI_Controller {
    
    function __construct()
    {
        parent::__construct();
        $this->load->helper('home');
        $this->load->model('Category_model');
        $this->load->library('form_validation');
    }
    
    public function index()
    {
      $isLoggedIn = $this->session->userdata('logged_in');
      
      if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
      {
          redirect('/LoginControllers');
      }
      else
      {
          
        $data['digest'] = $this->db->get('digest')->result();

          
        $this->load->view('header');
        $this->load->view('sidebar');
        $this->load->view('digest/list',$data);
        $this->load->view('footer');
      }
    }

    public function create()
    {
      $isLoggedIn = $this->session->userdata('logged_in');
      
      if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
      {
          redirect('/LoginControllers');
      }
      else
      {
          
        	$data['id'] = rand();
	      	$data['date'] = date('Y-m-d');
	      	$details = $this->session->userdata("prescription");
	      	if (empty($details)) {
		      	$details = array(
		          	"name" => "",
		          	"age"  => "",
		          	"date" => "",
		          	"medicines" => array(),
		          	"C_C" => array(),
		          	"M_H" => array(),
		          	"O_E" => array(),
		          	"treatment" => array(),
		          	"advice" => array(),
		        );
		      	$details = $this->session->set_userdata("prescription", $details);
	      	}
	      
	      	$data['details'] = (object) $details;

	      	$data['customer'] = $this->db->get('customer')->result();
	      	$data['action'] = site_url('prescription/action');

          
	        $this->load->view('header');
	        $this->load->view('sidebar');
	        $this->load->view('digest/index',$data);
	        $this->load->view('footer');
      	}
    }

    public function creareAction(){
      	$isLoggedIn = $this->session->userdata('logged_in');
      
      	if(!isset($isLoggedIn) || $isLoggedIn != TRUE){
          	redirect('/LoginControllers');
      	}else{

	      	$details = $this->session->userdata('prescription');
	        $digest = $this->input->post('digest', TRUE);



	        $digestData = array(
	          	'name' => $this->input->post('digest', TRUE), 
	        );
	        $this->db->insert('digest',$digestData);
	        $digest_id = $this->db->insert_id();

	      	foreach ($details['medicines'] as $row) {
	          	$presItem = array(
	            	'digest_id' => $digest_id,
	            	'name' => $row['name'],
	            	'type' => $row['type'],
	            	'dosage' => $row['dosage'],
	            	'days' => $row['days'],
	            	'before_after' => $row['before_after'],
	            	'when' => $row['when'],
	          	);
	          	$this->db->insert('prescription_item',$presItem);          
	        }

	        $this->session->unset_userdata('prescription');
	        $this->session->set_flashdata('message', '<div style="margin-top: 12px" class="alert alert-success" id="message">Create Record Success</div>');
      		redirect(base_url().'digest/');
      	}
    }

    public function read($id){
    	$isLoggedIn = $this->session->userdata('logged_in');
      
      	if(!isset($isLoggedIn) || $isLoggedIn != TRUE){
          	redirect('/LoginControllers');
      	}else{

          $data['id'] = rand();
          $data['date'] = date('Y-m-d');
          $details = $this->session->userdata("prescription");
          if (empty($details)) {
            $details = array(
                "name" => "",
                "age"  => "",
                "date" => "",
                "medicines" => array(),
                "C_C" => array(),
                "M_H" => array(),
                "O_E" => array(),
                "treatment" => array(),
                "advice" => array(),
            );
            $details = $this->session->set_userdata("prescription", $details);
          }

      		$data['digestId'] = $id;
      		$data['digest'] = $this->db->get_where('prescription_item',array('digest_id' => $id))->result();

      		$this->load->view('header');
	        $this->load->view('sidebar');
	        $this->load->view('digest/view',$data);
	        $this->load->view('footer');
      	}
    }

    public function update(){
    	$isLoggedIn = $this->session->userdata('logged_in');
      
      	if(!isset($isLoggedIn) || $isLoggedIn != TRUE){
          	redirect('/LoginControllers');
      	}else{
          $details = $this->session->userdata("prescription");
          $digestId = $this->input->post('digestId', TRUE);

          if (!empty($details['medicines'])) {

            foreach ($details['medicines'] as $row) {
                $presItem = array(
                  'digest_id' => $digestId,
                  'name' => $row['name'],
                  'type' => $row['type'],
                  'dosage' => $row['dosage'],
                  'days' => $row['days'],
                  'before_after' => $row['before_after'],
                  'when' => $row['when'],
                );
                $this->db->insert('prescription_item',$presItem);  

            }

            $this->session->unset_userdata('prescription');
            $this->session->set_flashdata('message', '<div style="margin-top: 12px" class="alert alert-success" id="message">Update Record Success</div>');
            redirect(base_url().'digest/read/'.$digestId);

          }else{
            $this->session->set_flashdata('message', '<div style="margin-top: 12px" class="alert alert-danger" id="message">Create Record Success Faile!</div>');
            redirect(base_url().'digest/read/'.$digestId);
          }
      	}
    }

    public function remove($id){
        $isLoggedIn = $this->session->userdata('logged_in');
      
        if(!isset($isLoggedIn) || $isLoggedIn != TRUE){
            redirect('/LoginControllers');
        }else{
          $digestId = get_data_by_id('digest_id','prescription_item','prescription_item_id',$id);
          
          $this->db->where('prescription_item_id', $id)->delete('prescription_item');
          $this->session->set_flashdata('message', '<div style="margin-top: 12px" class="alert alert-danger" id="message">Delete Record Success</div>');
          redirect(site_url('digest//read/'.$digestId));
        }
    }

    
    
    
}
