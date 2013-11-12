// JavaScript Document
function viewCreateServicePackage(idPackage, divIdentifier) {
	$.ajax({
		type: 'GET',
		url: 'index.php?r=package/viewService',
		data: { idPackage: idPackage, ajax: true },
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

function viewCreateServicePackageForm(idPackage, divResult) {
	$.ajax({
		type: 'GET',
		url: 'index.php?r=package/viewCreateServicePackage',
		data: { idPackage: idPackage, ajax: true },
		beforeSend:function(){
			$('#' + divResult).html('<div class="loading"><img src="../images/loading.gif" alt="Loading..." /></div>');
		},
		success:function(data){
			$('#' + divResult).empty();
			$('#' + divResult).html(data);
		},
		error:function(){
			$('#' + divResult).html('<p class="error"><strong>Oops!</strong> Try that again in a few moments.</p>');
		}
	});
}

function associateServicePackage(idPackage, idService, divResult, tabClick) {
	$.ajax({
		type: 'GET',
		url: 'index.php?r=package/associateServicePackage',
		data: { idPackage: idPackage, idService: idService, ajax: true },
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
			$('#' + divResult).html('<strong>Oops!</strong> Try that again in a few moments.');
			$('#' + divResult).removeClass('alert in alert-block fade alert-success').addClass('alert in alert-block fade alert-error');
		}
	});
}

function deassociateServicePackage(idPackage, idService, divResult, tabClick) {
	$.ajax({
		type: 'GET',
		url: 'index.php?r=package/deassociateServicePackage',
		data: { idPackage: idPackage, idService: idService, ajax: true },
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
			$('#' + divResult).html('<strong>Oops!</strong> Try that again in a few moments.');
			$('#' + divResult).removeClass('alert in alert-block fade alert-success').addClass('alert in alert-block fade alert-error');
		}
	});
}
