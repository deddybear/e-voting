<?php

defined('BASEPATH') OR exit('No direct script access allowed');
//CONTROLLERS UNTUK VIEW DASHBOARD DAN FUNGSI DASHBOARD
class Panitia extends CI_Controller {
    

    public function __construct(){
        parent::__construct();
        $this->load->model('M_Data_User');
        $this->load->model('M_Data_Voting');
        $this->load->library('form_validation');
        $this->load->library('email');
        $this->load->library('Uuid');
    }

    public function Dashboard(){

        //jika user belom login
        if (!$this->session->userdata('login_status')) {
            
            $data['title'] = "Panitia Login";
            $data['welcome'] = "Login Page Dashboard Panitia";
            $this->load->view('v_login', $data);
                
    
        } else { //jika user sudah login
               
            if ($this->session->userdata('id_role') != '1') { //check jika user bukan panitia
                    
                $data['title'] = "Akses Ditolak";
                $data['message'] = "Akses Ditolak Mohon Kembali";
                $this->load->view('404', $data);
           
    
            } else { // jika akunnya panitia
    
                $this->load->view('panitia/v_dashboard');
    
            }
                  
        }
        
    }

    public function Paslon(){

          //jika user belom login
          if (!$this->session->userdata('login_status')) {
            
            $data['title'] = "Panitia Login";
            $data['welcome'] = "Login Page Dashboard Panitia";
            $this->load->view('v_login', $data);
                
    
        } else { //jika user sudah login
               
            if ($this->session->userdata('id_role') != '1') { //check jika user bukan panitia
                    
                $data['title'] = "Akses Ditolak";
                $data['message'] = "Akses Ditolak Mohon Kembali";
                $this->load->view('404', $data);
           
    
            } else { // jika akunnya panitia
                
                $data = array(
                    'paslon' => $this->M_Data_User->getDataPaslon(), //DATA BUAT OPTION UPLOAD FOTO
                    'title' => "Panel Data Kandidat"
                );
        
                $this->load->view('panitia/v_data_kandidat', $data);

    
            }
                  
        }

    }

    public function Mahasiswa(){

        //jika user belom login
        if (!$this->session->userdata('login_status')) {
            
            $data['title'] = "Panitia Login";
            $data['welcome'] = "Login Page Dashboard Panitia";
            $this->load->view('v_login', $data);
                
    
        } else { //jika user sudah login
               
            if ($this->session->userdata('id_role') != '1') { //check jika user bukan panitia
                    
                $data['title'] = "Akses Ditolak";
                $data['message'] = "Akses Ditolak Mohon Kembali";
                $this->load->view('404', $data);
           
    
            } else { // jika akunnya panitia
    
                $data = array(
                    'mahasiswa' => $this->M_Data_User->getDataMahasiswa()
                );

  
                $this->load->view('panitia/v_data_mahasiswa', $data);
    
            }
                  
        }
        
  
    }

    public function Voting(){
                
        //jika user belom login
        if (!$this->session->userdata('login_status')) {
            
            $data['title'] = "Panitia Login";
            $data['welcome'] = "Login Page Dashboard Panitia";
            $this->load->view('v_login', $data);
                
    
        } else { //jika user sudah login
               
            if ($this->session->userdata('id_role') != '1') { //check jika user bukan panitia
                    
                $data['title'] = "Akses Ditolak";
                $data['message'] = "Akses Ditolak Mohon Kembali";
                $this->load->view('404', $data);
           
    
            } else { // jika akunnya panitia
    
                $this->load->view('panitia/v_data_voting');
    
            }
                  
        }

    }

