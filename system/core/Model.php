<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2017, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2017, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	https://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Model Class
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		EllisLab Dev Team
 * @link		https://codeigniter.com/user_guide/libraries/config.html
 */
class CI_Model {

	/**
	 * Class constructor
	 *
	 * @return	void
	 */
	public function __construct()
	{
		log_message('info', 'Model Class Initialized');
	}

	// --------------------------------------------------------------------

	/**
	 * __get magic
	 *
	 * Allows models to access CI's loaded classes using the same
	 * syntax as controllers.
	 *
	 * @param	string	$key
	 */
	public function __get($key)
	{
		// Debugging note:
		//	If you're here because you're getting an error message
		//	saying 'Undefined Property: system/core/Model.php', it's
		//	most likely a typo in your model code.
		return get_instance()->$key;
	}
	public function _get_max_global($parameter,$table, $bg_code){
            
            
            $query = $this->db->query("SELECT MAX(`$parameter`) as '$parameter' FROM `$table` WHERE `bg_code` = '$bg_code' ");
//          $this->db->select_max($parameter);          
//          $this->db->like('bg_code',$bg_code);
//          $this->db->from($table);
            $result =  $query->result();
        
            return $result[0]->$parameter;
            
        }
    public function debug_r($_array,$exit){
        echo '<pre>';print_r($_array);
        echo '</pre>';
        if($exit > 0){
            exit;
        }
    }
    public function _get_max_result($columns, $table, $where){
        $this->db->select_max($columns);
        $this->db->from($table);
        $this->db->where($where);
        $query=$this->db->get();
         
        if($query->result()){
            return   $query->result()[0]->$columns+1;
        }else{
            return 1;
        }
    }
    public function db_command($data, $id ,$table){
        $now = date('Y-m-d H:i:s');
        
        if($id != null){
            $data['modified_date']  = $now;
            $data['modified_by']    = $this->session->userdata('id');
        }else{
            
            $data['created_date'] = $now;
            $data['created_by']   = $this->session->userdata('id');
        }
        
        // Insert
        if (empty($id)){
        	$this->db->trans_start();
           $save = $this->db->insert($table,$data); 
           if ($this->db->trans_status() === FALSE){
           	$this->db->trans_rollback();
           }else{
           $id = $this->db->insert_id();         
            $this->db->trans_complete();
           }
              
                 
        }else { 
        	$this->db->trans_start();        	
        	$this->db->where('id', $id);
        	$this->db->update($table, $data);         
      		$this->db->trans_complete();        		
    
        }
        return $id;  
    }
    public function db_delete($id,$table){
        $this->db->where($this->_primary_code, $id);
        $delete =  $this->db->delete($table);
        if($delete){
            return 1;
        }else{
            return 0;
        }
    }
    public function db_insert($table, $data){
        $this->db->trans_start();
        $insert =   $this->db->insert($table, $data);
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
        }else{
            $this->db->trans_complete();
            if($insert){
                return 1;
            }else{
                return 0;
            }
        }
    }
    public function db_update($where, $table, $data){
        $this->db->trans_start();
        $this->db->where($where);
        $update =   $this->db->update($table, $data);
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
        }else{
            $this->db->trans_complete();
            if($update){
                return 1;
            }else{
                return 0;
            }
        }
    }

    public function db_select($columns,$table,$where = null,$or_where = null, $wherein=null, $orderby=null, $groupby=null){
        $this->db->select($columns);
        $this->db->from($table);
        if($where!=null){
            $this->db->where($where);
        }
        if($or_where!=null){
            $this->db->or_where($or_where);
        }
        if($wherein!=null){
            $this->db->where_in($wherein);
        }
        if($orderby!=null){
            $this->db->order_by($orderby);
        }
        if($groupby!=null){
            $this->db->group_by($groupby);
        }
        $query = $this->db->get()->result();
        return $query;        
    }

    public function db_select_array($columns,$table,$where = null,$or_where = null, $wherein=null, $orderby=null){
        $this->db->select($columns);
        $this->db->from($table);
        if($where!=null){
            $this->db->where($where);
        }
        if($or_where!=null){
            $this->db->or_where($or_where);
        }
        if($wherein!=null){
            $this->db->where_in($wherein);
        }
        if($orderby!=null){
            $this->db->order_by($orderby);
        }
        $query = $this->db->get()->result_array();
        return $query;        
    }

    public function db_single_join($column, $table, $tbl_join, $condition, $joinType=null, $where=null,$orderBy=null){
        $this->db->select($column);
        $this->db->from($table);
        $this->db->join($tbl_join,$condition,$joinType);
        if($where!=null){
            $this->db->where($where);
        }
        $this->db->order_by($orderBy);
        $query = $this->db->get()->result();
        return $query;
    }
    public function db_get_multiple_join($columns, $from, $tbl_first_join, $first_join, $tbl_sec_join, $sec_join, $where, $groupby = null){
        $this->db->select($columns);
        $this->db->from($from);
        $this->db->join($tbl_first_join,$first_join);
        $this->db->join($tbl_sec_join,$sec_join);
        $this->db->where($where);
        if($groupby != null){
            $this->db->group_by($groupby);
        }
        $query = $this->db->get()->result();
        return $query;
    }
    public function db_delete_row($where, $table, $data){
        $this->db->where($where);
        $delete = $this->db->update($table, $data);
        if($delete){
            return 1;
        }else{
            return 0;
        }
    }
    public function db_change_status($where,$table,$data){
        $this->db->trans_start();
        $this->db->where($where);
        $update =   $this->db->update($table, $data);
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
        }else{
            $this->db->trans_complete();
            if($update){
                return 1;
            }else{
                return 0;
            }
        }
    }
    public function _get_code($columns, $table, $where = null, $array){
        $this->db->select($columns);
        if($where != null){
            $this->db->where($where);
        }
        $result =  $this->db->get($table)->result();
        if(count($result)){
            foreach($result as $res){
                $array[$res->code] = $res->title;
            }
        }
        return $array; 
    }
    
    public function _get_tbl_code($columns, $table, $array){
        $this->db->select($columns);
        if($array){
        $this->db->where($array);
        }
        $result =  $this->db->get($table)->result();
        return $result; 
    }
    
    public function _get_code_list($columns, $table, $where = null){
    	$this->db->select($columns);
        if($where !=null) {
    	   $this->db->where($where);
        }
    	return  $this->db->get($table)->result_array();
    	
    }
    public function _get_code_byparent($columns, $table ,$code ,$paramname){
    	$this->db->select($columns);
//     	$this->db->where('is_active',1);
    	$this->db->where($paramname,$code);
    	return  $this->db->get($table)->result_array();
    	error_log('test q '.print_r($this->db->last_query(),true) );
    	
    }
    
    public function _get_code_array($values, $array){
        $select = '';
        // get column values and add comma sepereted values
        foreach($values['column'] as $colum_key => $column){
            $select.= $column.',';
        }
        // remove last comma sepperated value from array
        $this->db->select(rtrim($select,','));
        if(!$values['where']==null){
            $this->db->where($values['where']);
        }
        // fetch as array
        $result =  $this->db->get($values['table'])->result_array();
        // return if value is greater than 0
        if(count($result)){
            foreach($result as $res_key => $value){
                // get Columns from Controller
                $code  = $values['code'];
                $title = $values['title'];
                // code array
                $code  = $value[$code];
                // title array
                $title = $value[$title];
                
                $array[$code] = $title;
            }
        }
        return $array; 
    }
    // row Count
    public function RowCount($table, $where){
        $this->db->group_start();
        $this->db->where($where);
        $this->db->group_end();
        $results= $this->db->count_all_results($table);
        return $results;
    }
    // user log
    public function checkinRecord($data){
    	$this->db->where($data);
    	$result =  $this->db->count_all_results('user_operation_log');
    	if($result>0){
    		return 0;
    	}else{
    		return 1;
    	}
    }
    
    public function _get_max($parameter,$table){
    	$this->db->select_max($parameter);
    	$this->db->from($table);
    	$query=$this->db->get();
    	$result =  $query->result_array();
    	return $result[0][$parameter];
    	
    }
    public function _get_max_plus($parameter,$table,$length,$where=null){
        $this->db->select_max($parameter);
        $this->db->from($table);
        if(!empty($where)){
            $this->db->Where($where);
        }
        $query=$this->db->get();
        $result =  $query->result_array();
        return str_pad ( $result[0][$parameter]+1, $length, '0', STR_PAD_LEFT );
        
    }
    public function send_mail($email,$subject,$message,$attachment=null)
    {
       $this->load->library('email');
    // $config['protocol']     = 'smtp';
    // $config['smtp_host']    = 'smtp.mailtrap.io';
    // $config['smtp_port']    = '2525';
    // $config['smtp_crypto']  = 'tls';
    // $config['smtp_user']    = '9b00ba9169d6e1';
    // $config['smtp_pass']    = '1e4951400ccfcf';
    // $config['charset']      = 'utf-8';
    // $config['newline']      = "\r\n";
    // $config['wordwrap']     = TRUE;
    // $config['mailtype']     = 'html';

     $config['protocol']     = 'smtp';
     $config['smtp_host']    = 'smtp.gmail.com';
     $config['smtp_port']    = '587';
     $config['smtp_crypto']  = 'tls';
     $config['smtp_user']    = 'it.dev12@dawateislami.net';
     $config['smtp_pass']    = '123pak123';
     $config['charset']      = 'utf-8';
     $config['newline']      = "\r\n";
     $config['wordwrap']     = TRUE;
     $config['mailtype']     = 'html';
     
     
     
     $this->email->initialize($config);
     
     $this->email->from('it.dev12@dawateislami.net','ERP Alert Notification');
     $this->email->bcc($email);
     
     $this->email->subject($subject);     
     $this->email->message($message);
     if($attachment!=null){
        $this->email->attach($attachment, 'attachment', 'report.pdf');
     }
        $this->email->send();

    }

}
