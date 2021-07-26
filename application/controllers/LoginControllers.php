<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class LoginControllers extends CI_Controller {
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('global');
        $this->load->helper('system');
        $this->load->model('Login_model');
        $this->load->library('form_validation');
        $this->load->library('session');
    }
    /**
     * Index Page for this controller.
     */
    public function index()
    {
      $this->load->view('login');
    }
    
    /**
     * This function used to check the user is logged in or not
     */
    function loginMe()
    {
      $email = $this->input->post('email',TRUE);
      $password = sha1($this->input->post('password',TRUE));
      $role = $this->input->post('role_id',TRUE);

      if ($role == 1) {
          $row = $this->db->get_where('users',array('email' => $email,'password' => $password));
          if (!empty($row->num_rows())) {
              $data = $row->row();
              $newdatalogin = array(
                 'user_id'  => $data->user_id,
                 'name'  => $data->name,
                 'mobile'     => $data->mobile,
                 'address'     => $data->address,
                 'logged_in' => 1,
              );
              $this->session->set_userdata($newdatalogin);
              redirect(site_url('prescription'));
          }else{
            
            $this->session->set_flashdata('message', '<div class="label label-danger">Email or password does not exist!</div>');
            redirect(site_url('loginControllers'));
          }
      }else{
        $phone = $this->input->post('phone',TRUE);
        $password = sha1($this->input->post('password',TRUE));
        $row = $this->db->get_where('customer',array('phone' => $phone,'password' => $password));

        if (!empty($row->num_rows())) {
              $data = $row->row();
              $newdatalogin = array(
                 'user_id'  => $data->customer_id,
                 'name'  => $data->name,
                 'mobile'     => $data->phone,
                 'logged_in' => 1,
              );
              $this->session->set_userdata($newdatalogin);
              redirect(site_url('dashboard'));
          }else{
            
            $this->session->set_flashdata('message', '<div class="label label-danger">Phone or password does not exist!</div>');
            redirect(site_url('loginControllers'));
          }
      }
              
    }

    function logout()
   {
      unset($_SESSION['user_id']);
      unset($_SESSION['name']);
      unset($_SESSION['mobile']);
      unset($_SESSION['address']);
      unset($_SESSION['logged_in']);

      redirect(site_url('loginControllers'));
   }
    
    
    
}
