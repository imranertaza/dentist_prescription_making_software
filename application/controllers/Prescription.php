<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Prescription extends CI_Controller {
    
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
          $data['digest'] = $this->db->get('digest')->result();
          
          $this->load->view('header');
          $this->load->view('sidebar');
          $this->load->view('prescription/index', $data);
          $this->load->view('footer');
      }
    }

        
    // Add items
    public function add_new_item()
    {
      $isLoggedIn = $this->session->userdata('logged_in');
      
      if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
      {
          redirect('/LoginControllers');
      }
      else
      {
       //print $id = $this->input->post('id', TRUE);
       $name = $this->input->post('medicine', TRUE);
       $type = $this->input->post('type', TRUE);
       $dosage = $this->input->post('dosage', TRUE);
       $days = $this->input->post('days', TRUE);
       $before_after = $this->input->post('before_after', TRUE);
       $when = $this->input->post('when', TRUE);
       $details = $this->session->userdata('prescription');
       array_push($details['medicines'],array(
                                        "name" => $name,
                                        "type" => $type,
                                        "dosage" => $dosage,
                                        "days" => $days,
                                        "before_after" => $before_after,
                                        "when" => $when,
                                        ));
       
       $new_table = prescription_new_table($details['medicines']);
        
        $this->session->set_userdata("prescription", $details);
        print $new_table;
      } 
    }

    public function radeyprescription(){
      $digestId = $this->input->post('digest_id', TRUE);

      $digest = $this->db->get_where('prescription_item',array('digest_id' => $digestId))->result();
      $details = $this->session->userdata('prescription');
      $details['medicines'] = array();
      foreach ($digest as $row) {
        //$details = $this->session->userdata('prescription');
        array_push($details['medicines'],array(
                                        "name" => $row->name,
                                        "type" => $row->type,
                                        "dosage" => $row->dosage,
                                        "days" => $row->days,
                                        "before_after" => $row->before_after,
                                        "when" => $row->when,
                                        ));
       
        $new_table = prescription_new_table($details['medicines']);
        $this->session->set_userdata("prescription", $details);
      }
        
      
        print $new_table;
    }
    // Delete item
    public function delete_item($item_id)
    {
      $isLoggedIn = $this->session->userdata('logged_in');
      
      if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
      {
          redirect('/LoginControllers');
      }
      else
      {
       $details = $this->session->userdata('prescription');
       unset($details['medicines'][$item_id]);
       
       $new_table = prescription_new_table($details['medicines']);
        
        $this->session->set_userdata("prescription", $details);
        print $new_table;
      } 
    }
    
    //add treatment 
    public function add_new_treatment()
    {
      $isLoggedIn = $this->session->userdata('logged_in');
      
      if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
      {
          redirect('/LoginControllers');
      }
      else
      {
       $type = $this->input->post('t_type', TRUE);
       $top_left = $this->input->post('top_left', TRUE);
       $top_right = $this->input->post('top_right', TRUE);
       $bottom_left = $this->input->post('bottom_left', TRUE);
       $bottom_right = $this->input->post('bottom_right', TRUE);
       $problem = $this->input->post('problem', TRUE);
       
       $details = $this->session->userdata('prescription');
       array_push($details[$type],array(
                                        "problem" => $problem,
                                        "teeth" => array(
                                                    "t_l" => $top_left,
                                                    "t_r" => $top_right,
                                                    "b_l" => $bottom_left,
                                                    "b_r" => $bottom_right,
                                                    ),
                                        "type" => $type,
                                        ));
       
       $new_table = treatment_cc_new_table($type, $details[$type]);
        
        $this->session->set_userdata("prescription", $details);
        print $new_table;
      }
    }
    
    //treatement delete
    public function delete_treatment($t_type)
    {
      $isLoggedIn = $this->session->userdata('logged_in');
      
      if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
      {
          redirect('/LoginControllers');
      }
      else
      {
       $treatment_id = $_POST['treatment_id'];
       $details = $this->session->userdata('prescription');
       unset($details[$t_type][$treatment_id]);
       
       $new_table = treatment_cc_new_table($t_type, $details[$t_type]);
        
        $this->session->set_userdata("prescription", $details);
        print $new_table;
      }
    }
    
    
    // Advice create
    public function add_new_advice()
    {
      $isLoggedIn = $this->session->userdata('logged_in');
      
      if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
      {
          redirect('/LoginControllers');
      }
      else
      {
       $type = 'advice';
       $top_left = $this->input->post('a_top_left', TRUE);
       $top_right = $this->input->post('a_top_right', TRUE);
       $bottom_left = $this->input->post('a_bottom_left', TRUE);
       $bottom_right = $this->input->post('a_bottom_right', TRUE);
       $advice = $this->input->post('advice', TRUE);
       
       $details = $this->session->userdata('prescription');
       array_push($details[$type],array(
                                        "problem" => $advice,
                                        "teeth" => array(
                                                    "t_l" => $top_left,
                                                    "t_r" => $top_right,
                                                    "b_l" => $bottom_left,
                                                    "b_r" => $bottom_right,
                                                    ),
                                        "type" => $type,
                                        ));
       
       $new_table = treatment_cc_new_table($type, $details[$type]);
        
        $this->session->set_userdata("prescription", $details);
        print $new_table;
      } 
    }
    //advice delete
    public function delete_advice($item_id)
    {
      $isLoggedIn = $this->session->userdata('logged_in');
      
      if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
      {
          redirect('/LoginControllers');
      }
      else
      {
       $details = $this->session->userdata('prescription');
       unset($details['medicines'][$item_id]);
       
       $new_table = prescription_new_table($details['medicines']);
        
        $this->session->set_userdata("prescription", $details);
        print $new_table;
      } 
    }

    public function customer_age(){
      $customerId = $this->input->post('customer_id');
      $age = $this->db->get_where('customer',array('customer_id' => $customerId))->row()->age;
      print $age;
    }
    
    
    public function print_view()
    {
      $isLoggedIn = $this->session->userdata('logged_in');
      
      if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
      {
          redirect('/LoginControllers');
      }
      else
      {

        

        $details = $this->session->userdata('prescription');
        if (is_array($details)){
           $name = $this->input->post('name', TRUE);
           $age = $this->input->post('age', TRUE);
           $date = $this->input->post('date', TRUE);
           $details = $this->session->userdata('prescription');
           $details = array_replace($details, array(
                                    'name' => $name,
                                    'age' => $age,
                                    'date' => $date,
                                    ));
           $this->session->set_userdata('prescription', $details);




            $datapresc = array(
              'customer_id' => $details['name'], 
            );
            $this->db->insert('prescription',$datapresc);
            $prescription_id = $this->db->insert_id();






            foreach ($details['medicines'] as $row) {
              $presItem = array(
                'prescription_id' => $prescription_id,
                'name' => $row['name'],
                'type' => $row['type'],
                'dosage' => $row['dosage'],
                'days' => $row['days'],
                'before_after' => $row['before_after'],
                'when' => $row['when'],
              );
              $this->db->insert('prescription_item',$presItem);          
            }





            foreach ($details['C_C'] as $key => $rowcc) {
              $probdata = array(
                'prescription_id' => $prescription_id, 
                'problem' => $rowcc['problem'], 
                't_l' => $rowcc['teeth']['t_l'], 
                't_r' => $rowcc['teeth']['t_r'], 
                'b_l' => $rowcc['teeth']['b_l'], 
                'b_r' => $rowcc['teeth']['b_r'], 
              );
              $this->db->insert('problem',$probdata);
            }
            



            foreach ($details['advice'] as $key => $rowad) {
              $advicedata = array(
                'prescription_id' => $prescription_id, 
                'problem' => $rowad['problem'], 
                't_l' => $rowad['teeth']['t_l'], 
                't_r' => $rowad['teeth']['t_r'], 
                'b_l' => $rowad['teeth']['b_l'], 
                'b_r' => $rowad['teeth']['b_r'], 
              );
              $this->db->insert('getadvice',$advicedata);         
            }


          $data['details'] = (object) $this->session->userdata('prescription');
          //$this->load->view('prescription/preview', $data);
          $this->session->unset_userdata('prescription');
          redirect(base_url().'prescriptionList/read/'.$prescription_id);
        }else {
              redirect(base_url().'prescription/');
        }        
      }
    }
    
    public function company_list($label = '--Select Company--')
    {
      $isLoggedIn = $this->session->userdata('logged_in');
      
      if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
      {
          redirect('/LoginControllers');
      }
      else
      {
        $type = $this->input->post('type', TRUE);
        $this->db->where("type", $type);
        $this->db->group_by("com_id");
        $query = $this->db->get("medicine");
        $option = '<option value="0">'.$label.'</option>';
        foreach ($query->result() as $row)
        {
            $option .= '<option value="'.$row->com_id.'">'.getCompanyNameById($row->com_id).'</option>';
        }
        print $option;
      }
    }
    
    
    public function category_list($label = '--Select Category--')
    {
      $isLoggedIn = $this->session->userdata('logged_in');
      
      if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
      {
          redirect('/LoginControllers');
      }
      else
      {
        $company = $this->input->post('company', TRUE);
        $type = $this->input->post('type', TRUE);
        $this->db->where(array(
                                "com_id" => $company,
                                "type" => $type,
                                ));
        $this->db->group_by("cat_id");
        $query = $this->db->get("medicine");
        print $this->db->last_query();
        $option = '<option value="0">'.$label.'</option>';
        foreach ($query->result() as $row)
        {
            $option .= '<option value="'.$row->cat_id.'">'.getCategoryNameById($row->cat_id).'</option>';
        }
        print $option;
      }
    }
    
    
    public function medicine_list($label = '--Select Medicine--')
    {
      $isLoggedIn = $this->session->userdata('logged_in');
      
      if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
      {
          redirect('/LoginControllers');
      }
      else
      {
        $category = $this->input->post('category', TRUE);
        $company = $this->input->post('company', TRUE);
        $type = $this->input->post('type', TRUE);
        
        $this->db->where(array(
                            "cat_id" => $category,
                            "com_id" => $company,
                            "type" => $type,
                            ));
        $query = $this->db->get("medicine");
        print $this->db->last_query();
        $option = '<option value="0">'.$label.'</option>';
        foreach ($query->result() as $row)
        {
            $option .= '<option>'.getMedicineNameById($row->med_id).'</option>';
        }
        print $option;
      }
    }
    
    /*public function index(){
        $data = array(
            'name' => '',
            'age' => '',
            'date' => date('Y-m-d'),
        );
        $this->db->insert('prescription', $data);
        $id = $this->db->insert_id();                
        redirect('home/prescription/'. $id );
    }*/
}
