<?php 
defined('BASEPATH') OR exit('No direct script access allowed');


class M_Data_User extends CI_Model {


  //VERIFIKASI LOGIN MAHASISWA DAN PANITIA       
    public function verfikasiLogin($nim){
        
        $this->db->select('*');
        $this->db->from('tbl_user');
        $this->db->where('tbl_user.nim', $nim);
        return $this->db->get();
    }

    public function totalUser(){
        
        return $this->db->query('SELECT COUNT(id_user) AS total_user FROM tbl_user')->row_array();

    }


 //-------------------------------MAHASISWA---------------------------------//

    public function getDataMahasiswa(){
        $this->db->select('*');
        $this->db->from('tbl_user');
        $this->db->where('id_role', 2);
        $this->db->order_by('tbl_user.nim', 'ASC');
        return $this->db->get()->result();
    }

    public function selectMahasiswa($idUser){
        $this->db->select('*');
        $this->db->from('tbl_user');
        $this->db->where('id_user', $idUser);
        $this->db->where('id_role', 2);
        return $this->db->get();
    }

    public function saveDataMahasiswa($dataMhs){
        return $this->db->insert('tbl_user', $dataMhs);
    }

    public function updateDataMhs($id, $where){
        $this->db->set($where);
        $this->db->where('id_user', $id);
        return $this->db->update('tbl_user');
    }
    
    public function deletDataMhs($id){
        $this->db->where('id_user', $id);
        return $this->db->delete('tbl_user');
    }

    public function setNewPassword($id_user, $newPass){
        $this->db->set('password', $newPass);
        $this->db->where('id_user', $id_user);
        return $this->db->update('tbl_user');
    }

//-------------------------------------PASLON---------------------------------//


    public function getDataPaslon(){
        $this->db->select('
            tbl_paslon.id_paslon,
            tbl_paslon.nomer_paslon,
            tbl_kandidat.nama_ketua,
            tbl_kandidat.nama_wakil,
            tbl_kandidat.foto_ketua,
            tbl_kandidat.foto_wakil,
            tbl_paslon.visi,
            tbl_paslon.misi
        ');
        $this->db->from('tbl_paslon');
        $this->db->join('tbl_kandidat', 'tbl_kandidat.id_kandidat = tbl_paslon.id_kandidat');
        $this->db->order_by('tbl_paslon.nomer_paslon', 'ASC');
        return $this->db->get()->result();
    }

    public function selectDataPaslon($id_paslon){
        $this->db->select('
            tbl_paslon.id_paslon,
            tbl_paslon.nomer_paslon,
            tbl_kandidat.nama_ketua,
            tbl_kandidat.nama_wakil,
            tbl_paslon.visi,
            tbl_paslon.misi
        ');
        $this->db->from('tbl_paslon');
        $this->db->join('tbl_kandidat', 'tbl_kandidat.id_kandidat = tbl_paslon.id_kandidat');
        $this->db->where('tbl_paslon.id_paslon', $id_paslon);
        return $this->db->get()->result();
    }

    public function saveDataPaslon($dataKandidat, $dataPaslon){
        if($this->db->insert('tbl_kandidat', $dataKandidat)){
            return $this->db->insert('tbl_paslon', $dataPaslon);
        }
    }

    public function updateDataPas($id, $dataPaslon, $dataMhs){
       
        $this->db->set($dataPaslon);
        $this->db->where('id_paslon', $id);
        $this->db->update('tbl_paslon');
       
        $this->db->set($dataMhs);
        $this->db->where('id_kandidat', $id);
        return $this->db->update('tbl_kandidat');
    }

    public function deleteDataPaslon($id){
        
        //Mendapatkan nama file 
        $this->db->select('foto_ketua, foto_wakil');
        $this->db->from('tbl_kandidat');
        $this->db->where('id_kandidat', $id);
        $data = $this->db->get()->row_array();
        
        //jika sukses mengambil nama foto dari db
        if ($data['foto_ketua'] != 'default.jpg') {

            unlink(FCPATH . "./assets/src/img/paslon/ketua/" .$data['foto_ketua']); // Mengahpus Foto Ketua Dari Directory
            
            if ($data['foto_wakil'] != 'default.jpg') {
                
                unlink(FCPATH . "./assets/src/img/paslon/wakil/" .$data['foto_wakil']); //Menghapus Foto Wakil Dari Directory

            }
        }

        //menghapus data paslon dan kandidat di database
        $this->db->where('id_paslon', $id);
        if ($this->db->delete('tbl_paslon')) {
            $this->db->where('id_kandidat', $id);
            return $this->db->delete('tbl_kandidat');
            
        }
       
    }


//-------------------------------------------------DATA PANITIA-----------------------------------------------------------//

    public function getDataPanitia(){

        $this->db->select('*');
        $this->db->from('tbl_user');
        $this->db->where('id_role', 1 );
        $this->db->order_by('tbl_user.nim', 'ASC');
        return $this->db->get();

    }

    //NEW
    public function selectDataPanitia($id_user){
        $this->db->select('*');
        $this->db->from('tbl_user');
        $this->db->where('id_role', 1);
        $this->db->where('id_user', $id_user);
        return $this->db->get();

    }

    public function registerDataPanitia($dataPanitia){

        return $this->db->insert('tbl_user',$dataPanitia);

    }

    public function deleteDataPanitia($id_user){

        $this->db->where('id_user', $id_user);
        $this->db->where('id_role', 1);
        return $this->db->delete('tbl_user');

    }
    
    //NEW Ganti Password Panitia
    public function changePassword($nim, $newPassword){
        
        $this->db->set('password', $newPassword);
        $this->db->where('nim', $nim);
        return $this->db->update('tbl_user');
    }
}


