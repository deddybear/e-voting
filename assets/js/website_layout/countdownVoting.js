$(document).ready(function () {
    
    countDown();

    $(".owl-carousel").owlCarousel({
        items:1,
        nav:true,
        center:true,

    });


	function countDown() {
		//@ts-nocheckconsole.log("yeah aktiv");

        setInterval(function(){
            var timeNow = new Date();
            var endTime = new Date("2020/10/28 15:00:00");
            var startTime = new Date("2020/9/28 08:00:00");
            // console.log(startTime);
            //  console.log(endTime);
    
            var distance = endTime - timeNow;
            //  console.log(distance);
    
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);            
            	//&& timeNow < endTime
            if (timeNow) {
                
                if (distance > 0){
                
                	$('#countdown').html( days + "D" + ":" + hours + "H" + ":" + minutes + "M" + ":" + seconds + "S" );
                	
                } 
                  
  
    
                    $('#countdown').html("WAKTU TELAH HABIS");
           
                
            } else {
    
                $('#countdown').html("<div class='alert alert-warning' role='alert'> Sistem voting belum dibuka </div>");

            }

        }, 1000);

	}
});
