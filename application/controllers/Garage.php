<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Garage extends CI_Controller {

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
	

	 
	public function index()
	{
		
		
		
		
		$this->template->load('template', 'garage/state.html');
	}

	public function changeState(){
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');

		header('Access-Control-Allow-Methods: GET, POST');
		
		header("Access-Control-Allow-Headers: X-Requested-With");		
		$this->load->database();		
		$query = $this->db->get("state"); 						
		$res = $query->last_row();				
		if (sizeof($res) < 1){
			$data = array( 				
				'state' => 1,
				'lastchange'=>'NOW()'
			 ); 
			 
			 $this->db->insert("state", $data);			
			 $res = $query->last_row();
		}
		$new = !$res->state ;				
		$data = array( 			
			'state' => $new,
			'lastchange'=>'NOW()'
		);
		$this->db->set($data); 
		$this->db->where("id", 1); 
		$this->db->update("state", $data);
		$query = $this->db->get("state"); 						
		$res = $query->last_row();		
		echo json_encode(  ['records'=>$query->last_row()]);

	}
	public function getState(){
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');

		header('Access-Control-Allow-Methods: GET, POST');
		
		header("Access-Control-Allow-Headers: X-Requested-With");		
		$this->load->database();		
		$query = $this->db->get("state");
		$res = $query->last_row();				
		if (sizeof($res) < 1){
			$data = array( 				
				'state' => 1,
				'lastchange'=>'now()'
			 ); 
			 
			 $this->db->insert("state", $data);			
			 $res = $query->last_row();
		}								
		echo json_encode( ['records'=>$res]);

	}
}
