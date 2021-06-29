<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
// ------------------------------------------------------------------------

    

/**
 * @access  public
 * @param   mixed   Script src's or an array
 * @param   string  language
 * @param   string  type
 * @param   string  title
 * @param   boolean should index_page be added to the script path
 * @return  string
 */
 // mail function ----
 function send_mail($email,$subject,$message){

    // print_r($message);
   //echo 'emailid - '.$email;  echo ' Subject -'. $subject; echo $message;  die;   
    $from = "manjeet@webitexperts.com";
    $sender_name = "Freelancer";
    $ci = &get_instance();
    $config = Array(
        'mailpath' => '/usr/sbin/sendmail',
        'protocol' => 'sendmail',
        'smtp_host' => 'mail.webitexperts.com',
        'smtp_port' => '587',
        'smtp_user' => 'manjeet@webitexperts.com',
        'smtp_pass' => ';5?U]wtLtDi6',
        'mailtype'  => 'html', 
        'charset'   => 'iso-8859-1',
    );
    $ci->load->library('email');    
    $ci->email->initialize($config);
    $ci->email->from($from, $sender_name);
    $ci->email->to(trim($email));           
    $ci->email->subject($subject);
    $ci->email->message($message);
    if($ci->email->send()){
        return true;
    }else{
        return false;
    }   
}

function get_sallon_images($id){
    $ci =& get_instance();
    $sql = "SELECT * FROM tbl_saloon_images WHERE uid = '$id'";
    $query = $ci->db->query($sql);
    return $row = $query->result();
}


function getIdByUniqueCode($uniquecode){
    $ci =& get_instance();
    $sql = "SELECT * FROM category WHERE unique_code = '$uniquecode'";
    $query = $ci->db->query($sql);
    return $row = $query->row();
}

function getTemplateIdByUniqueCode($uniquecode){
    $ci =& get_instance();
    $sql = "SELECT * FROM template WHERE unique_code = '$uniquecode'";
    $query = $ci->db->query($sql);
    return $row = $query->row();
}

       
function getTestimonials(){
    $ci =& get_instance();
    $sql = "SELECT * FROM testimonials WHERE status = 1 ORDER BY id DESC";
    $query = $ci->db->query($sql);
    return $row = $query->result();
}
     
function get_templates($category_id){

    $ci =& get_instance();
    $ci->db->where('category_id', $category_id);
    $ci->db->select('*');
    $ci->db->from('template');
    $query = $ci->db->get();
    return $result = $query->result_array();
}

function get_home_page_contents(){

    $ci =& get_instance();
    $ci->db->select('*')->from('home_page_content');
    $ci->db->where('id', 1);
    $homecontents = $ci->db->get()->row();
    return $homecontents;
}

function get_category(){

    $ci =& get_instance();
    $ci->db->select('*');
    $ci->db->from('category');
    $query = $ci->db->get();

    return $result = $query->result_array();
}


function get_page_settings() {
    $ci =& get_instance();   
    $ci->db->select('*')->from('settings');
    $ci->db->where('id', 1);
    return $ci->db->get()->row();
}


function paypalconfig($API_USERNAME, $API_PASSWORD, $API_SIGNATURE, $PROXY_HOST, $PROXY_PORT, $IS_ONLINE = FALSE, $USE_PROXY = FALSE, $VERSION = '57.0')
    {
        

        $API_USERNAME = $API_USERNAME;
        $API_PASSWORD = $API_PASSWORD;
        $API_SIGNATURE = $API_SIGNATURE;
        $API_ENDPOINT = 'https://api-3t.sandbox.paypal.com/nvp';
        $USE_PROXY = $USE_PROXY;
        if($USE_PROXY == true)
        {
            $PROXY_HOST = $PROXY_HOST;
            $PROXY_PORT = $PROXY_PORT;
        }
        else
        {
            $PROXY_HOST = '127.0.0.1';
            $PROXY_PORT = '808';
        }
        if($IS_ONLINE == FALSE)
        {
            $PAYPAL_URL = 'https://www.sandbox.paypal.com/webscr&cmd=_express-checkout&token=';
        }
        else
        {
            $PAYPAL_URL = 'https://www.paypal.com/webscr&cmd=_express-checkout&token=';
        }
        

        $VERSION = $VERSION;
    }


    function hash_call($methodName,$nvpStr)
    {

        $PROXY_HOST = '127.0.0.1';
        $PROXY_PORT = '808';
       
        $API_ENDPOINT = 'https://api-3t.sandbox.paypal.com/nvp';
        $VERSION = '57.0';
        $API_PASSWORD = 'QFZCWN5HZM8VBG7Q';
        $API_USERNAME = 'sdk-three_api1.sdk.com';
        $API_SIGNATURE = 'A.d9eRKfd1yVkRrtmMfCFLTqa6M9AyodL0SJkhYztxUi8W9pCXF6.4NI';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$API_ENDPOINT);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_POST, 1);
        if($USE_PROXY)
        {
            curl_setopt ($ch, CURLOPT_PROXY, $PROXY_HOST.":".$PROXY_PORT); 
        }
        $nvpreq="METHOD=".urlencode($methodName)."&VERSION=".urlencode($VERSION)."&PWD=".urlencode($API_PASSWORD)."&USER=".urlencode($API_USERNAME)."&SIGNATURE=".urlencode($API_SIGNATURE).$nvpStr;
        curl_setopt($ch,CURLOPT_POSTFIELDS,$nvpreq);
        $response = curl_exec($ch);
        $nvpResArray= @deformatNVP($response);
        $nvpReqArray= @deformatNVP($nvpreq);
        $_SESSION['nvpReqArray']=$nvpReqArray;
        if (curl_errno($ch))
        {
            die("CURL send a error during perform operation: ".curl_errno($ch));
        } 
        else 
        {
            curl_close($ch);
        }

    return $nvpResArray;
    }

    function deformatNVP($nvpstr)
    {

        $intial=0;
        $nvpArray = array();
        while(strlen($nvpstr))
        {
            $keypos= strpos($nvpstr,'='); 
            $valuepos = strpos($nvpstr,'&') ? strpos($nvpstr,'&'): strlen($nvpstr); 
            $keyval=substr($nvpstr,$intial,$keypos);
            $valval=substr($nvpstr,$keypos+1,$valuepos-$keypos-1);
            $nvpArray[urldecode($keyval)] =urldecode( $valval);
            $nvpstr=substr($nvpstr,$valuepos+1,strlen($nvpstr));
         }
        return $nvpArray;
    }


    function getServiceDetails($order_id){
    $ci =& get_instance();   
        
        $ci->db->where('booking_id',$order_id);
        return $ci->db->get('user_services')->result();
    }
    
    
    
    
    
    function checkSheetFormat($company_code,$jsondata){
         $ci =& get_instance();   
        
        $ci->db->where('company_code',$company_code);
        // $ci->db->where('csv_format',$jsondata);
        $ci->db->where('status',1);
        $result = $ci->db->get('csv_company_format')->result();
        
        $csvdata = json_decode($jsondata);
        
        foreach($result as $data){
            $company_csv = json_decode($data->csv_format);
            if(count($csvdata)==count($company_csv)){

            if(empty(array_diff($csvdata,$company_csv))){
                
            return 'exist';
   
             }
             
            }
        }
        
        return ;
    }

