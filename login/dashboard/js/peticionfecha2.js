
function fecha2(response){
	document.getElementById('fecha2').innerHTML=response;
};

$.ajax({
		url: "php/consultafecha2.php",
		type: "get", 				
		success: function (response){		
			console.log(response);
			fecha2(response);
						
		},	
		error: function(jqXHR, textStatus, errorThrown){
			console.log(textStatus, errorThrown);
		}
	});
	
	
