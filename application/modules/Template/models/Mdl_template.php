<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Mdl_template extends CI_Model {
        protected $_table_name     = 'login';
        protected $_order_by       = 'id';
        protected $_primary_column = 'id';
        function __construct(){
            parent::__construct();
        }
        public function get_all_parents(){
		
			$this->db->distinct();
		    $this->db->select('parent_id');
			$this->db->where('is_enable',1); 
			
			$this->db->order_by('id','asc');
			$this->db->from('admin_module_list');
			$query  =  $this->db->get();
			$result = $query->result();
			$parents = array();
			foreach ($result as $row)
			   $parents[$row->parent_id] =  $row->parent_id ;
			return $parents;
        } 
		
		
		public function get_all_childs($parent){
			$this->db->select('*'); 
			$this->db->where('is_enable',1); 
			$this->db->where('parent_id',$parent); 
			$this->db->order_by('sort_order','asc');
			$this->db->from('admin_module_list');
			$query  =  $this->db->get();
			$result = $query->result();
			$childs = array();
			
			foreach ($result as $row)
				$childs[] =  $row->id ;

			return $childs;
        } 
		public function get_all_permissions()
		{
			$this->db->select('permission'); 
			$this->db->where('userid',$this->session->userdata('id')); 
			$query  =  $this->db->get('admin_module_permission');
			$result = $query->result();
			return $result[0]->permission;
        } 
		public function get_all_modules_list()
		{	
			$query  =  $this->db->get('admin_module_list', array('is_enable'=>1));
			$result = $query->result();
			return $result;
        } 
}
?>