    public function Change(){
       
         //jika user belom login
         if (!$this->session->userdata('login_status')) {
            
            $data['title'] = "Panitia Login";
            $data['welcome'] = "Login Page Dashboard Panitia";
            $this->load->view('v_login', $data);
                
    
        } else { //jika user sudah login
               
            if ($this->session->userdata('id_role') != '1') { //check jika user bukan panitia
                    
                $data['title'] = "Akses Ditolak";
                $data['message'] = "Akses Ditolak Mohon Kembali";
                $this->load->view('404', $data);
           
    
            } else { // jika akunnya panitia
    
                $this->load->view('panitia/v_ganti_password');
    
            }
          

        }
    }

/* ----------------------FUNGSI MENGELOLAH DATA MAHASISWA-------------------------------------  */


    /** MENAMPILKAN SEMUA DATA MAHASISWA */
    public function dataMahasiswa(){
         //get all data mahasiswa
         $data = $this->M_Data_User->getDataMahasiswa();
         echo json_encode($data);

    }


    /** Memilih Data Mahasiswa */
    public function selectDataMhs($idUser){
        
        //mengambil data mahasiswa sesuai pilihan
        $data = $this->M_Data_User->selectMahasiswa($idUser)->result();
        echo json_encode($data);
    
    }

 
    /** REGISTER DATA MAHASISWA  BELUM ADA STMP (NGIRIM PASSWORD KE EMAIL ) */
    public function tambahDataMhs(){
        
     $this->form_validation->set_rules('nim', 'Nim', 'trim|numeric|is_unique[tbl_user.nim]');
     $this->form_validation->set_rules('nama', 'Email', 'trim');
     $this->form_validation->set_rules('jurusan', 'Jurusan', 'trim');
     $this->form_validation->set_rules('email', 'Email', 'trim|is_unique[tbl_user.email]');
     if (!$this->form_validation->run()) { //jika validasi inputan gagal
     
        // maka akan menampilkan pesan error
         $this->session->set_flashdata('notif',
         '<center>
             <div class="alert alert-danger" role="alert"><center>Registrasi Data Mahasiswa GAGAL dimohon mengisi dengan benar.</center></div>
         </center>');
    

     } else { //jika validasi inputan sukses
    
            $namaUser = htmlspecialchars($this->input->post('nama'), TRUE); 
            $nimUser  = htmlspecialchars($this->input->post('nim'), TRUE);
            $genPass  = '0123456789abcdefghijklmnopqrstuvwxyz';
            $randomID = new Uuid();
        
            $idUser   = $randomID->v4();
            $password = substr(str_shuffle($genPass), 0, 7); //set password

    
            //set waktu Asia (Jakarta)
            date_default_timezone_set("Asia/Jakarta");
            $datetime = date("Y-m-d")." ".date("H:i:sa");
 

            $dataMahasiswa = array(
                'id_user'      => $idUser,
                'id_role'      => 2,
                'nim'          => htmlspecialchars($this->input->post('nim'), TRUE),
                'password'     => password_hash($password, PASSWORD_DEFAULT),
                'jurusan'      => htmlspecialchars($this->input->post('jurusan'), TRUE) ,
                'email'        => htmlspecialchars($this->input->post('email'), TRUE),
                'terdaftar'    => $datetime,
                'status_vote'  => "0",
            );
        
            $data = $this->M_Data_User->saveDataMahasiswa($dataMahasiswa);  
        
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
                
                sleep(5);
                
                $this->email->from('no-reply@dpmfisipubhara.com', 'dpmfisipubhara');
                $this->email->to(htmlspecialchars($this->input->post('email'), TRUE) );
                $this->email->subject('Password Akses Sistem E-voting dpmfisipubhara');
                $this->email->message("Hi, ". $namaUser ."\r\n"."Terimakasih telah melakukan registrasi Pemira 2020 \r\n Berikut adalah informasi Akun Kamu : \r\n User(NIM) : ". $nimUser ."\r\n Password : ". $password . " \r\n Gunakan Hak Suaramu dengan baik \r\n Suaramu Menentukan FISIP Lebih Maju !!!");
                
                if ($this->email->send()) {
                
                    $this->session->set_flashdata('notif',
                    '<center>
                    <div class="alert alert-success" role="alert"><center>Registrasi Data dan pengiriman Password Mahasiswa Berhasil.</center></div>
                    </center>');
                                            
                    echo json_encode($data);
    
                } else {
    
                    $this->session->set_flashdata('notif',
                    '<center>
                        <div class="alert alert-warning" role="alert"><center>Registrasi Data Berhasil pengiriman Password Mahasiswa GAGAL !.</center></div>
                    </center>');

                    $data[] = (object) array(
                        'error' => "Registrasi Data Berhasil pengiriman Password Mahasiswa GAGAL !"
                    );

                    echo json_encode($data);
                }

            
            } else {

                $this->session->set_flashdata('notif',
                '<center>
                <div class="alert alert-danger" role="alert"><center>Registrasi Data dan Pengiriman Passowrd Mahasiswa Gagal!.</center></div>
                </center>');
            
                echo json_encode($data);
            }
         

        }
    }



    /** FUNGSI UNTUK UPDATE DATA MAHASISWA */
    public function updateDataMhs(){
        
        $iduser = $this->input->post('idmhs');
          
        $this->form_validation->set_rules('nim', 'Nim', 'required|trim|numeric');
        $this->form_validation->set_rules('jurusan', 'Jurusan', 'required|trim');
        $this->form_validation->set_rules('email', 'Jurusan', 'required|trim');

        if (!$this->form_validation->run()) { //validasi inputan jika gagal

            $this->session->set_flashdata('notif',
            '<center>
                <div class="alert alert-danger" role="alert"><center>Edit Data Mahasiswa GAGAL dimohon mengisi dengan benar.</center></div>
            </center>');

        } else { //validasi inputan jika sukses

            $dataMahasiswa = array(
                'nim'          => htmlspecialchars($this->input->post('nim'), TRUE) ,
                'jurusan'      => htmlspecialchars($this->input->post('jurusan'), TRUE) ,
                'email'        => htmlspecialchars($this->input->post('email'), TRUE)
            );
            
            $data = $this->M_Data_User->updateDataMhs($iduser, $dataMahasiswa);

            $this->session->set_flashdata('notif',
            '<center>
                <div class="alert alert-success" role="alert"><center>Edit Data Mahasiswa Berhasil.</center></div>
            </center>');

            echo json_encode($data);
        }
    }



    /** FUNGSI UNTUK DELETE DATA MAHASISWA */
    public function deleteDataMhs($idUser){
        
        $data = $this->M_Data_User->selectMahasiswa($idUser)->row_array();

        if ($data['status_vote'] == '1' && $data['paslon_dipilih'] == True) { //dimana jika mahasiswa sudah voting tapi datanya dihapus
            
            $this->M_Data_Voting->hapusVote($idUser);  //untuk menghapus jejak voting mahasiswa
            $data = $this->M_Data_User->deletDataMhs($idUser); // menghapus data mahasiswa di database
            echo json_encode($data);
            
        } else { // dimana jika mahasiswa belum voting sama sekali

            $data = $this->M_Data_User->deletDataMhs($idUser); 
            echo json_encode($data);

        }
    }

    //Fungsi untuk mengirim password ke
    public function sendPassword(){
        
        $id_user = htmlspecialchars($this->input->post('id'), true);
        $genPass  = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $password = substr(str_shuffle($genPass), 0, 7); //set password

        if ($this->M_Data_User->setNewPassword($id_user, password_hash($password, PASSWORD_DEFAULT))) {
         
            $data = $this->M_Data_User->selectMahasiswa($id_user)->row_array();
            $targetEmail = $data["email"];

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

            sleep(5);
            
            $this->email->from('no-reply@dpmfisipubhara.com', 'dpmfisipubhara');
            $this->email->to($targetEmail);
            $this->email->subject('Password Akses Sistem E-voting dpmfisipubhara');
            $this->email->message("Hi Mahasiswa Fisip, Berikut ini adalah Password Akun E-voting kamu yang baru : " . $password);
            
            if ($this->email->send()) {
                
                $this->session->set_flashdata('notif',
                '<center>
                    <div class="alert alert-success" role="alert"><center>Pengiriman Password Berhasil.</center></div>
                </center>');
                
                redirect(site_url('Panitia/Mahasiswa'));
            } else {

                $this->session->set_flashdata('notif',
                '<center>
                    <div class="alert alert-danger" role="alert"><center>Pengiriman Password Berhasil..</center></div>
                </center>');
        
                     redirect(site_url('Panitia/Mahasiswa'));
            }

        } else {

            $this->session->set_flashdata('notif',
            '<center>
                <div class="alert alert-danger" role="alert"><center>Gagal Update Password.</center></div>
            </center>');
            
           redirect(site_url('Panitia/Mahasiswa'));

        }

   
    }

   

// ---------------------------Fungsi untuk Paslon dan para kandidat----------------------------------------


    /** FUNGSI UNTUK MENAMPILKAN DATA PASLON */
    public function dataPaslon(){
        
        $data = $this->M_Data_User->getDataPaslon();
        echo json_encode($data);
    
    }


    /** FUNGSI UNTUK MENAMBAH DATA PASLON */
    public function tambahDataPaslon(){

        $randomID = new Uuid();
        $idPaslon    = $randomID->v4();

        $this->form_validation->set_rules('nomerpaslon', 'Nomerpaslon', 'required|trim|numeric|is_unique[tbl_paslon.nomer_paslon]');
        $this->form_validation->set_rules('namaketua', 'Namaketua', 'required|trim');
        $this->form_validation->set_rules('namawakil', 'Namawakil', 'required|trim');
        $this->form_validation->set_rules('visi', 'Visi', 'required|trim');
        $this->form_validation->set_rules('misi', 'Misi', 'required|trim');

        if (!$this->form_validation->run()) { // mengvalidasi inputan user jika gagal 
            //jika validasi error
            
            $this->session->set_flashdata('notif',
            '<center>
                <div class="alert alert-danger" role="alert"><center>Registrasi Data Paslon GAGAL dimohon mengisi dengan benar.</center></div>
            </center>');

        } else { // mengvalidasi inputan user jika sukses

            $datakandidat = array(
                'id_kandidat' => $idPaslon,
                'nama_ketua' => htmlspecialchars($this->input->post('namaketua'), TRUE),
                'nama_wakil' => htmlspecialchars($this->input->post('namawakil'), TRUE),
                'foto_ketua' => "default.jpg",
                'foto_wakil' => "default.jpg"
            );
    
            $dataPaslon = array(
                'id_paslon'    => $idPaslon,
                'id_kandidat'   => $idPaslon,
                'nomer_paslon' => htmlspecialchars($this->input->post('nomerpaslon'), TRUE),
                'visi' => htmlspecialchars($this->input->post('visi'), TRUE),
                'misi' => htmlspecialchars($this->input->post('misi'), TRUE),
                'points_vote' => '0'
            );
    
            $data = $this->M_Data_User->saveDataPaslon($datakandidat,  $dataPaslon);

            $this->session->set_flashdata('notif',
            '<center>
                <div class="alert alert-success" role="alert"><center>Registrasi Data Paslon Berhasil.</center></div>
            </center>');
    
            echo json_encode($data);     
       
        }

    
    }


    /** FUNGSI UNTUK MEMILIH DATA PASLON */
    public function selectDataPaslon($id){
        $data = $this->M_Data_User->selectDataPaslon($id);
        echo json_encode($data);
    }


    /* FUNGSI UNTUK UPLOAD FOTO PASLON  PART 1*/
    public function uploadFotoPaslon(){

        $id = $this->input->post('id');
  
        //mengambil data nama foto sebelumnya
        $data = $this->db->get_where('tbl_kandidat', ['id_kandidat' => $id])->row_array();
      
        if ($this->uploadImage_($id, 'filefoto1', $data['foto_ketua'],'foto_ketua')) { //jika upload foto ketua sukses
            
            if ($this->uploadImage_($id, 'filefoto2', $data['foto_wakil'],'foto_wakil')) { // maka jalankan fungsi ini jika sukses tampilkan pesan sukses
                
                $this->session->set_flashdata('notif',
                '<center>
                    <div class="alert alert-success" role="alert"><center>Upload Foto Para Kandidat Sukses.</center></div>
                </center>');
                
                redirect(site_url('panitia/Paslon'));

            } else { //jika gagal upload foto wakil
                
                $this->session->set_flashdata('notif',
                '<center>
                    <div class="alert alert-danger" role="alert"><center>Upload Foto Wakil Paslon GAGAL.</center></div>
                </center>');
                
                redirect(site_url('Panitia/Paslon'));
            
            }

        } else { // GAGAL UPLOAD FOTO KETUA
            
            $this->session->set_flashdata('notif',
                '<center>
                    <div class="alert alert-danger" role="alert"><center>Upload Foto Ketua Paslon GAGAL.</center></div>
                </center>');
                
                redirect(site_url('Panitia/Paslon'));
        
            }
        
    
    }


    /* FUNGSI UNTUK UPLOAD FOTO PASLON PART 2 */
    private function uploadImage_($id, $fieldName, $oldImage, $columnName){
  
      $uploadImage = $_FILES[$fieldName]['name'];

      if ($uploadImage) { //jika ada file yang di upload
          # code...
            $genName  = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $nameFile = substr(str_shuffle($genName), 0, 7);
          
          
            if ($columnName == 'foto_ketua') { //jika foto ketua yang diupload
                
                $upload_path = "./assets/src/img/paslon/ketua/";
                $location = 'assets/src/img/paslon/ketua/';
            
            } elseif ($columnName == 'foto_wakil') { //jika foto wakil yang diupload
            
                $upload_path = "./assets/src/img/paslon/wakil/";
                $location = 'assets/src/img/paslon/wakil/';
            
            }
        
            //config library upload
            $config['upload_path'] = $upload_path;
            $config['file_name'] = $nameFile;
            $config['allowed_types'] = 'jpeg|jpg|png|gif';
            $config['overwrite']    = true;
            $config['max_size']     = 3240;
        
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
        
            if ($oldImage != 'default.jpg') { //jika user ingin mengganti foto yang lama 
            
                unlink(FCPATH . $location .$oldImage); //menhapus foto lama 
            
                if ($this->upload->do_upload($fieldName)) { //mengupload foto
                
                    $newImage = $this->upload->data('file_name');        
                
                } else {
                
                    var_dump( $this->upload->display_errors());
                    die();
                
                } 
                
                //mengupdate nama file di yg terbaru
                $this->db->set($columnName, $newImage);
                $this->db->where('id_kandidat', $id);
                $this->db->update('tbl_kandidat');
            
                return true;
            
            } else { //jika user ingin mengganti foto default.jpg
            
                if ($this->upload->do_upload($fieldName)) { //mengupload foto
                
                    $newImage = $this->upload->data('file_name');        
                
                } else {
            
                    var_dump( $this->upload->display_errors());
                    die();
                
                }    
            
                //mengupdate nama file di db yg terbaru
                $this->db->set($columnName, $newImage);
                $this->db->where('id_kandidat', $id);
                $this->db->update('tbl_kandidat');
            
                return true;
            }
            
        }

       
    }
    


    /** FUNGSI UNTUK UPDATE DATA PASLON */
    public function updateDataPaslon(){

        $idPaslon   = $this->input->post('idpaslon');

        $this->form_validation->set_rules('nomerpaslon', 'Nomerpaslon', 'required|trim|numeric');
        $this->form_validation->set_rules('namaketua', 'Namaketua', 'required|trim');
        $this->form_validation->set_rules('namawakil', 'Namawakil', 'required|trim');
        $this->form_validation->set_rules('visi', 'Visi', 'required|trim');
        $this->form_validation->set_rules('misi', 'Misi', 'required|trim');

        if (!$this->form_validation->run()) { //jika validasi inputan user error maka akan tampil pesan error
            
            $this->session->set_flashdata('notif',
            '<center>
                <div class="alert alert-danger" role="alert"><center>Edit Data Paslon GAGAL dimohon mengisi dengan benar.</center></div>
            </center>');


        } else { //jika validasi tidak error
            
            $where = array(
                'tbl_paslon.nomer_paslon' => htmlspecialchars($this->input->post('nomerpaslon'), TRUE),
                'tbl_paslon.visi'  => htmlspecialchars($this->input->post('visi'), TRUE),
                'tbl_paslon.misi'  => htmlspecialchars($this->input->post('misi'), TRUE),
            );
            
            $data = array(
               'tbl_kandidat.nama_ketua' => htmlspecialchars($this->input->post('namaketua'), TRUE),
               'tbl_kandidat.nama_wakil' => htmlspecialchars($this->input->post('namawakil'), TRUE)
            );
            
            $data = $this->M_Data_User->updateDataPas($idPaslon, $where, $data); //mengupdata data paslon
           
            $this->session->set_flashdata('notif',
            '<center>
                <div class="alert alert-success" role="alert"><center>Edit Data Paslon Berhasil.</center></div>
            </center>');
            
            echo json_encode($data);

        }

    }

    /** FUNGSI UNTUK DELETE DATA PASLON */
    public function deletePaslon($id){
        
        $data = $this->M_Data_User->deleteDataPaslon($id);
        echo json_encode($id);

    }


   // FUNGSI DELETE DATA VOTING MAHASISWA ATAU PANITIA BILA TIDAK VALID
    public function deleteVoteData($id_user){
        
        $data = $this->M_Data_Voting->hapusVote($id_user);
        echo json_encode($data);

 
    }
    
    //FUNGSI GANTI PASSWORD PANITIA NEW
    public function changePassword(){
        $nim = $this->session->userdata('nim');
        $data = $this->db->get_where('tbl_user', ['nim' => $nim])->row_array();
       
        //old pass
        $this->form_validation->set_rules('currentpassword', 'Currentpassword', 'required|trim');
        //new pass
        $this->form_validation->set_rules('password1', 'New Password', 'required|trim|min_length[5]|matches[password2]');
        $this->form_validation->set_rules('password2', 'Confrim New Password', 'required|trim|min_length[5]|matches[password1]');
        
        if (!$this->form_validation->run()) {
          
            $this->load->view('panitia/v_ganti_password');

        } else {

            $currentPassword = $this->input->post('currentpassword');
            $newPassword = $this->input->post('password1');
            if (!password_verify($currentPassword, $data['password'])) { //jika user tidak tau password 
               
                $this->session->set_flashdata('notif',
                '<center>
                    <div class="alert alert-danger" role="alert"><center>Current (Lama) Password Salah !</center></div>
                </center>');

                redirect(site_url('Panitia/Change'));

            } else { //jika user tau password lama

                if ($currentPassword == $newPassword) { // jika user memasukkan password lama sama dengan new password 
                    
                    $this->session->set_flashdata('notif',
                    '<center>
                        <div class="alert alert-danger" role="alert"><center>Password baru tidak boleh sama dengan password lama (current)!</center></div>
                    </center>');

                    redirect(site_url('Panitia/Change'));

                } else { //jika tidak

                    $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);

                    if ($this->M_Data_User->changePassword($nim, $newPasswordHash)) { //jika update password berhasil
                        $this->session->set_flashdata('notif',
                        '<center>
                            <div class="alert alert-success" role="alert"><center>Password Berhasil diubah !</center></div>
                        </center>');

                    redirect(site_url('Panitia/Change'));

                    } else { //jika update password tidak berhasil

                        $this->session->set_flashdata('notif',
                        '<center>
                            <div class="alert alert-danger" role="alert"><center>Password Gagal Berhasil diubah !</center></div>
                        </center>');

                        redirect(site_url('Panitia/Change'));

                    }
                }
            }
        }
    }

    
}
