<?php 
defined('BASEPATH') OR exit('No direct script access allowed');


class M_Data_Voting extends CI_Model {


     //DATA SUARA MAHASISWA YANG VALID
    public function dataVotedMhs(){

        $this->db->select('
        tbl_user.id_user,
        tbl_user.nim, 
        tbl_user.jurusan, 
        tbl_user.email,
        tbl_user.status_vote,
        tbl_kandidat.nama_ketua,
        tbl_kandidat.nama_wakil,
        ');
        $this->db->from('tbl_user');
        $this->db->join('tbl_kandidat', 'tbl_kandidat.id_kandidat = tbl_user.paslon_dipilih');
        $this->db->where('status_vote', 1);
        $this->db->where('id_role', 2);
        $this->db->order_by('nim', 'ASC');
        return $this->db->get()->result();

    }
    
        //DATA SUARA MAHASISWA YANG INVALID
    public function dataMhsVoteInvalid(){
        $this->db->select('
        tbl_user.nim, 
        tbl_user.jurusan, 
        tbl_user.email,
        tbl_user.status_vote,
        tbl_kandidat.nama_ketua,
        tbl_kandidat.nama_wakil,
        ');
        $this->db->from('tbl_user');
        $this->db->join('tbl_kandidat', 'tbl_kandidat.id_kandidat = tbl_user.paslon_dipilih');
        $this->db->where('status_vote', 2);
        $this->db->where('id_role', 2);
        $this->db->order_by('nim', 'ASC');
        return $this->db->get()->result();
    }


      //DATA MAHASISWA YANG BELUM VOTE
    public function dataMhsBelumVote(){
         $this->db->select('
        tbl_user.nim, 
        tbl_user.jurusan, 
        tbl_user.email,
        tbl_user.status_vote,
        ');
        $this->db->from('tbl_user');
        $this->db->where('status_vote', 0);
        $this->db->where('id_role', 2);
        $this->db->order_by('nim', 'ASC');
        return $this->db->get()->result();
    }

    public function hasilDataVoting(){

        $this->db->select('nomer_paslon, points_vote');
        $this->db->from('tbl_paslon');
        $this->db->order_by('nomer_paslon', 'ASC');
        return $this->db->get()->result();

    }


//--------------------------------- FUNGSI VOTING  ----------------------------------------------------------
   
   //jika data voting mahasiswa dan PANITIA di anggap tidak sah maka akan dihapus
    public function hapusVote($id_user){
        
        //mendapatkan id_kandidat dari nim mahasiswa yang dipilih
        $data = $this->db->get_where('tbl_user', ['id_user' => $id_user])->row_array();

        if ($data["paslon_dipilih"]) {
            //merubah status vote 
            $this->db->set('status_vote', "2");
            $this->db->where('id_user', $id_user);
            $query = $this->db->update('tbl_user');
            if ($query) { //mengubah status vote mahasiswa
                //mengurangi vote paslon yang telah dihapus data votingannya
                $this->db->set('points_vote', 'points_vote-1', FALSE);
                $this->db->where('id_paslon', $data['paslon_dipilih']);
                return $this->db->update('tbl_paslon');    
            } else {
                var_dump("Test");
                die();
            }
        } 

    }

    //Fungsi jika mahasiswa dan PAnitia melakukan vote
    public function tambahVote($nim, $id_kandidat){
      
        $this->db->set('paslon_dipilih', $id_kandidat);
        $this->db->set('status_vote', "1");
        $this->db->where('nim', $nim);
        if ($this->db->update('tbl_user')) {
              $this->db->set('points_vote', 'points_vote+1', FALSE);
              $this->db->where('id_paslon', $id_kandidat);
              return $this->db->update('tbl_paslon');
            # code...
        }


    }

    public function dataSudahVote(){

        return $this->db->query('SELECT count(*) AS total_data, sum(case when status_vote = 1 then 1 else 0 end) AS sudah_voting FROM tbl_user')->row_array();
   
    }

    public function dataBelumVote(){

        return $this->db->query('SELECT count(*) AS total_data, sum(case when status_vote = 0 then 1 else 0 end) AS belum_voting FROM tbl_user')->row_array();
    
    }

    public function dataVoteDitolak(){

        return $this->db->query('SELECT count(*) AS total_data, sum(case when status_vote = 2 then 1 else 0 end) AS voting_ditolak FROM tbl_user')->row_array();
    
    }

 

}