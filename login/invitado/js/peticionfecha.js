
function fecha1(response){
	document.getElementById('fecha1').innerHTML=response;
};

$.ajax({
		url: "php/consultafecha.php",
		type: "get", 				
		success: function (response){		
			console.log(response);
			fecha1(response);
						
		},	
		error: function(jqXHR, textStatus, errorThrown){
			console.log(textStatus, errorThrown);
		}
	});
	
	
