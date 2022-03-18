$(document).ready(function(){


	document.onkeydown = function (e) {
		if (event.keyCode == 123) {
			return false;
		}
		if (e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) {
			return false;
		}
		if (e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)) {
			return false;
		}
		if (e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) {
			return false;
		}
		if (e.ctrlKey && e.shiftKey && e.keyCode == 'K'.charCodeAt(0)) {
			return false;
		}
		if (e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {
			return false;
		}
	}

	window.addEventListener('devtoolschange', function (e) {
		
		if (e.detail.open) {

			$("body").html("<center style='margin:150px 0'><h1>Dimohon untuk menutup Fitur Webdeveloper!</h1></center>");
			alert("Dimohon untuk menutup Fitur Webdeveloper!");

		} else {

			location.reload();
			
		}
	});
})