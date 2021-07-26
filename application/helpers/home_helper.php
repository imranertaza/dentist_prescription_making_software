<?php

defined('BASEPATH') OR exit('No direct script access allowed');

function getDropDownCategory($id=0, $label = '--Select Category--') {
    $ci =& get_instance();
    
    $ci->db->select('cat_id,name');
    $ci->db->from('category');
    $ci->db->order_by('name', "ASC");
    $categories =  $ci->db->get()->result();
    
    $option = '<option value="0">'.$label.'</option>';
    foreach ($categories as $category) {
        $option .= '<option value="'. $category->cat_id .'"';
        $option .=  ($category->cat_id == $id) ? ' selected' : '';
        $option .= '>'. $category->name .'</option>';            
    }    
    return $option;
}
function getDropDownCompany($id=0, $label = '--Select Company--') {
    $ci =& get_instance();
    
    $ci->db->select('com_id,name');
    $ci->db->from('company');
    $ci->db->order_by('name', "ASC");
    $companies =  $ci->db->get()->result();
    
    $option = '<option value="0">'.$label.'</option>';
    foreach ($companies as $company) {
        $option .= '<option value="'. $company->com_id .'"';
        $option .=  ($company->com_id == $id) ? ' selected' : '';
        $option .= '>'. $company->name .'</option>';            
    }    
    return $option;
}
function getDropDownAdvice($id=0, $label = '--Select Advice--') {
    $ci =& get_instance();
    
    $ci->db->select('ad_id,advice');
    $ci->db->from('advice');
    $ci->db->order_by('advice', "ASC");
    $advices =  $ci->db->get()->result();
    
    $option = '<option value="0">'.$label.'</option>';
    foreach ($advices as $advice) {
        $option .= '<option>'.$advice->advice .'</option>';            
    }    
    return $option;
}
function getDropDownMedicine($id=0, $label = '--Select Medicine--') {
    $ci =& get_instance();
    
    $ci->db->select('med_id,name');
    $ci->db->from('medicine');
    $ci->db->order_by('name', "ASC");
    $medicines =  $ci->db->get()->result();
    
    $option = '<option value="0">'.$label.'</option>';
    foreach ($medicines as $medicine) {
        $option .= '<option>';
        //$option .=  ($medicine->med_id == $id) ? ' selected' : '';
        $option .= $medicine->name .'</option>';            
    }    
    return $option;
}
function getDropDownDosage($label = '--Select Dosage--') {
    $ci =& get_instance();
    
    $dosages =  array(
                        "0+0+1",
                        "0+1+0",
                        "1+0+0",
                        "1+0+1",
                        "1+1+0",
                        "0+1+1",
                        "1+1+1",
                        "1+1+1+1",
                    );
    
    $option = '<option value="0">'.$label.'</option>';
    foreach ($dosages as $dosage) {
        $option .= '<option>'. $dosage .'</option>';            
    }    
    return $option;
}

function getDropDownType($label = '--Select Type--') {
    $ci =& get_instance();
    
    $types =  array(
                        "Tablet",
                        "Capsule",
                        "Syrup",
                        "Injection",
                    );
    
    $option = '<option value="0">'.$label.'</option>';
    foreach ($types as $type) {
        $option .= '<option>'. $type .'</option>';            
    }    
    return $option;
}

function prescription_new_table($details){
    $new_table = '<table id="load_medicine" class="table table-hover table-bordered table-striped">
                    <tbody>
                    <tr>
                        <th width="80">Type</th>
                        <th width="100">Medicine</th>
                        <th width="100">Days</th>
                        <th width="100">Dosage</th>
                        <th width="100">Befor/After</th>
                        <th width="100">Action</th>
                    </tr>';
        foreach($details as $key=>$medicine) {
            ($medicine['when'] == 1) ? $when = '<span style="color:red; font-size:20px;">*</span>' : $when = "";
                   $new_table .= '<tr id="item_'.$key.'">
                        <td width="80">'. $medicine['type'] .'</td>
                        <td width="80">'. $medicine['name'].$when.'</td>
                        <td width="80">'. $medicine['days'].'</td>
                        <td width="80">'. $medicine['dosage'] .'</td>
                        <td width="80">'. $medicine['before_after'].'</td>
                        <td width="80"><a onclick="delete_item('.$key.');" class="delete_btn"><i class="fa fa-window-close" aria-hidden="true"></a></i></td>
                    </tr>';
                   }
    $new_table .= '</tbody></table>';
    return $new_table;
}

function treatment_cc_new_table($t_type, $details){
    //var_dump($details);
    $new_table = '<table id="load_'. $t_type .'" class="table table-hover table-bordered table-striped">
                    <thead>
                    <tr style="background: #4ce899;">
                        <th width="200">Teeth <span style="color: #fff;background: #000; padding: 2px 5px;border-radius: 10px;float: right;">'.$t_type.'</span></th>
                        <th width="100">Problem</th>
                        <th width="20">Action</th>
                    </tr>
                    </thead>
                    <tbody>';
        foreach($details as $key=>$treatment) {
                   $new_table .= '<tr id="'.$t_type.'_'.$key.'">
                        <td>
                            <div class="form-group">
                                <table class="table cross_teeth">
                                    <tr>
                                        <td>'. $treatment['teeth']['t_l'].'</td>
                                        <td>'. $treatment['teeth']['t_r'].'</td>
                                    </tr>
                                    <tr>
                                        <td>'. $treatment['teeth']['b_l'].'</td>
                                        <td>'. $treatment['teeth']['b_r'].'</td>
                                    </tr>
                                </table>
                            </div>    
                        </td>
                        <td>'.$treatment['problem'].'</td>
                        <td><a onclick="delete_treatment(\''.$t_type.'\', '.$key.');" class="delete_btn"><i class="fa fa-window-close" aria-hidden="true"></a></i></td>
                    </tr>';
                   }
    $new_table .= '</tbody></table>';
    return $new_table;
}


function getDropDownDays($label = '--Days--') {
    $ci =& get_instance();   
    $option = '<option value="0">'.$label.'</option>';
    for ($i=0; $i<=100; $i++) {
        $option .= '<option>'. $i .'</option>';            
    }
    return $option;
}


function getCompanyNameById($com_id){
    $ci =& get_instance();
    $ci->db->where("com_id", $com_id);
    $row = $ci->db->get("company")->row();
    return $row->name;
}

function getCategoryNameById($cat_id){
    $ci =& get_instance();
    $ci->db->where("cat_id", $cat_id);
    $row = $ci->db->get("category")->row();
    return $row->name;
}

function getMedicineNameById($med_id){
    $ci =& get_instance();
    $ci->db->where("med_id", $med_id);
    $row = $ci->db->get("medicine")->row();
    return $row->name;
}
