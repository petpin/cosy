// JavaScript Document
function createBooking(divIdentifier, roomId, startDate, modalTitle) {
	$.ajax({
		type: 'GET',
		url: 'index.php?r=booking/ajaxCreate',
		data: { room: roomId, start_date: startDate, ajaxRequest: true, url: $(location).attr('href') },
		beforeSend:function(){
			$('#bookingModal').css('width', '70%');
			$('#bookingModal').css('margin-left', '-35%');
			$('#modalTitle').text(modalTitle);
			$('#buttonModal').click();
			$('#' + divIdentifier).html('<div class="loading"><img src="../images/loading.gif" alt="Loading.." /></div>');
			$('#createModalAjaxButton').css('visibility', '');
			$('#updateModalAjaxButton').css('visibility', 'hidden');
			$('#updateModalAjaxButton').css('display', 'none');
		},
		success:function(data){
			$('#' + divIdentifier).empty();
			$('#' + divIdentifier).html(data);
		},
		error:function(){
			$('#' + divIdentifier).html('<p class="error"><strong>Oops!</strong> Try that again in a few moments.</p>');
		}
	});
}

function viewBooking(idBooking, divIdentifier, modalTitle) {
	$.ajax({
		type: 'GET',
		url: 'index.php?r=booking/view',
		data: { id: idBooking, ajax: true },
		beforeSend:function(){
			$('#bookingModal').css('width', '70%');
			$('#bookingModal').css('margin-left', '-35%');
			$('#modalTitle').text(modalTitle);
			$('#buttonModal').click();
			$('#' + divIdentifier).html('<div class="loading"><img src="../images/loading.gif" alt="Loading.." /></div>');
			$('#createModalAjaxButton').css('visibility', 'hidden');
			$('#updateModalAjaxButton').css('visibility', 'hidden');
		},
		success:function(data){
			$('#' + divIdentifier).empty();
			$('#' + divIdentifier).html(data);
		},
		error:function(){
			$('#' + divIdentifier).html('<p class="error"><strong>Oops!</strong> Try that again in a few moments.</p>');
		}
	});
}

function updateBooking(idBooking, divIdentifier, modalTitle) {
	$.ajax({
		type: 'GET',
		url: 'index.php?r=booking/ajaxUpdate',
		data: { id: idBooking, ajaxRequest: true },
		beforeSend:function(){
			$('#bookingModal').css('width', '70%');
			$('#bookingModal').css('margin-left', '-35%');
			$('#modalTitle').text(modalTitle);
			$('#buttonModal').click();
			$('#' + divIdentifier).html('<div class="loading"><img src="../images/loading.gif" alt="Loading.." /></div>');
			$('#createModalAjaxButton').css('visibility', 'hidden');
			$('#updateModalAjaxButton').css('visibility', '');
			$('#updateModalAjaxButton').removeAttr('style');
		},
		success:function(data){
			$('#' + divIdentifier).empty();
			$('#' + divIdentifier).html(data);
		},
		error:function(){
			$('#' + divIdentifier).html('<p class="error"><strong>Oops!</strong> Try that again in a few moments.</p>');
		}
	});
}

function updateBookingViewTab(idBooking) {
	$.ajax({
		type: 'GET',
		url: 'index.php?r=booking/updateBookingViewTab',
		data: { id: idBooking },
		beforeSend:function(){
			//$('#' + divIdentifier).html('<div class="loading"><img src="../images/loading.gif" alt="Loading.." /></div>');
		},
		success:function(data){
			//$('#' + divIdentifier).empty();
			//$('#' + divIdentifier).html(data);
		},
		error:function(){
			//$('#' + divIdentifier).html('<p class="error"><strong>Oops!</strong> Try that again in a few moments.</p>');
		}
	});
}

