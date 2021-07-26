<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Customer extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('global');
        $this->load->helper('system');
        $this->load->model('Customer_model');
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
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'customer/index?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'customer/index?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'customer/index';
            $config['first_url'] = base_url() . 'customer/index';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Customer_model->total_rows($q);
        $customer = $this->Customer_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'customer_data' => $customer,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('header');
        $this->load->view('sidebar');
        $this->load->view('customer/customer_list', $data);
        $this->load->view('footer'); 
        }  


    }

    public function read($id) 
    {
        $isLoggedIn = $this->session->userdata('logged_in');
      
      if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
      {
          redirect('/LoginControllers');
      }
      else
      {
        $row = $this->Customer_model->get_by_id($id);
        if ($row) {
            $data = array(
		'cat_id' => $row->cat_id,
		'name' => $row->name,
		'date' => $row->date,
	    );
            $this->load->view('header');
            $this->load->view('sidebar');
            $this->load->view('customer/customer_read', $data);
            $this->load->view('footer');   
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('customer'));
        }
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
        $data = array(
            'button' => 'Create',
            'action' => site_url('customer/create_action'),
	    'customer_id' => set_value('customer_id'),
	    'name' => set_value('name'),
	    'phone' => set_value('phone'),
	    'age' => set_value('age'),
        'password' => set_value('password'),
	);
        $this->load->view('header');
        $this->load->view('sidebar');
        $this->load->view('customer/customer_form', $data);
        $this->load->view('footer');
        }   
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
				'name' => $this->input->post('name',TRUE),
				'phone' => $this->input->post('phone',TRUE),
				'age' => $this->input->post('age',TRUE),
                'password' => sha1($this->input->post('password',TRUE))
		    );

            $this->Customer_model->insert($data);
            $this->session->set_flashdata('message', '<div style="margin-top: 12px" class="alert alert-success" id="message">Create Record Success</div>');
            redirect(site_url('customer'));
        }
    }
    
    public function update($id) 
    {
        $isLoggedIn = $this->session->userdata('logged_in');
      
      if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
      {
          redirect('/LoginControllers');
      }
      else
      {
        $row = $this->Customer_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('customer/update_action'),
        		'customer_id' => set_value('customer_id', $row->customer_id),
        		'name' => set_value('name', $row->name),
        		'phone' => set_value('phone', $row->phone),
                'age' => set_value('age', $row->age),
    	    );
            $this->load->view('header');
            $this->load->view('sidebar');
            $this->load->view('customer/customer_form', $data);
            $this->load->view('footer');   
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('customer'));
        }
    }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('customer_id', TRUE));
        } else {
            $data = array(
    			'name' => $this->input->post('name',TRUE),
    			'phone' => $this->input->post('phone',TRUE),
                'age' => $this->input->post('age',TRUE),
                'password' => sha1($this->input->post('password',TRUE))
		    );

            $this->Customer_model->update($this->input->post('customer_id', TRUE), $data);
            $this->session->set_flashdata('message', '<div style="margin-top: 12px" class="alert alert-success" id="message">Update Record Success</div>');
            redirect(site_url('customer'));
        }
    }
    
    public function delete($id) 
    {
        $isLoggedIn = $this->session->userdata('logged_in');
      
      if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
      {
          redirect('/LoginControllers');
      }
      else
      {
        $row = $this->Customer_model->get_by_id($id);

        if ($row) {
            $this->Customer_model->delete($id);
            $this->session->set_flashdata('message', '<div style="margin-top: 12px" class="alert alert-danger" id="message">Delete Record Success</div>');
            redirect(site_url('customer'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('customer'));
        }
    }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('name', 'name', 'trim|required');
	$this->form_validation->set_rules('phone', 'phone', 'trim|required');
	$this->form_validation->set_rules('age', 'age', 'trim|required');
    $this->form_validation->set_rules('password', 'password', 'trim|required');
    $this->form_validation->set_rules('con_password', 'Confirm Password', 'required|matches[password]');

	$this->form_validation->set_rules('customer_id', 'customer_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "customer.xls";
        $judul = "customer";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Name");
	xlsWriteLabel($tablehead, $kolomhead++, "Date");

	foreach ($this->customer_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->name);
	    xlsWriteLabel($tablebody, $kolombody++, $data->date);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=customer.doc");

        $data = array(
            'customer_data' => $this->customer_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('customer/customer_doc',$data);
    }

}

/* End of file customer.php */
/* Location: ./application/controllers/customer.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-12-13 14:33:18 */
/* http://harviacode.com */