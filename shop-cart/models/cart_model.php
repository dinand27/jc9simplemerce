<?php 

class Cart_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}
		
	function tampil_produk()
	{
		$q=$this->db->query("SELECT * from tbl_barang");
		return $q;
	}
	
	// Updated the shopping cart
	function validate_update_cart(){
		
		// Get the total number of items in cart
		$total = $this->cart->total_items();
		
		// Retrieve the posted information
		$item = $this->input->post('rowid');
	    $qty = $this->input->post('qty');

		// Cycle true all items and update them
		for($i=0;$i < $total;$i++)
		{
			// Create an array with the products rowid's and quantities. 
			$data = array(
               'rowid' => $item[$i],
               'qty'   => $qty[$i]
            );
            
            // Update the cart with the new information
			$this->cart->update($data);
		}

	}
	
	// Add an item to the cart
	function validate_add_cart_item(){
		
		$id = $this->input->post('product_id'); // Assign posted product_id to $id
		$cty = $this->input->post('quantity'); // Assign posted quantity to $cty
		
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
				
				return TRUE;
			}
		
		// Nothing found! Return FALSE!	
		}else{
			return FALSE;
		}
	}

	function Menu_Atas()
	{
		$q=$this->db->query("SELECT * from tbl_menu where id_parent='0' and level='0'");
		return $q;
	}
		
	function Sub_Menu_Atas($id_parent,$level)
	{
		$q=$this->db->query("SELECT * from tbl_menu where id_parent='$id_parent' and level='$level'");
		return $q;
	}
	
	function Konfig_Parade()
	{
		$q=$this->db->query("SELECT * from tbl_konfig where konfig='parade'");
		return $q;
	}
	function Isi_Parade($tipe)
	{
		$q=$this->db->query("SELECT * from tbl_barang where tipe='$tipe' order by RAND() LIMIT 7");
		return $q;
	}

	function Produk_Pilihan()
	{
		$q=$this->db->query("SELECT * from tbl_konfig left join tbl_barang on tbl_konfig.det_konfig=tbl_barang.kode_barang where tbl_konfig.konfig='pilihan'
		LIMIT 12");
		return $q;
	}

}
