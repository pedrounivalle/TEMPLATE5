function mostrar3(response){
	document.getElementById('descrip4').innerHTML=response;
};

$.ajax({
		url: "php/consultadescripcion3.php",
		type: "get", 				
		success: function (response){		
			console.log(response);
			mostrar3(response);
						
		},	
		error: function(jqXHR, textStatus, errorThrown){
			console.log(textStatus, errorThrown);
		}
	});
	
