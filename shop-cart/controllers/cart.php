<?php

class Cart extends CI_Controller { // Our Cart class extends the Controller class

	function __construct()
	{
		parent::__construct();
		$this->load->model('cart_model'); // Load our cart model for our entire class
		//$this->load->library(array('cart')); // Load our cart model for our entire class
		$this->load->database(); // Load our cart model for our entire class
		$this->load->helper(array('url','form')); // Load our cart model for our entire class
	}
	
	function index()
	{
		$data['produk'] = $this->cart_model->tampil_produk();
		$this->load->view('home_cart', $data); // Display the page
	}
	
	function tambah()
	{
		$id = $this->input->post('kode_barang'); // Assign posted product_id to $id
		$cty = $this->input->post('banyak'); // Assign posted quantity to $cty
		
		$this->db->where('kode_barang', $id); // Select where id matches the posted id
		$query = $this->db->get('tbl_barang', 1); // Select the products where a match is found and limit the query by 1
		
		// Check if a row has been found
		if($query->num_rows > 0){
		
			foreach ($query->result() as $row)
			{
			    $data = array(
               		'id'      => $id,
               		'qty'     => $cty,
               		'price'   => $row->harga,
               		'name'    => $row->nama_barang
            	);

				$this->cart->insert($data);
			}
		}
		
	}
	function update_cart(){
		
		$total = $this->cart->total_items();
		$item = $this->input->post('rowid');
	    $qty = $this->input->post('qty');

		for($i=0;$i < $total;$i++)
		{
			$data = array(
               'rowid' => $item[$i],
               'qty'   => $qty[$i]
            );
            
			$this->cart->update($data);
		}
		redirect('cart');
	}
	function show_cart(){
		$this->load->view('cart');
	}
	
	function empty_cart(){
		$this->cart->destroy();
		redirect('cart');
	}
	function total_cart()
	{
		$data['total'] = $this->cart->total_items();
		$this->load->view('total',$data);
	}
}

/* End of file cart.php */
/* Location: ./application/controllers/cart.php */