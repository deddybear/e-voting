//DashBoard Data Suara SUDAH VOTE ATAU TIDAK DAN TIDAK VALID
$(document).ready(function () {
	var sudahVote;
	var belumVote;
	var voteDitolak;

	readDataVoting();
	
	
	
	function readDataVoting() {
		setInterval(function(){
		
			$.ajax({
			type: 'GET',
			url: url + "/Data/analysisMhs",
			async: false,
			dataType: 'JSON',
            complete: function(){
                $('#loader-wrapper').hide();
            },
			success: function (data) {
				
				for (let index = 0; index < data.length; index++) {
					sudahVote = data[index]["sudah_vote"];
					belumVote = data[index]["belum_vote"];
					voteDitolak = data[index]["vote_ditolak"];
				}
				//progress bar belum
				$('#text-progress-belum').html(Math.round(belumVote) + "%");
				$('#progress-belum').css("width", Math.round(belumVote) + "%");

				//progress bar sudah
				$('#text-progress-sudah').html(Math.round(sudahVote) + "%");
				$('#progress-sudah').css("width", Math.round(sudahVote) + "%");
				
				$('#text-progress-ditolak').html(Math.round(voteDitolak) + "%");
				$('#progress-ditolak').css("width", Math.round(voteDitolak) + "%");
			},
			error: function (jqXHR, textStatus, error) {
				
			}
			});
		}, 10000);
	}



})
