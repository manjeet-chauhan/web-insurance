<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

   function __construct() {
        parent:: __construct();
        $this->load->model('admin_model');
	      $this->lang->load('login');
        //check_user_logged();
   }

  public function all_users() {   
      $searchtext = $this->input->get('search');
      $page = $this->input->get('page'); 
      // $data['users'] = $this->admin_model->get_user_profile($searchtext, $page);   
      $data['users'] = $this->admin_model->company();   
      $data['view']='index';
      $this->load->view('backend/admin-layout', $data);
  }

   public function add_company(){
       
      $this->form_validation->set_rules('company_name', 'Comapny Name', 'required');
      // $this->form_validation->set_rules('company_logo', 'Comapny Logo', 'required');
      $this->form_validation->set_rules('company_phone', 'Comapny Phone No', 'required');
    
      if ($this->form_validation->run() == TRUE) { 

        $filename=time() . date('Ymd');
        $profileimage='';
        if(isset($_FILES['company_logo'])&&$_FILES['company_logo']['error']=='0'){
          $config = array(
            'upload_path' => "assets/admin/images",
            'allowed_types' => "gif|jpg|png|jpeg",
            'overwrite' => TRUE,
            'max_size' => "2048000",
            'file_name' => $filename
          );
          $this->load->library('upload', $config);
          if($this->upload->do_upload('company_logo')){
            $data = array('upload_data' => $this->upload->data());
            $profileimage=$data['upload_data']['file_name'];
          }
          else {
            $error = array('error' => $this->upload->display_errors());
            echo $error['error'];die;
          }
        }else{
            $company_id = $this->input->post('editcompanyid');

            if(!empty($company_id)){


                echo 'Comapny Logo is required.';
                exit();
        }

        }



         
         $ret_date = $this->admin_model->add_company($profileimage);
         if(empty($ret_date )){
            echo "error";
            exit();
         }

         echo "success";
         exit();
      }
      else{
         echo validation_errors();
        exit();
      }
      echo "error";
   }
   
   public function remove_company(){
       
      
    
         
         $ret_date = $this->admin_model->remove_company();
         if(empty($ret_date )){
            echo "error";
            exit();
         }

         echo "success";
         exit();
      
      echo "error";
   }
   
   
   public function csv_format($company_id=NULL) {   
        $data['company_code_id'] = $company_id; 
       $data['csv_format_data'] = $this->admin_model->csv_format_data($company_id);   
      $data['company'] = $this->admin_model->company();   
      $data['view']='csv-format';
      $this->load->view('backend/admin-layout', $data);
  }


public function add_csv_format() {   
      $searchtext = $this->input->get('search');
      $page = $this->input->get('page'); 
      // $data['users'] = $this->admin_model->get_user_profile($searchtext, $page);   
      $data['company'] = $this->admin_model->company();   
      $data['view']='add-csv-format';
      $this->load->view('backend/admin-layout', $data);
  }



public function save_csv_format() {   
     
     $this->form_validation->set_rules('company_code', 'Company', 'required');
    //  $this->form_validation->set_rules('listdata', 'CSV Format', 'required');
    
      if ($this->form_validation->run() == TRUE) { 
        
        $listdata = $this->input->post('listdata');
        
         if(!empty($listdata) && $listdata != "[]"){
                // $jsondata = json_decode($listdata);
                $sheetarray=[];
                foreach($listdata as $key=>$sheetdata){
                  
                    
                    if(is_array($sheetdata)){
                        foreach($sheetdata as $key=>$data){
                            if($key=='v'){
                              array_push($sheetarray,$data);    
                            }
                            
                        }
                    }
                }
                
                
          $jsondata = json_encode($sheetarray);
            $company_code = $this->input->post('company_code');     
           $checkdata = checkSheetFormat($company_code,$jsondata);
         
           if(!empty($checkdata)){
               
               echo 'This csv Format is already exist.';
               exit();
           }else{
         $ret_date = $this->admin_model->save_csv_format($jsondata);
         if(empty($ret_date )){
            echo "error";
            exit();
            }
         
          }
         
      }else{
          echo "error";
            exit(); 
      }

         echo "success";
         exit();
      }
      else{
         echo validation_errors();
        exit();
      }
      echo "error";
  }

  
  
 public function csv_data($company_id=NULL) {   
        $data['company_code_id'] = $company_id; 
      $data['csv_datas'] = $this->admin_model->csv_data($company_id);   
      $data['company'] = $this->admin_model->company();   
      $data['view']='csv-data';
      $this->load->view('backend/admin-layout', $data);
  }


public function view_csv_data($company_id=NULL,$id=NULL) {   
        if(empty($company_id) || empty($id)){
            // redirect('admin/CSV-Data');
            
        }
    
        $data['company_code_id'] = $company_id; 
      $data['csv_datas'] = $this->admin_model->view_csv_data($company_id,$id);   
       
      $data['view']='view-csv-data';
      $this->load->view('backend/admin-layout', $data);
  }


public function landing_page() {   
   
      $data['csv_datas'] = $this->admin_model->get_landing_page();   
       
      $data['view']='Landing-page-setting';
      $this->load->view('backend/admin-layout', $data);
  }




public function save_page_setting() {   
        
        // $this->form_validation->set_rules('company_code', 'Company', 'required');
        $this->form_validation->set_rules('main_title', 'Main Title', 'required');
        $this->form_validation->set_rules('title_1', 'First Title', 'required');
        $this->form_validation->set_rules('desc_1', 'First Description', 'required');
        $this->form_validation->set_rules('title_2', 'Second Title', 'required');
        $this->form_validation->set_rules('desc_2', 'Second Description', 'required');
        $this->form_validation->set_rules('title_3', 'Third Title', 'required');
        $this->form_validation->set_rules('desc_3', 'Third Description', 'required');
        // $this->form_validation->set_rules('banner', 'Page Banner', 'required');
    //  $this->form_validation->set_rules('listdata', 'CSV Format', 'required');
    
      if ($this->form_validation->run() == FALSE)   {
          $data['msg'] = validation_errors();


      }else{

        $filename=time() . date('Ymd');
        $profileimage='';
        if(isset($_FILES['banner'])&&$_FILES['banner']['error']=='0'){
          $config = array(
            'upload_path' => "assets/admin/images",
            'allowed_types' => "gif|jpg|png|jpeg",
            'overwrite' => TRUE,
            'max_size' => "2048000",
            'file_name' => $filename
          );
          $this->load->library('upload', $config);
          if($this->upload->do_upload('banner')){
            $data = array('upload_data' => $this->upload->data());
            $profileimage=$data['upload_data']['file_name'];
          }
          
        }

        $updated = $this->admin_model->save_page_setting($profileimage);
        $data['msg'] = 'Page Details Successfully Updated.';
        
      }
        $this->session->set_flashdata($data);
        $this->landing_page();
       

  }

   























}

