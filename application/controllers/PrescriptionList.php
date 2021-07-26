<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class PrescriptionList extends CI_Controller {
    
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
          
        $data['prescription'] = $this->db->order_by('prescription_id','desc')->get('prescription')->result();

          
        $this->load->view('header');
        $this->load->view('sidebar');
        $this->load->view('prescription/list',$data);
        $this->load->view('footer');
      }
    }

    public function read($id){
      $isLoggedIn = $this->session->userdata('logged_in');
      
      if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
      {
          redirect('/LoginControllers');
      }
      else
      {
        $query = $this->db->get_where('prescription', array('prescription_id' => $id));
        $data['prescription'] = $query->row();

        $data['CC'] = $this->db->get_where('problem',array('prescription_id' => $id))->result();
        $data['advice'] = $this->db->get_where('getadvice',array('prescription_id' => $id))->result();
        $data['prescriptiondata'] = $this->db->get_where('prescription_item',array('prescription_id' => $id))->result();

        // $this->load->view('header');
        // $this->load->view('sidebar');
        $this->load->view('prescription/previewdata',$data);
        // $this->load->view('footer');
      }
    }

    
    
    
}
