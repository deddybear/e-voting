$(document).ready(function () {

	readDataPanitia();

	//FUNGSI BACA DATA PANITIA
	function readDataPanitia() {
		//console.log(url);
		$.ajax({
			type: 'GET',
			url: url + "/Admin/dataPanitia",
			async: true,
			dataType: 'JSON',
			success: function (data) {
				console.log("Test");
				var nomer = 1;
				var html = '';
				var vote;
				for (let i = 0; i < data.length; i++) {

					if (data[i].status_vote == 0) {

						vote = "Belum Voting";

					} if (data[i].status_vote == 1) {

						vote = "Sudah Voting";

					} if (data[i].status_vote == 2){

						vote = "Vote Ditolak";
					}
					html += '<tr>' +
					    '<td>'+ nomer++ +'</td>'+
						'<td>' + data[i].nim + '</td>' +
						'<td>' + data[i].nama + '</td>' +
						'<td>' + data[i].jabatan + '</td>' +
						'<td>' + data[i].terdaftar + '</td>' +
						'<td>' + vote + '</td>' +
						'<td>' + 
						'<a href="#" class="btn btn-danger btn-sm data_hapus" data="' + data[i].id_user + '">Hapus Data Panitia</a>' + ' ' + '<a href="#" class="btn btn-warning btn-sm hapus_vote" data="' + data[i].id_user + '">Hapus Vote Panitia</a>' 
						 + '</td>' +
						'</tr>'
				}
				$('#show_data').html(html);
				$('#dataTable').DataTable();
			},
			error: function (paramsjqXHR, textStatus, error) {
				alert('Data Membaca Data' + paramsjqXHR + textStatus + error);
				
			}
	
		});


	}


	// FUNGSI TAMBAH DATA PANITIA
	$('#form').on('submit', function (event) {
        event.preventDefault();
		var data = $('#form').serialize();
		console.log(data);
		$.ajax({
			url: url + "Admin/registerPanitia",
			type: 'POST',
			data: data,
			dataType: 'JSON',
			success: function (data) {
				alert("Berhasil Ditambah");
			
				$('#form')[0].reset();
				location.reload();
               
			},
			error: function () {
				alert('Gagal Mendaftarkan Panitia');
				location.reload();

			}
		});
	});

	
	//FUNGSI HAPUS DATA PANITIA
	$('#show_data').on('click', '.data_hapus', function () {
		if (confirm('Apakah Anda Yakin Ingin Menghapus Data Panitia ini ?')) {
			var id = $(this).attr('data');
			$.ajax({
				url: url + "Admin/deletePanitia/" + id,
				type: 'POST',
				dataType: 'JSON',
				success: function (data) {
					alert("Berhasil Dihapus");
					location.reload();

					window.history.pushState(url + "/Admin/panelAdmin");


				},
				error: function (paramsjqXHR, textStatus, error) {
					alert('Data Gagal Dihapus' + paramsjqXHR + textStatus + error);
					
				}
			})
		}
	})

    //FUNGSI HAPUS VOTE PANITIA
	$('#show_data').on('click', '.hapus_vote', function () {
		if (confirm('Apakah Anda Yakin Ingin Menghapus Data Panitia ini ?')) {
			var id = $(this).attr('data');
			$.ajax({
				url: url + "Admin/deleteVotePanitia/" + id,
				type: 'POST',
				dataType: 'JSON',
				success: function (data) {
					alert("Berhasil Dihapus");
					location.reload();

					window.history.pushState(url + "/Admin/panelAdmin");


				},
				error: function (paramsjqXHR, textStatus, error) {
					alert('Data Gagal Dihapus' + paramsjqXHR + textStatus + error);
					
				}
			})
		}
	})
})
