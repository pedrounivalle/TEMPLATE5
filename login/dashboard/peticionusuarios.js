
function mostrar1(response){
	document.getElementById('nivel2').innerHTML=response;
};

$.ajax({
		url: "php/consultausuarios.php",
		type: "get", 				
		success: function (response){		
			console.log(response);
			mostrar1(response);
						
		},	
		error: function(jqXHR, textStatus, errorThrown){
			console.log(textStatus, errorThrown);
		}
	});