function viewDetails(idBooking, divIdentifier) {
	$.ajax({
		type: 'GET',
		url: 'index.php?r=booking/viewDetails',
		data: { id: idBooking, ajax: true },
		beforeSend:function(){
			$('#' + divIdentifier).html('<div class="loading"><img src="../images/loading.gif" alt="Loading.." /></div>');
		},
		success:function(data){
			$('#' + divIdentifier).empty();
			$('#' + divIdentifier).html(data);
		},
		error:function(){
			$('#' + divIdentifier).html('<p class="error"><strong>Oops!</strong> Try that again in a few moments.</p>');
		}
	});
}

function viewDays(idBooking, divIdentifier) {
	$.ajax({
		type: 'GET',
		url: 'index.php?r=booking/viewDays',
		data: { id: idBooking, ajax: true },
		beforeSend:function(){
			$('#' + divIdentifier).html('<div class="loading"><img src="../images/loading.gif" alt="Loading..." /></div>');
		},
		success:function(data){
			$('#' + divIdentifier).empty();
			$('#' + divIdentifier).html(data);
		},
		error:function(){
			$('#' + divIdentifier).html('<p class="error"><strong>Oops!</strong> Try that again in a few moments.</p>');
		}
	});
}

function viewGuest(idBooking, divIdentifier) {
	$.ajax({
		type: 'GET',
		url: 'index.php?r=booking/viewGuest',
		data: { id: idBooking, ajax: true },
		beforeSend:function(){
			$('#' + divIdentifier).html('<div class="loading"><img src="../images/loading.gif" alt="Loading..." /></div>');
		},
		success:function(data){
			$('#' + divIdentifier).empty();
			$('#' + divIdentifier).html(data);
		},
		error:function(){
			$('#' + divIdentifier).html('<p class="alert in alert-block fade alert-error"><strong>Oops!</strong> Try that again in a few moments.</p>');
		}
	});
}

function viewSupplier(idBooking, idSupplier, totalToPay, divIdentifier) {
	$.ajax({
		type: 'GET',
		url: 'index.php?r=booking/viewSupplier',
		data: { idBooking: idBooking, idSupplier: idSupplier, totalToPay: totalToPay },
		beforeSend:function(){
			$('#' + divIdentifier).html('<div class="loading"><img src="../images/loading.gif" alt="Loading..." /></div>');
		},
		success:function(data){
			$('#' + divIdentifier).empty();
			$('#' + divIdentifier).html(data);
		},
		error:function(){
			$('#' + divIdentifier).html('<p class="alert in alert-block fade alert-error"><strong>Oops!</strong> Try that again in a few moments.</p>');
		}
	});
}

function viewCreateGuest(idBooking, divIdentifier) {
	$.ajax({
		type: 'GET',
		url: 'index.php?r=guest/create',
		data: { idBooking: idBooking, ajax: true },
		beforeSend:function(){
			$('#' + divIdentifier).html('<div class="loading"><img src="../images/loading.gif" alt="Loading..." /></div>');
		},
		success:function(data){
			$('#' + divIdentifier).empty();
			$('#' + divIdentifier).html(data);
		},
		error:function(){
			$('#' + divIdentifier).html('<p class="alert in alert-block fade alert-error"><strong>Oops!</strong> Try that again in a few moments.</p>');
		}
	});
}

function associateBookingGuest(idBooking, guestName, guestEmail, guestPhone, divIdentifier) {
	$.ajax({
		type: 'GET',
		url: 'index.php?r=guest/associateBookingGuest',
		data: { guestName: guestName, guestEmail: guestEmail, guestPhone: guestPhone, idBooking: idBooking, ajax: true },
		beforeSend:function(){
			$('#' + divIdentifier).html('<img src="../images/loading.gif" alt="Loading..." />');
		},
		success:function(data){
			$('#' + divIdentifier).empty();
			$('#' + divIdentifier).html(data);
			setTimeout(function(){ 
				$('#linkBookingTab3').click();
			}, 3000 );
		},
		error:function(data){
			$('#' + divIdentifier).html('<br /><p class="alert in alert-block fade alert-error"><strong>Oops!</strong> Try that again in a few moments.</p>');
		}
	});
}

