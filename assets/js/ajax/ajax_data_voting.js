$(document).ready(function () {

	readDataVoting();
	dataVotingInvalid();
    dataBelumVoting();
    
	//FUNGSI UNTUK MENGAMBIL DATA MAHASISWA YANG SUDAH VOTE
	function readDataVoting() {
		
		$.ajax({
			type: 'GET',
			url: url + "/Data/dataVotedMhs",
			async: true,
			dataType: 'json',
			beforeSend: function(){
                  // Show image container
                $('#loader-wrapper').show();
            },
            complete: function(){
                $('#loader-wrapper').hide();
            },
			success: function (data) {
			    let nomer = 1;
				var status_vote;
				var html = "";
				for (let index = 0; index < data.length; index++) {
					if(data[index].status_vote == "0"){
					    
					    status_vote = "Belum Voting";
					    
					}else if (data[index].status_vote == "1") {

						status_vote = "Sudah Voting";

					}else if(data[index].status_vote == "2") {

						status_vote = "Vote Ditolak ";

					}
					html += '<tr>' +
					    '<td>'+ nomer++ +'</td>'+
						'<td>' + data[index].nim + '</td>' +
						'<td>' + data[index].jurusan + '</td>' +
						'<td>' + data[index].email + '</td>' +
						'<td>' + status_vote + '</td>' +
						'<td>' + data[index].nama_ketua + " & " + data[index].nama_wakil + '</td>' +
						'<td>' + '<a href="javascript:;" class="btn btn-danger btn-xs data_hapus" data="' + data[index].id_user + '" >Data Vote Tidak Valid</a>' + '</td>' 
						+'</tr>';
				}
				$('#show_data').html(html);
				$('#dataTable').DataTable();
			},
			error: function (jqXHR, textStatus, error) {
				alert('Error Read Data Voting : ' + error + jqXHR + textStatus);
			}
		})
	}
	
	//FUNGSI UNTUK MENGAMBIL DATA TIDAK VALID 
	function dataVotingInvalid() {	
		
		$.ajax({
			type: 'GET',
			url: url + "/Data/dataVoteInvalid",
			async: true,
			dataType: 'json',
			beforeSend: function(){
                  // Show image container
                $('#loader-wrapper').show();
            },
            complete: function(){
                $('#loader-wrapper').hide();
            },
			success: function (data) {
				var status_vote;
				var html = "";
				let nomer = 1;
				for (let index = 0; index < data.length; index++) {
					 if(data[index].status_vote == "2") {

						status_vote = "Vote Ditolak ";

					}
					html += '<tr>' +
					    '<td>'+ nomer++ +'</td>'+
						'<td>' + data[index].nim + '</td>' +
						'<td>' + data[index].jurusan + '</td>' +
						'<td>' + data[index].email + '</td>' +
						'<td>' + status_vote + '</td>' +
						'<td>'+ data[index].nama_ketua + " & " + data[index].nama_wakil + ' </td>' 
						+'</tr>';
				}
				$('#tableTidakValid').html(html);
				$('#dataTidakValid').DataTable();
			},
			error: function (jqXHR, textStatus, error) {
				alert('Error Read Data Voting : ' + error + jqXHR + textStatus);
			}
		})
	}
	
	
	//FUNGSI UNTUK MENGAMBIL DATA YANG BELUM VOTE
	function dataBelumVoting() {
		
		$.ajax({
			type: 'GET',
			url: url + "/Data/dataBelumVote",
			async: true,
			dataType: 'json',
			beforeSend: function(){
                  // Show image container
                $('#loader-wrapper').show();
            },
            complete: function(){
                $('#loader-wrapper').hide();
            },
			success: function (data) {
				var status_vote;
				var html = "";
				let nomer = 1;
				for (let index = 0; index < data.length; index++) {
					if(data[index].status_vote == "0"){
					    
					    status_vote = "Belum Voting";
					    
					}
					html += '<tr>' +
					    '<td>'+ nomer++ +'</td>'+
						'<td>' + data[index].nim + '</td>' +
						'<td>' + data[index].jurusan + '</td>' +
						'<td>' + data[index].email + '</td>' +
						'<td>' + status_vote + '</td>' +
						'<td> Belum Memilih </td>' 
						+'</tr>';
				}
				$('#tableBelumVote').html(html);
				$('#dataBelumVote').DataTable();
			},
			error: function (jqXHR, textStatus, error) {
				alert('Error Read Data Voting : ' + error + jqXHR + textStatus);
			}
		})
	}

	//FUNGSI MENGHAPUS DATA VOTE MAHASISWA JIKA TIDAK VALIDS
	$('#show_data').on('click', '.data_hapus', function () {
		if (confirm('Apakah Anda Yakin ingin menghapus Data Vote ini ?')) {
			var id = $(this).attr('data');
			$.ajax({
				type: 'POST',
				url: url + "/Panitia/deleteVoteData/" + id,
				dataType: 'JSON',
				beforeSend: function(){
                  // Show image container
                    $('#loader-wrapper').show();
                },
                complete: function(){
                    $('#loader-wrapper').hide();
                },
				success: function (data) {
					alert("Berhasil Menghapus Data Vote");
					location.reload();
				},
				error: function name(paramsjqXHR, textStatus, error) {
					alert('Data Gagal Dihapus' + paramsjqXHR + textStatus + error);
					
				}
			});
		}
	});
});
