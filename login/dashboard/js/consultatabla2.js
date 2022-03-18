function consultar2(){
  //Valores de las componentes
  var tbusqueda2 = $("#tipodebusqueda2").val();
  var ref2 = $("#refer2").val();
  //Estructura para el envio de datos
  var datos2= {
  tipo :tbusqueda2,
  cons :ref2
  };
  
		function enableButton2() {
            document.getElementById("button2").disabled = false;
        };

  //Ajax
  $.ajax({
   url: "php/consultatabla.php",
   type: "post",
   data: datos2,
   dataType: "json",
   success: function (response) {
      
        
	  for(var key in response){
								
					var tr_str = "<tr>" +
					"<td aling='center'>" + response[key].gid +"</td>"+
					"<td aling='center'>" + response[key].nombre +"</td>"+
					"<td aling='center'>" + response[key].email +"</td>"+ 
					"<td aling='center'>" + response[key].fecha +"</td>"+
					"<td aling='center'>" + response[key].descripcion +"</td>"+
					"</tr>";
				
				$("#Table").append(tr_str);
				
					
				}
				
	    
	 
   },
   error: function(jqXHR, textStatus, errorThrown) {
      console.log(textStatus, errorThrown);
   }
 });
 
  
}
