
function mostrardesc(response){
	document.getElementById('descrip').innerHTML=response;
};

$.ajax({
		url: "php/consultadescripcion.php",
		type: "get", 				
		success: function (response){		
			console.log(response);
			mostrardesc(response);
						
		},	
		error: function(jqXHR, textStatus, errorThrown){
			console.log(textStatus, errorThrown);
		}
	});
	
	
