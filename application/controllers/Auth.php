<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//CONTROLLERS UNTUK FUNGSI LOGIN DAN VOTE
class Auth extends CI_Controller {

    public function __construct(){
        parent::__construct();
	    $this->load->library('form_validation');
        $this->load->model('M_Data_User');
        $this->load->model('M_Data_Voting');
	}
    
    //Fungsi Login para user (mahasiswa atau panitia)
    public function Login(){

        $this->form_validation->set_rules('nim', 'Nim', 'required|numeric|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
    
        
        if ($this->form_validation->run() == FALSE) { //Jika Inputan User salaah
            
             $this->session->set_flashdata('notif',
                    '<center>
                     <div class="alert alert-danger alert-dismissible col-lg" style="text-align:center; margin:15px auto;"><center>Mohon Di-isi dengan Benar.</center></div>
                     </center>');
            
           redirect(site_url('Page/index'));
            
        } else { //Jika Benar
          
            $nim = htmlspecialchars($this->input->post('nim'), TRUE);
            $password = htmlspecialchars($this->input->post('password'), TRUE);
                      
            if ($this->M_Data_User->verfikasiLogin($nim)->row_array()) { // mengecheck apakah user ada di database
         
                $user = $this->M_Data_User->verfikasiLogin($nim)->row_array(); 
          
                if (password_verify($password, $user['password']) ) { //apakah password yang dimasukan cocok di db ?
                    if ($user["id_role"] == 2) { // jika rolenya mahasiswa
                    
                        $data = array(
                            'id_role' => $user['id_role'],
                            'nim'     => $user['nim'],
                            'status_vote' => $user['status_vote'],
                            'paslon' => $user['paslon_dipilih'],
                            'login_status' => TRUE
                        );

                        $this->session->set_userdata($data);

                        redirect(site_url('Page/welcome'));
                        
                    } elseif ($user["id_role"] == 1){ //jika rolenya admin

                        $data = array(
                            'id_role' => $user['id_role'],
                            'nim'     => $user['nim'],
                            'name'    => $user['nama'],
                            'status_vote' => $user['status_vote'],
                            'paslon' => $user['paslon_dipilih'],
                            'login_status' => TRUE
                        );

                        $this->session->set_userdata($data);

                        redirect(site_url('Panitia/Dashboard'));
                    }

                } else { //jika passwordnya salaah

                    $this->session->set_flashdata('notif',
                    '<center>
                     <div class="alert alert-danger alert-dismissible col-lg" style="text-align:center; margin:15px auto;"><center>Nim Atau Password Salah.</center></div>
                     </center>');
    
                    redirect(site_url('Page'));

                }

            } else { // jika user tidak ada di database

                $this->session->set_flashdata('notif',
                '<center>
                 <div class="alert alert-danger alert-dismissible col-lg" style="text-align:center; margin:15px auto;"><center>Nim Atau Password Salah.</center></div>
                 </center>');

                redirect(site_url('Page'));

            }
        }
    } 

    //Fungsi Voting Untuk Panitia dan Mahasiswa
    public function Voting(){
    
		if ($this->session->userdata('login_status')) { // jika statusnya login
            
            if ($this->session->userdata('status_vote') == "0" ) { //jika status votenya 0

				if ($this->session->userdata('paslon') == NULL) { // dan paslonya masih kosong

                    $this->form_validation->set_rules('paslon', 'Paslon', 'required|trim');
    
                    if (!$this->form_validation->run()) { //mengvalidasi inputan user jika salah

                         $this->session->set_flashdata('notif',
                            '<div class="alert alert-danger alert-dismissible col-12">Mohon untuk dipilih calon kandidatnya !</div>');
                            redirect(site_url('Page/voting'));

                    } else { //mengvalidasi inputan user jika benar
                    
                        date_default_timezone_set("Asia/Jakarta");
		                $waktuNow = date("Y-m-d H:i:sa");

					    /*Jam Min Det bln Day Year */
		                $buka = mktime(8, 0, 0,  9, 28, 2020);
		                $waktuBuka = date("Y-m-d H:i:sA", $buka);

						/*Jam Min Det bln Day Year */
		                $tutup = mktime(15, 0, 0,  9, 28, 2020);
		                $batasWaktu = date("Y-m-d H:i:sA", $tutup);
		

                        if ($waktuNow > $waktuBuka && $waktuNow < $batasWaktu) {
                            
                            $nim = $this->session->userdata("nim"); // ambil data session nim
                            $id_paslon = htmlspecialchars($this->input->post("paslon"), TRUE) ; //mengambil value dari element bernama paslon
                                    
                            $data = $this->M_Data_User->verfikasiLogin($nim)->row_array(); //mengambil data user dari db
            
                            if ($data) { //jika ada 

                                if ($data["status_vote"] == "0" && $data["paslon_dipilih"] == null) { //jika data user sama sekali belum mencoblos
                                
                                    if ($this->M_Data_Voting->tambahVote($nim, $id_paslon)) { //jika user berhasil mencoblos
                                    
                                          $this->session->sess_destroy();
                
                                          redirect(site_url('Page/Terimakasih'));
                                    
                                    } else { //jika user gagal mencoblos
                
                                        $this->session->set_flashdata('notif',
                                        '
                                         <div class="alert alert-danger alert-dismissible col-12">Gagal Mohon dicoba sekali lagi !</div>
                                        ');
                                         redirect(site_url('Page/voting'));
                
                                    }

                                } else { //jika user sudah memakai hak suara

                                    $this->session->set_flashdata('notif',
                                    '
                                    <div class="alert alert-danger alert-dismissible col-12">Anda Sudah memakai Hak Suara Anda !</div>
                                    ');
                                    redirect(site_url('Page/voting'));

                                }

                                    
                            } else { //jika nim tidak ditemukan 
            
                                $this->session->set_flashdata('notif',
                                 '
                                    <div class="alert alert-danger alert-dismissible col-12">Maaf Anda Tidak mempunyai Akses untuk Voting ?</div>
                                    ');
                                    redirect(site_url('Page/voting'));
            
                            }
                            //jika vote tidak pada waktunya
                            
                        } else {
                            
                             $this->session->set_flashdata('notif',
                                 '
                                <div class="alert alert-danger alert-dismissible col-12">Sistem Voting Belum Dibuka mohon untuk melakukan voting sesuai waktu yang di tentukan</div>
                                ');
                            redirect(site_url('Page/voting'));
                            
                        }
                        
            
                    }

					
                } else {  // dan user sudah memilih paslonya 
                    
                    $this->session->sess_destroy();
                    redirect(site_url('Page/Terimakasih'));

				}
							
			} else { //jika status votenya tidak 0

                   $this->session->sess_destroy();
                   redirect(site_url('Page/Terimakasih'));
			}

	   } else {  // jika statusnya login tidak ada 
           
           $this->session->sess_destroy();
		   redirect(site_url('Page'));
		   
	   }
      
       
    }

    public function Logout(){
        
        $this->session->sess_destroy();
        redirect(site_url('Page'));

    }
}
