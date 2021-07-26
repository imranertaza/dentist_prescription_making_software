<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Medicine extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('global');
        $this->load->helper('system');
        $this->load->helper('medicine');
        $this->load->model('Medicine_model');
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
            $config['base_url'] = base_url() . 'medicine/index?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'medicine/index?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'medicine/index';
            $config['first_url'] = base_url() . 'medicine/index';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Medicine_model->total_rows($q);
        $medicine = $this->Medicine_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'medicine_data' => $medicine,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('header');
        $this->load->view('sidebar');
        $this->load->view('medicine/medicine_list', $data);
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
        $row = $this->Medicine_model->get_by_id($id);
        if ($row) {
            $data = array(
		'med_id' => $row->med_id,
		'name' => $row->name,
		'cat_id' => $row->cat_id,
		'com_id' => $row->com_id,
		'type' => $row->type,
		'date_time' => $row->date_time,
	    );
            $this->load->view('header');
            $this->load->view('sidebar');
            $this->load->view('medicine/medicine_read', $data);
            $this->load->view('footer');   
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('medicine'));
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
            'action' => site_url('medicine/create_action'),
	    'med_id' => set_value('med_id'),
	    'name' => set_value('name'),
	    'cat_id' => set_value('cat_id'),
	    'com_id' => set_value('com_id'),
	    'type' => set_value('type'),
	    'date_time' => set_value('date_time'),
	);
        $this->load->view('header');
        $this->load->view('sidebar');
        $this->load->view('medicine/medicine_form', $data);
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
		'cat_id' => $this->input->post('cat_id',TRUE),
		'com_id' => $this->input->post('com_id',TRUE),
		'type' => $this->input->post('type',TRUE),
		'date_time' => $this->input->post('date_time',TRUE),
	    );

            $this->Medicine_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('medicine'));
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
        $row = $this->Medicine_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('medicine/update_action'),
		'med_id' => set_value('med_id', $row->med_id),
		'name' => set_value('name', $row->name),
		'cat_id' => set_value('cat_id', $row->cat_id),
		'com_id' => set_value('com_id', $row->com_id),
		'type' => set_value('type', $row->type),
		'date_time' => set_value('date_time', $row->date_time),
	    );
            $this->load->view('header');
            $this->load->view('sidebar');
            $this->load->view('medicine/medicine_form', $data);
            $this->load->view('footer');   
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('medicine'));
        }
    }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('med_id', TRUE));
        } else {
            $data = array(
		'name' => $this->input->post('name',TRUE),
		'cat_id' => $this->input->post('cat_id',TRUE),
		'com_id' => $this->input->post('com_id',TRUE),
		'type' => $this->input->post('type',TRUE),
		'date_time' => $this->input->post('date_time',TRUE),
	    );

            $this->Medicine_model->update($this->input->post('med_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('medicine'));
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
        $row = $this->Medicine_model->get_by_id($id);

        if ($row) {
            $this->Medicine_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('medicine'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('medicine'));
        }
    }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('name', 'name', 'trim|required');
	$this->form_validation->set_rules('cat_id', 'cat id', 'trim|required');
	$this->form_validation->set_rules('com_id', 'com id', 'trim|required');
	$this->form_validation->set_rules('type', 'type', 'trim|required');

	$this->form_validation->set_rules('med_id', 'med_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "medicine.xls";
        $judul = "medicine";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Cat Id");
	xlsWriteLabel($tablehead, $kolomhead++, "Com Id");
	xlsWriteLabel($tablehead, $kolomhead++, "Type");
	xlsWriteLabel($tablehead, $kolomhead++, "Date Time");

	foreach ($this->Medicine_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->name);
	    xlsWriteNumber($tablebody, $kolombody++, $data->cat_id);
	    xlsWriteNumber($tablebody, $kolombody++, $data->com_id);
	    xlsWriteLabel($tablebody, $kolombody++, $data->type);
	    xlsWriteLabel($tablebody, $kolombody++, $data->date_time);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=medicine.doc");

        $data = array(
            'medicine_data' => $this->Medicine_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('medicine/medicine_doc',$data);
    }

}

/* End of file Medicine.php */
/* Location: ./application/controllers/Medicine.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-12-13 14:33:18 */
/* http://harviacode.com */