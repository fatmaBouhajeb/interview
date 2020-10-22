<?php

namespace App\Models;

use CodeIgniter\Model;

class Mdl_categories extends Model{
   

  protected $table = 'categories';
  protected $allowedFields = ['category_parent_id', 'category_created', 'category_id', 'category_name	'];

	
  public function get_items() {
    
    return $this->where('category_parent_id', 0)->findAll();
  }
	

  public function getChildItems($id_cat){
    $response = array();
    if(isset($id_cat) ){
    $items = $this->where('category_parent_id', $id_cat)->findAll();
      $parent_id = $id_cat;
      $tree = '<select class="categorie">';
      foreach( $items as $key=> $item){
          $tree .= '<option value="';
          $tree .= $items[$key]['category_id'];
          $tree .= '">';
          $tree .= $items[$key]['category_name'];
          $tree .= '</option>';
      }
      $tree .= '</select>';
      $response = $tree;
   }

    return $response;

  }
	
	
} // End of Model Class	
	
