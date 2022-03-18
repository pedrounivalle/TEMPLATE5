function enviar() {
	// var v = $("#valor").val();
	var v = document.getElementById('valor').value;

	
	$.ajax({
		url: "php/consultadatos.php",
		type: "post", 
		data: {v},		
		success: function (response){		
			console.log(response);
			mostrar(response);
						
		},	
		error: function(jqXHR, textStatus, errorThrown){
			console.log(textStatus, errorThrown);
		}
	});

};


function mostrar(response){
	document.getElementById('nivel').innerHTML=response;
};

$.ajax({
		url: "php/consultadatos.php",
		type: "get", 				
		success: function (response){		
			console.log(response);
			mostrar(response);
						
		},	
		error: function(jqXHR, textStatus, errorThrown){
			console.log(textStatus, errorThrown);
		}
	});