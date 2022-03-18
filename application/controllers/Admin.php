<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
    

    public function __construct(){
        parent::__construct();
        $this->load->model('M_Data_User');
        $this->load->model('M_Data_Voting');
        $this->load->library('form_validation');
        $this->load->library('Uuid');
        $this->load->library('Authentication');
    }

     /* ---------------------------------------FUNGSI UNTUK ADMIN ---------------------------------------------------------*/

    public function qwerty(){
        
        $data["welcome"] = "Selamat Datang";
        $data["title"] = "Selamat Datang";
        $this->load->view('admin/v_login', $data);
        
    }

    public function Login(){

       $this->form_validation->set_rules('nim', 'Nim', 'required|trim');
       $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if (!$this->form_validation->run()) {
            
        } else {
             $auth = new Authentication();
            
            if ($auth->authAdmin(htmlspecialchars($this->input->post('nim'), TRUE), htmlspecialchars($this->input->post('password'), TRUE))) {
                
                $data = array(
                    'admin' => true,
                    'login_admin' => true
                );
    
                $this->session->set_userdata($data);
    
            }
                redirect(site_url('Admin/Panel'));
            
        }      
 

    }

      public function Panel(){

        if ($this->session->userdata('admin')) {
             if ($this->session->userdata('login_admin')) {

                    $data = array(
                        'panitia' => $this->M_Data_User->getDataPanitia()->result()
                    );
                    $this->load->view('admin/v_admin', $data);
                 
             } else {

                redirect(site_url('Admin/Panel'));
    
             }
        } else {

            redirect(site_url('Admin/Panel'));
    

        }
        
    }


    public function dataPanitia(){

        if ($this->session->userdata('admin') == TRUE) {
            if ($this->session->userdata('login_admin') == TRUE) {
                
                    $data = $this->M_Data_User->getDataPanitia()->result();
                    echo json_encode($data);
                                
            } else {

                redirect(site_url('Admin/Panel'));
    
            }
       } else {

        redirect(site_url('Admin/Panel'));
    

       }

    
    }

    public function registerPanitia(){
                      
               
        $randomID = new Uuid();
        $id   = $randomID->v4();
        date_default_timezone_set("Asia/Jakarta");
        $datetime = date("Y-m-d")." ".date("H:i:sa");
        
        $this->form_validation->set_rules('nim', 'Nim', 'numeric|is_unique[tbl_user.nim]');

        
        $genPass  = '0123456789abcdefghijklmnopqrstuvwxyz';
        $password = substr(str_shuffle($genPass), 0, 7); //set password


        if (!$this->form_validation->run()){
        
                $this->session->set_flashdata('notif',
                    '<center>
                        <div class="alert alert-danger" role="alert"><center>Registrasi Data Panitia  GAGAL.</center></div>
                     </center>');
                
        } else {
            
            $namaUser = htmlspecialchars($this->input->post('nama'), TRUE);
            $nimUser = htmlspecialchars($this->input->post('nim'), TRUE);
                
            $dataRegistrasi = array(
                'id_user' => $id,
                'nim' => $nimUser,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'nama' => $namaUser,
                'jabatan' => htmlspecialchars($this->input->post('jabatan'), TRUE),
                'email' => htmlspecialchars($this->input->post('email'), TRUE),
                'id_role' => 1,
                'terdaftar' => $datetime,
                'status_vote' => "0"
            );
                    
            $data = $this->M_Data_User->registerDataPanitia($dataRegistrasi);

            if ($data) {
               
                $config = [
                    'mailtype' => 'html',
                    'charset' => 'utf-8',
                    'protocol' => 'stmp',
                    'smtp_host' => 'ssl://mail.dpmfisipubhara.com',
                    'smtp_user' => 'no-reply@dpmfisipubhara.com',
                    'smtp_pass' => 'GVz$iQbk0&Or',
                    'smtp_crypto' => 'ssl',
                    'smtp_port' => 465,
                    'crlf'    => "\r\n",
                    'newline' => "\r\n"
                ];

                $this->email->from('no-reply@dpmfisipubhara.com', 'dpmfisipubhara');
                $this->email->to(htmlspecialchars($this->input->post('email'), TRUE) );
                $this->email->subject('Password Akses Sistem E-voting dpmfisipubhara');
                $this->email->message("Hi, ". $namaUser ."\r\n"."Terimakasih telah melakukan registrasi Pemira 2020 \r\n Berikut adalah informasi Akun Kamu : \r\n User : ". $nimUser ."\r\n Password : ". $password . " \r\n Gunakan Hak Suaramu dengan baik \r\n Suaramu Menentukan FISIP Lebih Maju !!!");
                if ($this->email->send()) {

                    $this->session->set_flashdata('notif',
                         '<center>
                             <div class="alert alert-success" role="alert"><center>Registrasi Data dan Pengiriman Password Berhasil.</center></div>
                          </center>');
                        
                    echo json_encode($data);

                } else {

                    $this->session->set_flashdata('notif',
                    '<center>
                        <div class="alert alert-warning" role="alert"><center>Registrasi Data Berhasil pengiriman Password Mahasiswa GAGAL !.</center></div>
                    </center>');

                    echo json_encode($data);

                }


            } else {

                $this->session->set_flashdata('notif',
                     '<center>
                         <div class="alert alert-danger" role="alert"><center>Registrasi Data Panitia Gagal !.</center></div>
                      </center>');
                    
                    echo json_encode($data);

            }
                
        } 
    }


    public function deletePanitia($id_user){
        
        if ($this->session->userdata('admin') == TRUE) {
            if ($this->session->userdata('login_admin') == TRUE) {                
                $data = $this->M_Data_User->selectDataPanitia($id_user)->row_array();
                if ($data['status_vote'] == '1' && $data['paslon_dipilih'] == True) {
                    
                    $this->M_Data_Voting->hapusVote($id_user);
                    $data2 = $this->M_Data_User->deleteDataPanitia($id_user);
                    echo json_encode($data2);
                    
                } else {

                $data1 = $this->M_Data_User->deleteDataPanitia($id_user);
                echo json_encode($data1);

                }

            } else {

                redirect(site_url('Admin/Panel'));
    
            }

       } else {

        redirect(site_url('Admin/Panel'));
    

       }

 
    }

    public function deleteVotePanitia($id_user){
        
        if ($this->session->userdata('admin') == TRUE) {
            if ($this->session->userdata('login_admin') == TRUE) {    
            
                $data = $this->M_Data_User->selectDataPanitia($id_user)->row_array();
                if ($data['status_vote'] == '1' && $data['paslon_dipilih'] == True) {
                    
                   $data = $this->M_Data_Voting->hapusVote($id_user);
             
                    echo json_encode($data);
                    
                }


            } else {

                redirect(site_url('Admin/Panel'));
    
            } 

        } else {

            redirect(site_url('Admin/Panel'));
            
           }

    }
    
    public function sendPasswordPanitia(){
       
        $id_user = htmlspecialchars($this->input->post('id'), true);
        $genPass  = '0123456789abcdefghijklmnopqrstuvwxyz';
        $password = substr(str_shuffle($genPass), 0, 7); //set password

        if ($this->M_Data_User->setNewPassword($id_user, password_hash($password, PASSWORD_DEFAULT))) {
         
            $data = $this->M_Data_User->selectDataPanitia($id_user)->row_array();
            $targetEmail = $data["email"];
            $name = $data["nama"];

            $config = [
                'mailtype' => 'text',
                'charset' => 'utf-8',
                'protocol' => 'stmp',
                'smtp_host' => 'ssl://mail.dpmfisipubhara.com',
                'smtp_user' => 'no-reply@dpmfisipubhara.com',
                'smtp_pass' => 'GVz$iQbk0&Or',
                'smtp_crypto' => 'ssl',
                'smtp_port' => 465,
                'crlf'    => "\r\n",
                'newline' => "\r\n"
            ];

            $this->email->from('no-reply@dpmfisipubhara.com', 'dpmfisipubhara');
            $this->email->to($targetEmail);
            $this->email->subject('Password Akses Sistem E-voting dpmfisipubhara');
            $this->email->message("Hi, ". $name ."\r\n Untuk Password Baru Kamu ialah : " . $password . "\r\n Gunakan Hak Suaramu dengan baik \r\n Suaramu Menentukan FISIP Lebih Maju !!!");
            
            if ($this->email->send()) {
                
                $this->session->set_flashdata('notif',
                '<center>
                    <div class="alert alert-success" role="alert"><center>Pengiriman Password Berhasil.</center></div>
                </center>');
                
                redirect(site_url('Admin/Panel'));

            } else {

                $this->session->set_flashdata('notif',
                '<center>
                    <div class="alert alert-danger" role="alert"><center>Pengiriman Password Berhasil..</center></div>
                </center>');
        
                redirect(site_url('Admin/Panel'));

            }

        } else {

            $this->session->set_flashdata('notif',
            '<center>
                <div class="alert alert-danger" role="alert"><center>Gagal Update Password.</center></div>
            </center>');
            
            redirect(site_url('Admin/Panel'));


        }
    }


}