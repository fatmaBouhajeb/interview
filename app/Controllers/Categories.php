<?php namespace App\Controllers;
use App\Models\Mdl_categories;
use CodeIgniter\HTTP\Request;
use CodeIgniter\HTTP\RequestInterface;

class Categories extends BaseController {

    protected $Mdl_categories;
    protected $request;

	function __construct() {
		$this->Mdl_categories = new Mdl_categories();

	}
	
	public function index() {
	
		$items	= $this->Mdl_categories->get_items();
		$data = array(
			'categorie' => $items,
		);
		return view('categorie', $data);


	}
	public function getchildcat($id_cat){
		$data	= $this->Mdl_categories->getChildItems($id_cat);
		echo json_encode($data);
	}
	
}
