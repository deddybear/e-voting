$(document).ready(function () {

	//DOM UPLOAD FIELD
	$('.custom-file-input').on('change', function () {
		let filename = $(this).val().split('\\').pop();
		$(this).next('.custom-file-label').addClass("selected").html(filename);
	});

	var method; //var untuk menentukan method yang dipakai
	var urlTemp; //variable untuk url

	readDataPaslon();

	//FUNGSI UNTUK MEMBACA DATA PASLON	
	function readDataPaslon() {
		//membaca data paslon

			$.ajax({
				type: 'GET',
				url: url + "/Panitia/dataPaslon",
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
					//console.log("data sukses");
					
                    var nomer = 1;
					var html = '';
					var i;
					for (i = 0; i < data.length; i++) {

						html += '<tr>' +
						    '<td>'+ nomer++ +'</td>'+
							'<td>' + data[i].nomer_paslon + '</td>' +
							'<td>' + data[i].nama_ketua + '</td>' +
							'<td>' + data[i].nama_wakil + '</td>' +
							'<td><img class="img-paslon" src="' + base_url + 'assets/src/img/paslon/ketua/' + data[i].foto_ketua + '">' + '</td>' +
							'<td><img class="img-paslon" src="' + base_url + 'assets/src/img/paslon/wakil/' + data[i].foto_wakil + '">' + '</td>' +
							'<td>' + data[i].visi + '</td>' +
							'<td>' + data[i].misi + '</td>' +
							'<td>' +
							'<a href="javascript:;" class="btn btn-info btn-xs item_edit" data="' +
							data[i].id_paslon + '">Edit</a>' + ' ' +
							'<a href="javascript:;" class="btn btn-danger btn-xs item_hapus" data="' +
							data[i].id_paslon + '">Hapus</a>' +
							'</td>' +
							'</tr>'
					}
					$('#show_data').html(html);
					$('#dataTable').DataTable();
				},
				error: function (jqXHR, textStatus, error) {
					alert('Error Adding Data / Update:' + jqXHR + textStatus + error);
					console.log(error);
				}
			});
	
	}

	//FUNGSI UNTUK TOMBOL DATA DAN MEMBERI VALUE VAR METHOD TAMBAH 
	$("#tambahdata").click(function () {
		$('.modal-title').html("Tambah Data Paslon");
	    $('#form')[0].reset();
		method = "tambah";
	})

	//FUNGSI TAMBAH DAT PASLON + MENGEDIT DATA PASLON
	$('#form').on('submit', function (event) {

		event.preventDefault();

		if (method == "tambah") {

			urlTemp = url + "/Panitia/tambahDataPaslon";
			

		} else {

			urlTemp = url + "/Panitia/updateDataPaslon";
			
		}
	
		var data = $('#form').serialize(); // MENGAMBIL DATA INPUTTAN
		
		$.ajax({
			url: urlTemp,
			type: 'POST',
			dataType: 'JSON',
			data: data,
			beforeSend: function(){
                  // Show image container
                  $('#modal_form').hide();
                  $('#loader-wrapper').show();
            },
            complete: function(){
                  $('#loader-wrapper').hide();
            },
			success: function (data) {
				if (data.error) {
					
					alert('Error ' + method + ' Data dimohon untuk mengisi dengan benar');

				} else {

					alert("Data Berhasil di" + method);
					$('#modal_form').modal('hide');
					$('#form')[0].reset();
					location.reload();

				}
			},
			error: function (jqXHR, textStatus, error) {
				alert('Error Adding Data / Update:' + jqXHR + textStatus + error);
				location.reload();
			}
		})
	})

	//FUNGSI SELECT DAN TAMPILKAN DATA PASLON YANG MAU DI EDIT
	$('#show_data').on('click', '.item_edit', function () {
		method = "update";
		$('#form')[0].reset();

		var id = $(this).attr('data');
		$.ajax({
			type: 'GET',
			url: url + "/Panitia/selectDataPaslon/" + id,
			dataType: 'JSON',
			beforeSend: function(){
                  // Show image container
                  $('#loader-wrapper').show();
            },
            complete: function(){
                  $('#loader-wrapper').hide();
            },
			success: function (data) {
				for (var index = 0; index < data.length; index++) {
					$('[name="idpaslon"').val(data[index].id_paslon);
					$('[name="nomerpaslon"').val(data[index].nomer_paslon);
					$('[name="namaketua"').val(data[index].nama_ketua);
					$('[name="namawakil"').val(data[index].nama_wakil);
					$('[name="visi"').val(data[index].visi);
					$('[name="misi"').val(data[index].misi);

				}

				$('#modal_form').modal('show');
				$('.modal-title').text("Edit Data Paslon");
			},
			error: function name(paramsjqXHR, textStatus, error) {
				alert('Coba Sekali Lagi' + paramsjqXHR + textStatus + error);
				
				location.reload();

			}
		});
	});

	//FUNGSI MENGHAPUS DATA PASLON
	$('#show_data').on('click', '.item_hapus', function () {
		if (confirm('Apakah Anda Yakin ingin menghapus Data Paslon ini ?')) {
			var id = $(this).attr('data');
			$.ajax({
				type: 'POST',
				url: url + "/Panitia/deletePaslon/" + id,
				dataType: 'JSON',
				beforeSend: function(){
                  // Show image container
                  $('#loader-wrapper').show();
                },
                complete: function(){
                  $('#loader-wrapper').hide();
                },
				success: function (data) {
					alert("Berhasil Menghapus Data paslon");
					location.reload();
				},
				error: function name(paramsjqXHR, textStatus, error) {
					alert('Data Gagal Dihapus' + paramsjqXHR + textStatus + error);
				
				}
			});
		}
	});

	//FUNGSI MENGAMBIL Data Paslon untuk FIELD PADA FORM UPLOAD 
	$("#uploadfoto").click(function () {
	    $('#form')[0].reset();
	});
	
	$('#data_paslon').change(function () {
		var id = $(this).val();
		
		if(id == '0') {
		    
	        $('#dataketua').val("");
			$('#datawakil').val("");	   
	        
		} else {
		    
		    $.ajax({
			    type: 'GET',
			    url: url + "/Panitia/selectDataPaslon/" + id,
			    dataType: 'JSON',
			    beforeSend: function(){
                  // Show image container
                    $('#loader-wrapper').show();
                },
                complete: function(){
                    $('#loader-wrapper').hide();
                },
			    success: function (data) {
				    for (let index = 0; index < data.length; index++) {
					    $('#dataketua').val(data[index].nama_ketua);
					    $('#datawakil').val(data[index].nama_wakil);
				    }

			    },
			    error: function (paramsjqXHR, textStatus, error) {
				    alert(paramsjqXHR + textStatus + error);
			    }
		    });
		}
		

	})

});
