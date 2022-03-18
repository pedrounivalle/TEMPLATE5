
function mostrar2(response){
	document.getElementById('descrip3').innerHTML=response;
};

$.ajax({
		url: "php/consultadescripcion2.php",
		type: "get", 				
		success: function (response){		
			console.log(response);
			mostrar2(response);
						
		},	
		error: function(jqXHR, textStatus, errorThrown){
			console.log(textStatus, errorThrown);
		}
	});
	
