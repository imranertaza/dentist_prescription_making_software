<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Category extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('global');
        $this->load->helper('system');
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
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'category/index?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'category/index?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'category/index';
            $config['first_url'] = base_url() . 'category/index';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Category_model->total_rows($q);
        $category = $this->Category_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'category_data' => $category,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('header');
        $this->load->view('sidebar');
        $this->load->view('category/category_list', $data);
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
        $row = $this->Category_model->get_by_id($id);
        if ($row) {
            $data = array(
		'cat_id' => $row->cat_id,
		'name' => $row->name,
		'date' => $row->date,
	    );
            $this->load->view('header');
            $this->load->view('sidebar');
            $this->load->view('category/category_read', $data);
            $this->load->view('footer');   
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('category'));
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
            'action' => site_url('category/create_action'),
	    'cat_id' => set_value('cat_id'),
	    'name' => set_value('name'),
	    'date' => set_value('date'),
	);
        $this->load->view('header');
        $this->load->view('sidebar');
        $this->load->view('category/category_form', $data);
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
		'date' => $this->input->post('date',TRUE),
	    );

            $this->Category_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('category'));
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
        $row = $this->Category_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('category/update_action'),
		'cat_id' => set_value('cat_id', $row->cat_id),
		'name' => set_value('name', $row->name),
		'date' => set_value('date', $row->date),
	    );
            $this->load->view('header');
            $this->load->view('sidebar');
            $this->load->view('category/category_form', $data);
            $this->load->view('footer');   
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('category'));
        }
    }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('cat_id', TRUE));
        } else {
            $data = array(
		'name' => $this->input->post('name',TRUE),
		'date' => $this->input->post('date',TRUE),
	    );

            $this->Category_model->update($this->input->post('cat_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('category'));
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
        $row = $this->Category_model->get_by_id($id);

        if ($row) {
            $this->Category_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('category'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('category'));
        }
    }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('name', 'name', 'trim|required');
	$this->form_validation->set_rules('cat_id', 'cat_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "category.xls";
        $judul = "category";
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

	foreach ($this->Category_model->get_all() as $data) {
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
        header("Content-Disposition: attachment;Filename=category.doc");

        $data = array(
            'category_data' => $this->Category_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('category/category_doc',$data);
    }

}

/* End of file Category.php */
/* Location: ./application/controllers/Category.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-12-13 14:33:18 */
/* http://harviacode.com */