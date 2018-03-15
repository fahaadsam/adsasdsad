<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Template extends MX_Controller  {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct(){
        parent::__construct();
        $this->load->model('Mdl_template');
    } 
	public function index(){
     
 	}
	public function switchLanguage(){
		$language=$this->input->post("lang_id");
        $language = ($language != "") ? $language : "english";
        $this->session->set_userdata('site_lang', $language);
        redirect(base_url());
    }

	public function multilevelMenu($parentId,$controller, $ctgLists, $ctgData){
        $html = '';
        if(isset($ctgLists[$parentId])){
            $html = '<ul style="list-style: none; padding: 5px 0 0 20px;">';
            foreach ($ctgLists[$parentId] as $childId){
                //echo $ctgData[$childId]['controller'].'--'.$this->uri->segment(1)."<br />";
                if(isset($ctgData[$childId]['controller'])){
                    if($ctgData[$childId]['controller'] == $this->uri->segment(1)){
                        $a = $this->uri->segment(1);
                        $html.= '<li  class="collapse in child-items active '.$ctgData[$childId]['controller'].' , '.$a.' ">';
                    }else
                        $html.= '<li class="child-items">';
                }else
                    $html.= '<li class="child-items">';
                
                if(isset($ctgData[$childId])){
                    if( $ctgData[$childId]['controller'] !=NULL ){  
                    	
                            $html.= '<a href="'.base_url().$ctgData[$childId]['controller'].'/'.$ctgData[$childId]['function'].'" class="waves-effect ">';
                           
                    }else
                        $html.= '<a href="#" class="waves-effect ">';
                        $html.= '<i class="'.$ctgData[$childId]['mdl_icon'].'" data-icon="v"></i>';
                        $html.= '<span class="menu-text"> '.$ctgData[$childId]['mdl_name'].' </span>';
                        $html.=' </a>';
                }
                $html .= $this->multilevelMenu($childId,$controller, $ctgLists, $ctgData);     // re-calls the function to find parent with child-items recursively
                $html .= '</li>';
            }
            $html .= '</ul>';
        }
        return $html;
    }
	

    public function sidebar($controller,$view){
		
		
		$menu_permission = json_decode($this->session->userdata('menu_permission'));
		foreach($menu_permission as $key=>$value)
		{	
			$menu_permission_tmp[$key]=$value;
		}	$menu_permission = $menu_permission_tmp;
		$permission =$menu_permission;
		$module_list = $this->Mdl_template->get_all_modules_list();
		$id = "";
		
		$url= explode("/",$this->uri->uri_string());

		//print_r($controller);
		$controller = $url[0];
		if(isset($url[1]))
			$function = $url[1];
		else 
			$function = "";
		
		//echo $controller.$function;
		//print_r($module_list);
	
		foreach($module_list as $row)
		{
			if($row->controller==$controller  )
			{
				
				if($function!="")
				{
		
					if($row->function==$function)
					{
					
						$id = $row->id;
					}
					else
					{
						$id = $row->id;
					}
				}
				else
				{
					$id = $row->id;	
				}
			}
			
			
		}

		if(MX_Controller::SuperAdmin != $this->session->userdata('role_id')){
			$match=0;
			
			foreach ( $permission as $key=>$value)
			{
				if($key==$id)
				{
					$match=1;
				}
			}
			
			if($match==0)
			{
	                    redirect(base_url().'Dashboard','refresh');
			}	
		}

		$this->db->select('*');
        
        $this->db->order_by('id','asc');
        $this->db->from('admin_module_list');
        $query  =  $this->db->get();
        $result = $query->result();
        $menu='';
        $menu_retun='';


		$parents 	 = $this->Mdl_template->get_all_parents();
		$ctgLists 	 = array();
		$ctgLists[0] = $parents; 
		
		foreach ( $parents as $row)
			$ctgLists[$row] = $this->Mdl_template->get_all_childs($row);
		
		

		$result1    = array();
		$a=1;
		$result1[0] = array('lname' => 'Root','lurl' => '#'); 	$permission[0]=1;                                                                             
		
		foreach ( $result as $row)
		{
			//&& isset($permission[$row->parent_id])
			
			if(MX_Controller::SuperAdmin == $this->session->userdata('role_id')){

							$result1[$a] = array(
								"id" 		 => $row->id ,
								"sort_order" => $row->sort_order,
								"parent_id" => $row->parent_id,
								"ref_controller" => $row->ref_controller,
								"controller" => $row->controller,
								"function" => $row->function,
								"mdl_name" => $row->mdl_name,
								"mdl_icon" => $row->mdl_icon,
								"mdl_heading" => $row->mdl_heading,
								"prefix" => $row->prefix,
								"c_view" => $row->c_view,
								"c_add" => $row->c_add,
								"c_edit" => $row->c_edit,
								"c_delete" => $row->c_delete,
								"is_super" => $row->is_super,
								"is_enable" => $row->is_enable,
								"created_date" => $row->created_date,
								"created_by" => $row->created_by
							);
						
			}else{

				if(isset($permission[$row->id])   )
				{
				
					if(isset($permission[$row->id]) && (isset($permission[$row->parent_id]) )   )
					{	

						if($row->is_enable ==1 && $permission[$row->id]==1 && $permission[$row->parent_id]==1  )
						{
							$result1[$a] = array(
								"id" 		 => $row->id ,
								"sort_order" => $row->sort_order,
								"parent_id" => $row->parent_id,
								"ref_controller" => $row->ref_controller,
								"controller" => $row->controller,
								"function" => $row->function,
								"mdl_name" => $row->mdl_name,
								"mdl_icon" => $row->mdl_icon,
								"mdl_heading" => $row->mdl_heading,
								"prefix" => $row->prefix,
								"c_view" => $row->c_view,
								"c_add" => $row->c_add,
								"c_edit" => $row->c_edit,
								"c_delete" => $row->c_delete,
								"is_super" => $row->is_super,
								"is_enable" => $row->is_enable,
								"created_date" => $row->created_date,
								"created_by" => $row->created_by
							);
						}
					}
				}
			}
			$a ++;
		}
		$ctgData = $result1;
		echo $this->multilevelMenu(0,$controller, $ctgLists, $ctgData);
	}
	public function sidebar1($controller, $view) {
		$_permission = json_decode ( $this->session->userdata ( 'permission' ) );
		$permission = json_decode ( json_encode ( $_permission ), True );
		
		// fetch module list
		$this->db->select ( '*' );
		$this->db->where ( 'is_enable', 1 );
		if ($this->session->userdata ( 'user_type' ) != 1) {
			$this->db->where ( 'is_super', 0 );
		} else {
			$this->db->where ( 'is_super !=', 2 );
		}
		$this->db->order_by ( 'sort_order', 'asc' );
		$this->db->from ( 'admin_module_list' );
		$query = $this->db->get ();
		$result = $query->result ();
		$menu = '';
		$menu_retun = '';
		
		foreach ( $result as $res ) :
			if ($res->parent_id == 0) :
				if (isset ( $permission [$res->id] ) && $permission [$res->id] ['v'] == 1) {
					if ($res->controller != null && $res->ref_controller == null && $res->function == null) :
						$menu .= '<a href="' . base_url ( $res->controller ) . '/' . $res->function . '" class="waves-effect active">';
						$menu .= '<i class="' . $res->mdl_icon . '" data-icon="v"></i>';
						$menu .= '<span class="menu-text"> ' . $res->mdl_name . ' </span>';
						$menu .= ' </a>';
					 elseif ($res->controller == null && $res->ref_controller == null && $res->function == null) :
						$menu .= '<a href="#" class="dropdown-toggle">';
						$menu .= '<i class="icon-list"></i>';
						$menu .= '<span class="fa arrow"></span>';
						$menu .= '<span class="menu-text"> ' . $res->mdl_name . '</span>';
						$menu .= '</a>';
					endif;
					$id = $res->id;
					$submenu = $this->get_child ( $result, $id, $controller, $view );
					$menu .= $submenu;
					if ($res->controller == $controller || strpos ( $submenu, 'class="active"' ) !== false) :
						$menu_retun .= '<li class="active">' . $menu . '</li>';
					else :
						$menu_retun .= '<li class="">' . $menu . '</li>';
					endif;
					$menu = null;
				}
            endif;
        endforeach;
        echo $menu_retun;
    }
	
	
	
	
	
	
	
	
	
	
	
	

    function get_child($items, $id,$controller,$view){
        $submenu        =   '';
        $innersub       =   '';
        $_permission = json_decode($this->session->userdata('permission')); 
        $permission  = json_decode(json_encode($_permission), True);
        if($view == null):
            $view = 'null';
        else:
            $view_explode = explode('_',$view);
            if( empty( $view_explode[1] ) ):
                $view = 'null';
            endif;
			
		endif;
		$menu_retun = '';
		foreach ( $items as $item ) {
			if ($item->parent_id == $id) {
				if (isset ( $permission [$item->id] ) && $permission [$item->id] ['v'] == 1) {
					if ($item->controller == null && $item->ref_controller == null && $item->function == null) :
						$submenu .= '<a href="#" class="dropdown-toggle">';
						$submenu .= '<i class="' . $item->mdl_icon . '" data-icon="v"></i>';
						$submenu .= '<span class="menu-text"> ' . $item->mdl_name . '</span>';
						$submenu .= '<span class="fa arrow"></span>';
						$submenu .= ' </a>';
						$id = $item->id;
						$innersub = $this->get_inner_child ( $items, $id, $controller, $view );
						$submenu .= $innersub;
					 elseif ($item->controller != null && $item->ref_controller == null) :
						if ($id == 14 && $count_custom_coount == null) {
							$count_custom_coount = 1;
							$submenu .= '<a href="' . base_url ( $item->controller . '/twelve_nikat' ) . '">';
							$submenu .= '<i class="' . $item->mdl_icon . '"></i>';
							$submenu .= '<span class="menu-text"> ' . 'add_new_performance' . ' </span>';
							$submenu .= ' </a>';
						}
						$submenu .= '<a href="' . base_url ( $item->controller . '/' . $item->function ) . '">';
						$submenu .= '<i class="' . $item->mdl_icon . '"></i>';
						$submenu .= '<span class="menu-text"> ' . $item->mdl_name . ' </span>';
						$submenu .= ' </a>';
					endif;
					if (strpos ( $innersub, 'class="active"' ) !== false || $item->controller == $controller) :
						$menu_retun .= '<li class="active" >' . $submenu . '</li>';
					else :
						$menu_retun .= '<li class="">' . $submenu . '</li>';
					endif;
					$submenu = null;
					$innersub = null;
				}
			}
		}
		if ($menu_retun != null) :
			return '<ul class="nav nav-second-level">' . $menu_retun . '</ul>'; 
        endif;
		
	}
	public function get_inner_child($items, $id, $controller, $view) {
		$submenu = '';
		$menu_retun = '';
		$_permission = json_decode ( $this->session->userdata ( 'permission' ) );
		$permission = json_decode ( json_encode ( $_permission ), True );
		foreach ( $items as $item ) {
			if ($item->parent_id == $id) {
				
				if (isset ( $permission [$item->id] ) && $permission [$item->id] ['v'] == 1) {
					if ($item->controller == null && $item->ref_controller != null && $item->function != null) :
						$submenu .= '<a href="' . base_url ( $item->ref_controller . '/' . $item->function ) . '">';
						$submenu .= '<i class="' . $item->mdl_icon . '" data-icon="v"></i>';
						$submenu .= '<span class="menu-text"> ' . $item->mdl_name . ' </span>';
						$submenu .= ' </a>';
                    endif;
					
					if ($item->function == $view) :
						$menu_retun .= '<li class="active" >' . $submenu . '</li>';
					else :
						$menu_retun .= '<li class="" >' . $submenu . '</li>';
					endif;
					$submenu = null;
				}
			}
		}
		if ($menu_retun != null) :
			return '<ul class="nav nav-third-level">' . $menu_retun . '</ul>'; 
        endif;
		
	}
	public function FormsContent() {
		$user = $this->session->userdata ();
		$conditions = array (
				'sct_userid' => $user ['id'],
				'bg_code' => $user ['bg_code'],
				'le_code' => $user ['le_code'],
				'ou_code' => $user ['ou_code'],
				'sct_screen_name' => $this->uri->segment ( 1 ),
				// 'sct_section_name'=>$this->uri->segment(2),
				'is_active' => 1 
		);
		$desk = $this->Mdl_template->db_select ( '*', 'si_screen_titles', $conditions );
		if ($_POST) {
			$conditions ['sct_screen_name'] = $_POST ['UrlParameter'];
			// $conditions['sct_section_name'] = $_POST['UrlPage'];
			if (! empty ( $_POST ['id'] )) {
				$conditions ['id'] = $_POST ['id'];
				$this->Mdl_template->db_update ( $conditions, 'si_screen_titles', array (
						'sct_title_text' => $_POST ['titletext'] 
				) );
			} else {
				$conditions ['sct_title_text'] = $_POST ['titletext'];
				$conditions ['sct_title_name'] = $_POST ['titlename'];
				$this->Mdl_template->db_insert ( 'si_screen_titles', $conditions );
			}
		}
		return $desk;
	}
	public function gennext() {
		$data ['mask_set'] = $this->Mdl_template->db_select ( 'par_data', 'si_parameter', array (
				'par_code' => $_POST['maskcode'] 
		) );
		$mask = $data ['mask_set'] [0]->par_data;
		
		$ex = explode ( '-', $mask );
		
		$tlcode = $this->Mdl_template->db_select ( '*', $_POST ['tbl_name'], array (
				$_POST ['column_name'] => $_POST ['itemcode'] 
		) );
		
		$parameter = $_POST ['column_name'];
		$table = $_POST ['tbl_name'];
		$per = $_POST ['itemcode'];
		$lvlcolumn = $_POST['lvl_column'];
		
		$lvl = $tlcode [0]->$lvlcolumn;
		
		$slash = array ();
		foreach ( $ex as $e ) {
			array_push ( $slash, strlen ( $e ) );
		}
		$total = array ();
		$total [0] = $slash [0];
		if (! empty ( $slash [1] ))
			$total [1] = $slash [0];
		if (! empty ( $slash [2] ))
			$total [2] = $slash [0] + $slash [1];
		if (! empty ( $slash [3] ))
			$total [3] = $slash [0] + $slash [1] + $slash [2];
		if (! empty ( $slash [4] ))
			$total [4] = $slash [0] + $slash [1] + $slash [2] + $slash [3];
		if (! empty ( $slash [4] ))
			$total [4] = $slash [0] + $slash [1] + $slash [2] + $slash [3] + $slash [4];
		if (! empty ( $slash [5] ))
			$total [5] = $slash [0] + $slash [1] + $slash [2] + $slash [3] + $slash [4] + $slash [5];
		
		$close = substr ( $per, 0, - $total [$lvl - 1] );
        if($lvl==1){
            $query = $this->db->query ( "SELECT MAX(`$parameter`)+1 as '$parameter' FROM `$table` WHERE `$lvlcolumn` = $lvl" );
        }else{
        $query = $this->db->query ( "SELECT MAX(`$parameter`)+1 as '$parameter' FROM `$table` WHERE `$parameter` LIKE '$close%' AND `$lvlcolumn` = $lvl" );
        }
		$result = $query->result ();
		$data = $result [0]->$parameter;
		
		$memo = str_pad ( $data, strlen ( $per ), '0', STR_PAD_LEFT );
		

		if (strlen($memo) === $slash[0]){
		    $code = $memo;
		}else if(strlen($memo) === $slash[0]+$slash[1]){
			$code = substr($memo, 0, $slash[0]). "-" .substr($memo, $slash[1], $slash[1]);
		}else if(strlen($memo) === $slash [0]+$slash [1]+$slash [2]){
			$code = substr($memo, 0,$slash[0]) . "-" . substr($memo, $slash[0], $slash[1]) . "-" . substr($memo, $slash[2], $slash[2]);
		}else{
			 $code = $memo;
		}

		echo json_encode ($code);
	}
	public function Models_popup(){
// 	    error_log(',aom '.print_r($_POST,true));
	    $code = $_POST['code'];
	    $doc = $_POST['doc'];
	    if (isset($_POST['return']) && $_POST['return']== true){
	    	$query = $this->db->query ( "SELECT `pos_detail`.*, `si_items`.`itm_itemdesc` AS item_desc FROM pos_detail JOIN `si_items` ON `si_items`.`itm_itemcode` = `pos_detail`.`item_code` where pm_memo=$code and doctyp_code=$doc" );
	    	
	    }else{
	    $query = $this->db->query ( "SELECT `pos_detail`.*, `si_items`.`itm_itemdesc` AS item_desc FROM pos_detail JOIN `si_items` ON `si_items`.`itm_itemcode` = `pos_detail`.`item_code` where parent_ref=$code and doctyp_code=$doc and pm_memo LIKE '1%' group by pm_memo" );
// 	    	$query = $this->db->query ( "SELECT * FROM pos_master  where parent_ref=$code" );
	    	
	    }
// 	    or parent_ref=$code
	    $data ['get_details'] = $query->result ();
	    $get_details = $query->result ();
// 	    error_log('main sort '.print_r($query->result (),true));
// 	    echo $this->db->last_query();
	    $this->load->view ( 'Template/models_popup', $data );
	    
	}
	public function Print_header($docno,$createdby,$createdwhen,$modifiedby,$modifiedwhen){
        $this->db->select('title');
        $this->db->where('code',$this->session->userdata('bg_code'));
        $business=$this->db->get('business_group')->result();

        $this->db->select('name');
        $this->db->where('id',$createdby);
        $created=$this->db->get('login')->result();

        $this->db->select('name');
        $this->db->where('id',$modifiedby);
        $modified=$this->db->get('login')->result();

        $this->db->select('name');
        $this->db->where('id',$this->session->userdata('id'));
        $printedby=$this->db->get('login')->result();

        $this->db->select('doctyp_printtitle');
        $this->db->where('doctyp_code',$docno);
        $doctype=$this->db->get('si_doctype')->result();

        $header='<div class="input-header">';
        $header.='<div class="row row-eq-height">';
        $header.='<div class="col-xs-4 print-header">Input By :<span>'.$created[0]->name.'</span>';
        if(!empty($createdwhen)){
        $header.=date('Y/m/d h:i a', strtotime($createdwhen));
    	}
        $header.='</div>';
        $header.='<div class="col-xs-4 print-header">Last Edited By : <span>'.$modified[0]->name.'</span>';
        if(!empty($modifiedwhen)){
		$header.=date('Y/m/d h:i a', strtotime($modifiedwhen));
		}
		$header.='</div>';
        $header.='<div class="col-xs-4 print-header">Printed By : <span>'.$printedby[0]->name.'</span>'.date('Y/m/d H:i: a').'</div></div><div class="H-Line"></div></div>';
        $header.='<p  style="float: left;"><img style="width:7em;" alt="Logo"
         src="'.base_url("public_html/assets/avatars/userdummy.png").'"/></p>';
        $header.='<h1 class="center">'.$business[0]->title.'</h1>';
       if(!empty($doctype[0]->doctyp_printtitle))
       {$header.='<h4 class="center print-doctype">'.$doctype[0]->doctyp_printtitle.'</h4>';}
   	  if(empty($doctype[0]->doctyp_printtitle))
       {$header.='<h4 class="center print-doctype">'.$docno.'</h4>';}
       $header.='<div class="clearfix"></div>';
       return $header;
    
    }
	public function numberTowords($number){
	if (($number < 0) || ($number > 999999999)) {
		return 'Number is out of range';
		}
		$Gn = floor($number / 1000000);
		/* Millions (giga) */
		$number -= $Gn * 1000000;
		$kn = floor($number / 1000);
		/* Thousands (kilo) */
		$number -= $kn * 1000;
		$Hn = floor($number / 100);
		/* Hundreds (hecto) */
		$number -= $Hn * 100;
		$Dn = floor($number / 10);
		/* Tens (deca) */
		$n = $number % 10;
		/* Ones */
		$res = "";
		if ($Gn) {
			$res .= $this->numberTowords($Gn) .  "Million";
		}
		if ($kn) {
			$res .= (empty($res) ? "" : " ") .$this->numberTowords($kn) . " Thousand";
		}
		if ($Hn) {
			$res .= (empty($res) ? "" : " ") .$this->numberTowords($Hn) . " Hundred";
		}
		$ones = array("", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen", "Nineteen");
		$tens = array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty", "Seventy", "Eigthy", "Ninety");
		if ($Dn || $n) {
			if (!empty($res)) {
				$res .= " and ";
			}
			if ($Dn < 2) {
				$res .= $ones[$Dn * 10 + $n];
			} else {
				$res .= $tens[$Dn];
				if ($n) {
					$res .= "-" . $ones[$n];
				}
			}
		}
		if (empty($res)) {
			$res = "zero";
		}
		return $res;
    }
	public function equiplist($screen,$equip_code){
	$equipmentList			= Modules::run('Inventory_Entity/equipment_code_list');
	if($screen =="fetch"){
		$list='<option value="">Select Equipment</option>';
		foreach ($equipmentList as $equipment){
		$list.='<option value="'.$equipment->equip_code.'">';
		$list.=$equipment->equip_name.'</option>';
		} 
		}
	else{
		$list='<option value="">Select Equipment</option>';
        foreach ($equipmentList as $equipment){
            $list.='<option value="'.$equipment->equip_code.'"';
		if (!empty($equipment->equip_code) && $equipment->equip_code == $equip_code) {$list.= "selected";}
			$list.='>'.$equipment->equip_name.'</option>';                                        	
        }
	}
	echo $list;
	}

	public function notification(){
		return $this->Mdl_template->db_select('*','si_alert_log',"al_status=0 
		AND bg_code = '".$this->session->userdata("bg_code")."' AND usr_id = '".$this->session->userdata('id')."' Order by al_code DESC limit 3");
	}
	public function notification_no(){
		return count($this->Mdl_template->db_select('*','si_alert_log',
			array('al_status' =>0,
				'usr_id' =>$this->session->userdata('id'),
				'bg_code' =>$this->session->userdata('bg_code'))));
	}
}