function viewPackages(idBooking, divIdentifier) {
	$.ajax({
		type: 'GET',
		url: 'index.php?r=booking/viewPackages',
		data: { idBooking: idBooking, ajax: true },
		beforeSend:function(){
			$('#' + divIdentifier).html('<div class="loading"><img src="../images/loading.gif" alt="Loading..." /></div>');
		},
		success:function(data){
			$('#' + divIdentifier).empty();
			$('#' + divIdentifier).html(data);
		},
		error:function(){
			$('#' + divIdentifier).html('<p class="alert in alert-block fade alert-error"><strong>Oops!</strong> Try that again in a few moments.</p>');
		}
	});
}

function viewCreateBookingPackage(idBooking, divIdentifier) {
	$.ajax({
		type: 'GET',
		url: 'index.php?r=booking/viewCreateBookingPackage',
		data: { idBooking: idBooking, ajax: true },
		beforeSend:function(){
			$('#' + divIdentifier).html('<img src="../images/loading.gif" alt="Loading..." />');
		},
		success:function(data){
			$('#' + divIdentifier).empty();
			$('#' + divIdentifier).html(data);
		},
		error:function(){
			$('#' + divIdentifier).html('<br /><p class="alert in alert-block fade alert-error"><strong>Oops!</strong> Try that again in a few moments.</p>');
		}
	});
}

function associateBookingPackage(idBooking, idPackage, divIdentifier, tabClick) {
	$.ajax({
		type: 'GET',
		url: 'index.php?r=booking/associateBookingPackage',
		data: { idBooking: idBooking, idPackage: idPackage, ajax: true },
		dataType: 'json',
		beforeSend:function(){
			$('#' + divIdentifier).html('<img src="../images/loading.gif" alt="Loading..." />');
		},
		success:function(data){
			$('#' + divIdentifier).empty();
			if(data.error == true)
			{
				$('#' + divIdentifier).html(data.message);
				$('#' + divIdentifier).removeClass('alert in alert-block fade alert-success').addClass('alert in alert-block fade alert-error');
			}
			else
			{
				$('#' + divIdentifier).html(data.message);
				$('#' + divIdentifier).removeClass('alert in alert-block fade alert-error').addClass('alert in alert-block fade alert-success');
				setTimeout(function(){ 
					$('#' + tabClick).click();
				}, 2000 );	
			}
		},
		error:function(data){
			$('#' + divIdentifier).html('<br /><p class="alert in alert-block fade alert-error"><strong>Oops!</strong> Try that again in a few moments.</p>');
		}
	});
}

function deassociateBookingPackage(idBooking, idPackage, divResult, tabClick) {
	$.ajax({
		type: 'GET',
		url: 'index.php?r=booking/deassociateBookingPackage',
		data: { idBooking: idBooking, idPackage: idPackage, ajax: true },
		dataType: 'json',
		beforeSend:function(){
			$('#' + divResult).html('<img src="../images/loading.gif" alt="Loading..." />');
		},
		success:function(data){
			$('#' + divResult).empty();
			if(data.error == true)
			{
				$('#' + divResult).html(data.message);
				$('#' + divResult).removeClass('alert in alert-block fade alert-success').addClass('alert in alert-block fade alert-error');
			}
			else
			{
				$('#' + divResult).html(data.message);
				$('#' + divResult).removeClass('alert in alert-block fade alert-error').addClass('alert in alert-block fade alert-success');
				setTimeout(function(){ 
					$('#' + tabClick).click();
				}, 2000 );	
			}
		},
		error:function(data){
			$('#' + divResult).html('<br /><p class="error"><strong>Oops!</strong> Try that again in a few moments.</p>');
		}
	});
}