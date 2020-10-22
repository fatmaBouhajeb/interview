<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );


class Control_general {

	private $ci;
	private $menu_id='id';
	private $menu_title='name';
	private $menu_parent='parent_id';
	private $menu_parent_default_value='0';
	private $space_character=' -> ';
	
	
	public function __construct($param = array()) {
		$this->ci = & get_instance ();
		
		$this->ci->load->helper ( array (
				"url",
				"form",
				"html" 
		) );
		
		$this->initialize($param);
	}
	public function initialize($param = array())
	{
		foreach ($param as $key => $value) {
			$this->$key = $value;
		}
	}
	
	function generate_list( $options = array()) {
		$parent_id= $this->menu_parent_default_value;
		$list_prepared = $this->prepare_items ( $options, $parent_id );
		$list_build = $this->build_item_list ( $list_prepared);
	
		return  $list_build;
	}
	function generate_multi_select($name = '', $options = array(), $selected = array(), $extra = '') {		
		$parent_id= $this->menu_parent_default_value;
		$list_prepared = $this->prepare_items ( $options, $parent_id );
		$list_build = $this->build_item_list ( $list_prepared);

		return  form_multiselect ( $name, $list_build , $selected , $extra  );
	}

	private function prepare_items(array $data, $parent ) 
	{
		$items = array ();
		
		foreach ( $data as $item ) {
			if ($item [$this->menu_parent] == $parent) {
				$items [$item [$this->menu_id ]] = $item;
				$items [$item [$this->menu_id ]] ['children'] = 
					$this->prepare_items ( $data, $item [$this->menu_id] );;
			}
		}
		return $items;
	}
	private  function build_item(&$list,$item,$level){
		$list[$item[$this->menu_id]]=str_repeat($this->space_character, $level). $item[$this->menu_title];	
	}
	public  $list = array();	
	private  function build_item_list($items,$level=0) {
	
	foreach ( $items as $item ) {		
		$this->build_item($this->list,$item,$level);
		
			if(count($item['children'])>0){
				$this->build_item_list($item['children'],++$level);
			}
	}
	return  ( $this->list );
	}
	
}


