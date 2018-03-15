<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Parameter extends MX_Controller{
    function __construct(){
        parent::__construct();
        //Modules::run('Login/_login');
        $this->load->model('Mdl_siparameter');
    }
    public $_tbl_name   =   'si_parameter';
    public function index(){
        $controller         =   $this->router->class;
        $data['content']    =   $controller.'/siparameter';        
        $this->load->view('Template/template',$data);
    }
    public function getList(){
        $controller         =   $this->router->class;
        $table=$this->input->get('id');
        if($table=='general'){
            $where='is_active = 1 AND par_group="DEF_SET_NE"';
        }
        else{
            $where='is_active = 1 AND par_group="DEF_SET_E"';
        }
        $requestData= $_REQUEST;      
        $columns = array(
            0 => 'FirstName',
            1 => 'Company',
            2 => 'Phone'
        );
        $DB2 = $this->load->database('anotherdb', TRUE);

        // $this->db->select ('*');
        // $this->db->from ('login');
        // $result2 = $this->db->get()->result_array();

        // $dd = array_diff_assoc($result1, $result2);
        // print_r ( $dd );


        // $result=array_uintersect_uassoc($result1,$result2,"myfunction_key","myfunction_value");
        // //error_log(count($result).print_r($result,true));
        // //error_log(count($result).print_r(array_uintersect_assoc($result1, $result2),true));

        // $selection = array('AL', 'DZ');
        // $filtered = array_intersect_key($countries, array_flip($selection));
        // var_dump($filtered);

        $DB2->start_cache();
        // $this->db->select("*");
        // $this->db->from($this->_tbl_name);
        // $this->db->where($where);
        $DB2->select("*");
        $DB2->from("customers");
        $DB2->order_by($columns[$requestData['order'][0]['column']], $requestData['order'][0]['dir']);
        $totalData = $DB2->count_all_results();
        $i=0;
        foreach ($columns as $key => $value) {
         if(!empty($requestData['columns'][$i]['search']['value'])){
            $DB2->like($value, $requestData['columns'][$i]['search']['value']);
        }
        $i++;
        }
        $DB2->stop_cache();
        $totalFiltered = $DB2->count_all_results();
        $DB2->limit($requestData['length'], $requestData['start']);
        $query=$DB2->get()->result_array();
        $data = array();
        foreach($query as $key => $row){
            // $row['action']='<div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">';
            // $row['action'].='<a class="green" href="'.base_url($controller.'/action/'.$row['FirstName'].'').'"><i class="icon-pencil bigger-130"></i></a>';
            // $row['action'].='</div>';
            $nestedData=array();
            $nestedData[] = $row['FirstName'].'<input type="hidden" name="row_id" class="row_id" id="row_id" value="'.$row['FirstName'].'" />';
            $nestedData[] = $row['Company'];
            $nestedData[] = $row['Phone'];
            $nestedData[] = $row['Email'];                  
            $data[] = $nestedData;
        }      
        $json_data = array(
            "draw"            => intval( $requestData['draw'] ),   
            "recordsTotal"    => intval( $totalData ),  
            "recordsFiltered" => intval( $totalFiltered ), 
            "data"            => $data   
        );
    echo json_encode($json_data); 
    }
    public function action($id = null){
         if(MX_Controller::SuperAdmin == $this->session->userdata('role_id')) {
        $controller         =   $this->router->class;
        $id                 =   $this->uri->segment(3);
        if(!empty($id)){

            $data['result_set'] = $this->Mdl_siparameter->db_select('*',$this->_tbl_name,array('par_code'=>$id));
        }
        $data['content']    = $controller.'/action';
        $this->load->view('Template/template',$data); 
        }else{
        $update = array('Alert'=>'Sorry you don not have permission to edit parameter!','type'=>'');
        $this->session->set_flashdata('msg',$update);
        redirect(base_url().'Parameter','refresh'); 
        }   
    }
    public function command(){
        $id             =   $this->uri->segment(3);
        $controller     =   $this->router->class;
        $post           =   $this->input->post();
        date_default_timezone_set('UTC');
        $date           =   date('Y-m-d H:i:s');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->form_validation->set_rules('data', ' ', 'required|max_length[100]');
        if ($this->form_validation->run() == FALSE){
            $data['result_set']     = $post;
            $data['content']        = $controller.'/action';
            $this->load->view('Template/template',$data);
        }else{
            
            if(isset($post['status'])){$is_active = 1;}else{$is_active = 0;}
            if(isset($post['code'])){$code = $post['code'];}else{$code = str_pad($countRows, 6, '0', STR_PAD_LEFT);}
            $data   =   array(
                'par_data'           => $post['data'],
                'par_modifiedby'     => $this->session->userdata('id'),
                'par_modifiedwhen'   => $date
                
            );
            if($post['id']!=null){

                //// for log
                $primary_key = array(
                        'par_code' => $post['id']
                    );
                //// for log

             $this->OperationLog(current_url(), $data,$this->_tbl_name,"Mdl_siparameter",'update',$primary_key);
             
                $this->Mdl_siparameter->db_update(array('par_code'=>$post['id']),$this->_tbl_name,$data);//update query
                $par_group = $this->Mdl_siparameter->db_select('*',$this->_tbl_name,array('par_code'=>$post['id']));//select type for tab
                $par_group = $par_group[0]->par_group;
                $update = array('update'=>'your data successfully Updated','type'=>$par_group);
                $this->session->set_flashdata('msg',$update);
                redirect(base_url().$controller.'/','refresh');
            }else{
                redirect(base_url().$controller.'/','refresh');
            }
        }
    }
    public function get_parameter_title($code){
        return $this->Mdl_siparameter->db_select('par_data',$this->_tbl_name,array('par_code'=>$code))[0]->par_data;

    }
}
function myfunction_key($a,$b)
{
if ($a===$b)
  {
  return 0;
  }
  return ($a>$b)?1:-1;
}

function myfunction_value($a,$b)
{
if ($a===$b)
  {
  return 0;
  }
  return ($a>$b)?1:-1;
}
?>