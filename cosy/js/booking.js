// JavaScript Document
function createBooking(divIdentifier, roomId, startDate) {
	$.ajax({
	  type: 'GET',
	  url: 'index.php?r=booking/ajaxCreate',
	  data: { room: roomId, start_date: startDate },
	  beforeSend:function(){
	    // this is where we append a loading image
	    $('#bookingModal').css('width', '800px');
	    $('#bookingModal').css('margin-left', '-400px');
	    $('#modalTitle').text('Create Booking');
	    $('#buttonModal').click();
	    $('#' + divIdentifier).html('<div class="loading"><img src="../images/loading.gif" alt="Loading..." /></div>');   
	  },
	  success:function(data){
	    // successful request; do something with the data
	    $('#' + divIdentifier).empty();
	    $('#' + divIdentifier).html(data);
	  },
	  error:function(){
	    // failed request; give feedback to user
	    $('#' + divIdentifier).html('<p class="error"><strong>Oops!</strong> Try that again in a few moments.</p>');
	  }
	});
}


function viewBooking(idBooking, divIdentifier) {
	$.ajax({
	  type: 'GET',
	  url: 'index.php?r=booking/ajaxView',
	  data: { id: idBooking, ajax: true },
	  beforeSend:function(){
	    // this is where we append a loading image
	    $('#bookingModal').css('width', '600px');
	    $('#bookingModal').css('margin-left', '-250px');
	    $('#modalTitle').text('View Booking');
	    $('#buttonModal').click();
	    $('#' + divIdentifier).html('<div class="loading"><img src="../images/loading.gif" alt="Loading..." /></div>');   
	  },
	  success:function(data){
	    // successful request; do something with the data
	    $('#' + divIdentifier).empty();
	    $('#' + divIdentifier).html(data);
	  },
	  error:function(){
	    // failed request; give feedback to user
	    $('#' + divIdentifier).html('<p class="error"><strong>Oops!</strong> Try that again in a few moments.</p>');
	  }
	});
}

function updateBooking(idBooking, divIdentifier) {
	$.ajax({
	  type: 'GET',
	  url: 'index.php?r=booking/ajaxUpdate',
	  data: { id: idBooking },
	  beforeSend:function(){
	    // this is where we append a loading image
	    $('#bookingModal').css('width', '800px');
	    $('#bookingModal').css('margin-left', '-400px');
	    $('#modalTitle').text('Update Booking');
	    $('#buttonModal').click();
	    $('#' + divIdentifier).html('<div class="loading"><img src="../images/loading.gif" alt="Loading..." />Load..</div>');
	  },
	  success:function(data){
	  	
	  	console.log(data);
	  	
	    // successful request; do something with the data
	    $('#' + divIdentifier).empty();
	    $('#' + divIdentifier).html(data);
	    
	    /*$(data).find('item').each(function(i){
	      $('#' + divIdentifier).append('<h4>' + $(this).find('title').text() + '</h4><p>' + $(this).find('link').text() + '</p>');
	    });*/
	  },
	  error:function(){
	    // failed request; give feedback to user
	    $('#' + divIdentifier).html('<p class="error"><strong>Oops!</strong> Try that again in a few moments.</p>');
	  }
	});
}