
function fecha3(response){
	document.getElementById('fecha3').innerHTML=response;
};

$.ajax({
		url: "php/consultafecha3.php",
		type: "get", 				
		success: function (response){		
			console.log(response);
			fecha3(response);
						
		},	
		error: function(jqXHR, textStatus, errorThrown){
			console.log(textStatus, errorThrown);
		}
	});
	
	
