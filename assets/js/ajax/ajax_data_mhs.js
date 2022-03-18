$(document).ready(function(){
    $('.js-example-basic-single').select2();
    var urlTemp;
    var method;

    readDataMahasiswa();

    //fungsi Read Data Mahasiswa
    function readDataMahasiswa(){
 
            $.ajax({
                type    : 'GET',
                url     : url + "Panitia/dataMahasiswa",
                async   : true,
                dataType : 'json',
                beforeSend: function(){
                  // Show image container
                  $('#loader-wrapper').show();
                },
                complete: function(){
                  $('#loader-wrapper').hide();
                },
                success : function(data){
                    console.log("data sukses");
                    var nomer = 1;
                    var html = '';
                    var i;
                    for (i = 0; i < data.length; i++) {
                       html += '<tr>'+
                               '<td>'+ nomer++ +'</td>'+
                               '<td>'+data[i].nim+'</td>'+
                               '<td>'+data[i].jurusan+'</td>'+
                               '<td>'+data[i].email+'</td>'+
                               '<td>'+data[i].terdaftar+'</td>'+
                               '<td>'+ 
                               '<a href="javascript:;" class="btn btn-info btn-xs edit_data" data="'+data[i].id_user+'">Edit</a>'+' '+
                               '<a href="javascript:;" class="btn btn-danger btn-xs hapus_data" data="'+data[i].id_user+'">Hapus</a>'+
                               '</td>'+ 
                               '</tr>';
                        
                    }
                    $('#show_data').html(html);
                    $('#dataTable').DataTable();
                }
            });
   
       
    }
  
    //FUNGSI UNTUK TOMBOL DATA DAN MEMBERI VALUE VAR METHOD TAMBAH 
    $("#tambahdata").click(function(){
        $('modal-title').html("Tambah Data Paslon");
        $('#form')[0].reset();
        method = "tambah";
    })


    //FUNGSI TAMBAH DATA MAHASISWA + MENGEDIT DATA MAHASISWA
    $('#form').on('submit', function(event) {

        event.preventDefault();

        if (method == "tambah") {
            
            urlTemp = url + "Panitia/tambahDataMhs";
            
            
        } else {

            urlTemp = url + "Panitia/updateDataMhs";
         
        }
        
        var data = $('#form').serialize();
     
        $.ajax({
            url : urlTemp,
            type: 'POST',
            dataType: 'JSON',
            data: data,
            beforeSend: function(){
                  // Show image container
                $('#modal_form').modal('hide');
                $('#loader-wrapper').show();
            },
            complete: function(){
                $('#loader-wrapper').hide();
            },
            success: function(data){
                if (data.error) {
                    
                    alert('Error ' + method + data.error);

                } else {
                    
                    alert("Data Berhasil di" + method);
					$('#modal_form').modal('hide');
					$('#form')[0].reset();
					location.reload();

                }
            },
            error: function(jqXHR, textStatus, error){
                alert('Error Adding Data / Update : ' + jqXHR + textStatus + error);
                location.reload();
            }
        });
    })

    //FUNGSI SELECT DAN TAMPILKAN DATA  MAHASISWA YANG MAU DI EDIT
    $('#show_data').on('click', '.edit_data', function(){
       $('#form')[0].reset();
        method = "update";

        console.log(method);
            $('#form')[0].reset();

            var idUser = $(this).attr('data');
            $.ajax({
                type: 'GET',
                url: url + "/Panitia/selectDataMhs/" + idUser,
                dataType: 'JSON',
                beforeSend: function(){
                  // Show image container
                    $('#loader-wrapper').show();
                },
                complete: function(){
                   $('#loader-wrapper').hide();
                },
                success: function(data){
                    for (var index = 0; index < data.length; index++) {
                        $('[name="idmhs"]').val(data[index].id_user);
                        $('[name="nim"]').val(data[index].nim);
                        $('[name="jurusan"]').val(data[index].jurusan);
                        $('[name="email"]').val(data[index].email);
                    }
                    $('#modal_form').modal('show');
                    $('.modal-title').text("Edit Data Mahasiswa");
                },
                error: function name (paramsjqXHR, textStatus, error) {
                    alert('Error : ' + paramsjqXHR + textStatus + error);
                   
                }
            })
    })

    //MENGHAPUS DATA MAHASISWA YANG DIPILIH   
    $('#show_data').on('click', '.hapus_data', function(){
        if (confirm('Apakah Anda Yakin ingin menghapus data mahasiswa Ini ?')) {
            var idUser = $(this).attr('data');
            $.ajax({
                type: 'POST',
                url: url + "/Panitia/deleteDataMhs/" + idUser,
                dataType: 'JSON',
                beforeSend: function(){
                  // Show image container
                    $('#loader-wrapper').show();
                },
                complete: function(){
                    $('#loader-wrapper').hide();
                },
                success: function(data){
                    alert('Data Berhasil Dihapus !');
                    location.reload();
                },
                error: function name(paramsjqXHR, textStatus, error) {
                    alert('Error : ' +paramsjqXHR + textStatus + error);
                }
            })
        }
    })
  

})
