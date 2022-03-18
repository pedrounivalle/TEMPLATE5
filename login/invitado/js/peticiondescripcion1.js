
function mostrar10(response){
	document.getElementById('descrip2').innerHTML=response;
};

$.ajax({
		url: "php/consultadescripcion1.php",
		type: "get", 				
		success: function (response){		
			console.log(response);
			mostrar10(response);
						
		},	
		error: function(jqXHR, textStatus, errorThrown){
			console.log(textStatus, errorThrown);
		}
	});
	
	