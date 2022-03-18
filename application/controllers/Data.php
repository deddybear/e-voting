<?php
//CONTROLLERS UNTUK HALAMAN UTAMA DASHBOARD
defined('BASEPATH') OR exit('No direct script access allowed');

class Data extends CI_Controller{
    
    public function __construct(){
        parent::__construct();
        $this->load->model('M_Data_Voting');
        $this->load->model('M_Data_User');
    }
    
    //DATA MAHASISWA YANG SUDAH VOTE
    public function dataVotedMhs(){
       $data = $this->M_Data_Voting->dataVotedMhs();
       echo json_encode($data);
    }
    
    //DATA SUARA MAHASISWA YANG INVALID
    public function dataVoteInvalid(){
       $data = $this->M_Data_Voting->dataMhsVoteInvalid();
       echo json_encode($data);
    }
    
    //DATA MAHASISWA YANG BELUM VOTE
    public function dataBelumVote(){
       $data = $this->M_Data_Voting->dataMhsBelumVote();
       echo json_encode($data);
    }
    
    
    // Data voting untuk chart bar dan radio
    public function hasilDataVoting(){
       $data = $this->M_Data_Voting->hasildataVoting();
       echo json_encode($data);
    }

    // Data untuk melihat Mahasiswa yang sudah voting dan belum voting
    public function analysisMhs(){
       $sudahVote = $this->M_Data_Voting->dataSudahVote();
       $belumVote = $this->M_Data_Voting->dataBelumVote();
       $voteDitolak = $this->M_Data_Voting->dataVoteDitolak();

       $presentasiSudahVote = ($sudahVote["sudah_voting"] / $sudahVote["total_data"]) * 100 ;
       $presentasiBelumVote = ($belumVote["belum_voting"] / $sudahVote["total_data"]) * 100 ;
       $presentasiDitolak = ($voteDitolak["voting_ditolak"] / $sudahVote["total_data"]) * 100 ;

       $dataVote[] = (object) array(
           'sudah_vote' => $presentasiSudahVote,
           'belum_vote' => $presentasiBelumVote,
           'vote_ditolak' => $presentasiDitolak
       );
  
       echo json_encode($dataVote);
    }

    public function totalUser(){
       
        $data = $this->M_Data_User->totalUser();

        echo json_encode($data);
    }
}
