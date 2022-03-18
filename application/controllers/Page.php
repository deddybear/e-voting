<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//CONTROLLERS UNTUK VIEW HALAMAN UTAMA
class Page extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('M_Data_User');
	}

	//fungsi halaman index
	public function index(){

		if (!$this->session->userdata('login_status')) { //jika user belum login
		
			$data['title'] = 'Selamat Datang di Sistem Aplikasi E-Voting';
			$data['welcome'] = "PEMIRA FISIP 2020";
			$this->load->view('v_login', $data);
		
		} else { //jika user sudah login 

			redirect(site_url('Page/welcome'));
		
		}
		

	}

	
	//fungsi halaman utama 
	public function welcome(){

		if ($this->session->userdata('login_status')) { //jika user sudah login
			
			 $this->load->view('v_welcome');
		
		} else {  //jika user Belum login
			
			redirect(site_url('Page'));
			
		}
		
	}

	//fungsi halaman kandidat
	public function kandidat(){
	
		if ($this->session->userdata('login_status')) {  //jika user sudah login
			
			$result["data"] = $this->M_Data_User->getDataPaslon();
			$this->load->view('v_kandidat', $result);
	   
	   } else {  //jika user belum login
		   
			redirect(site_url('Page'));
		   
	   }
		
	
	}

	//fungsi halaman vote
	public function voting(){

		date_default_timezone_set("Asia/Jakarta");
		$waktuNow = date("Y-m-d H:i:sa");

					/*Jam Min Det bln Day Year */
		$buka = mktime(8, 0, 0,  9, 28, 2020);
		$waktuBuka = date("Y-m-d H:i:sA", $buka);

						/*Jam Min Det bln Day Year */
		$tutup = mktime(15, 0, 0,  9, 28, 2020);
		$batasWaktu = date("Y-m-d H:i:sA", $tutup);
		

		if ($this->session->userdata('login_status')) { // jika user sudah login
			if ($this->session->userdata('status_vote') == "0" ) { //jika user status votenya kosong
				if (!$this->session->userdata('paslon')) { //jika user tidak ada yang di coblos
					if ($waktuNow > $waktuBuka) { //jika waktu sekarang tidak kurang dari waktu buka atau lebih dari batas waktu
						//fix change || to && <---- !!!!
					
						//untuk menampilkan para paslon di view_voting & mengambil data para Paslon
						
						$result["data"] = $this->M_Data_User->getDataPaslon();
						$this->load->view('v_voting', $result);
						
					} else { //jika tidak 
						
						$data = array(
							"buka" => "08:00 AM",
							"tutup" => "15:00 PM",
							"tgl" => "28-Sep-2020"
						);
						$this->load->view('v_tolak', $data);
					} 			
					
				} else {
						
					$data = array(
						"buka" => $waktuBuka,
						"tutup" => $batasWaktu
					);
					$this->load->view('v_tolak', $data);

				}
							
			} else {

				redirect(site_url('Page/Terimakasih'));
			
			}
	   
	 	} else {
		   
			redirect(site_url('Page'));
		   
	   	}
		
	
	}

	public function Terimakasih(){
		
		$this->load->view('v_ty');

	}

}
