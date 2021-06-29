<?php

if (!defined('BASEPATH')) {
    exit('No Direct Script access allowed');
}

class Admin_model extends CI_Model {

    private $tbl_name = 'tbl_login';    
    private $user_name;    
    private $password;    
    private $email;
    
    function __construct() {
        parent::__construct();
    }

    public function company() {
        $this->db->select('*');
        $this->db->from('csv_company');        
       
        
        $this->db->where('is_del',0);
        $this->db->order_by("creation_date","desc");
        return $this->db->get()->result();
    }


public function add_company($profileimage){
    $company_name = $this->input->post('company_name');
    $company_logo = $profileimage;
    $company_phone = $this->input->post('company_phone');

    $company_id = $this->input->post('editcompanyid');
    
        
        if(!empty($company_id)){
            $data = array(
        'company_name' => $company_name,
        'company_phone' => $company_phone,
        'company_logo' => $company_logo,
        'modification_date' => date('Y-m-d H:i:s'),
        );
        
               $this->db->where('id',$company_id);
               $this->db->update('csv_company',$data);
               return $this->db->affected_rows();
        
        }
        
        $data = array(
        'company_name' => $company_name,
        'company_code' => "INSU".rand(100000,999999),
        'company_phone' => $company_phone,
        'company_logo' => $company_logo,
        'creation_date' => date('Y-m-d H:i:s'),
        'modification_date' => date('Y-m-d H:i:s'),
        );
        
        return $this->db->insert('csv_company',$data);
}
  
  
  
public function remove_company(){
    $company_id = $this->input->post('deleteusrid');
    $data = array(
        'is_del' =>1,
        'modification_date' => date('Y-m-d H:i:s'),
        );
        
             $this->db->where('id',$company_id);
         $this->db->update('csv_company',$data);
         return $this->db->affected_rows();
}

public function save_csv_format($jsondata){
    $company_code = $this->input->post('company_code');

    
    $data = array(
            'company_code' => $company_code,
            'csv_format' => $jsondata,
            'creation_date' => date('Y-m-d H:i:s'),
            'modification_date' => date('Y-m-d H:i:s'),
        );
        
        return $this->db->insert('csv_company_format',$data);
    
}

public function csv_format_data($company_id){
    
    
    if(!empty($company_id)){
        $this->db->where('company_code',$company_id);
    }
    
    $this->db->where('status',1);
    $this->db->order_by("creation_date","desc");
    return $this->db->get('csv_company_format')->result();
  
}
    
    
    public function csv_data($company_id){
    
    
    if(!empty($company_id)){
        $this->db->where('company_code',$company_id);
    }
    
    // $this->db->where('status',1);
    $this->db->order_by("created_on","desc");
    return $this->db->get('csv_data')->result();
  
}


public function view_csv_data($company_id,$id){
    
 
        $this->db->where('id',$id);
        $this->db->where('company_code',$company_id);

    return $this->db->get('csv_data')->row();
  
}
   


public function get_landing_page(){
    
    return $this->db->get('csv_landing_page_setting')->row();
  
}
    



public function save_page_setting($profileimage){
    
    $data = array(
        'main_title' => $this->input->post('main_title'),
        'title_1' => $this->input->post('title_1'),
        'desc_1' => $this->input->post('desc_1'),
        'title_2' => $this->input->post('title_2'),
        'desc_2' => $this->input->post('desc_2'),
        'title_3' => $this->input->post('title_3'),
        'desc_3' => $this->input->post('desc_3'),
        
  
    );

    if(!empty($profileimage)){
        $data['banner'] = $profileimage;
    }

    $this->db->where('id',1);
    return $this->db->update('csv_landing_page_setting',$data);

  
}
    





  
}

