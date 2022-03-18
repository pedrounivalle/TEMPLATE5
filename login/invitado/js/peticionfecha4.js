
function fecha4(response){
	document.getElementById('fecha4').innerHTML=response;
};

$.ajax({
		url: "php/consultafecha4.php",
		type: "get", 				
		success: function (response){		
			console.log(response);
			fecha4(response);
						
		},	
		error: function(jqXHR, textStatus, errorThrown){
			console.log(textStatus, errorThrown);
		}
	});
	
	
