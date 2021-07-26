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
function getDropDownType($id=0, $label = '--Select Type--') {
    $ci =& get_instance();
    
    $types =  array(
                        "Tablet",
                        "Capsule",
                        "Syrup",
                        "Injection",
                    );
    
    $option = '<option value="0">'.$label.'</option>';
    foreach ($types as $type) {
        $option .= '<option "';
        $option .=  ($type == $id) ? ' selected' : '';
        $option .= '>'. $type .'</option>';            
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