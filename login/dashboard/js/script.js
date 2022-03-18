function consultar(){
  //Valores de las componentes
  var tbusqueda = $("#tipodebusqueda").val();
  var ref = $("#refer").val();
  //Estructura para el envio de datos
  var datos2= {
  tipo :tbusqueda,
  cons :ref
  };
  
	

  //Ajax
  $.ajax({
   url: "php/agregarconsulta.php",
   type: "post",
   data: datos2,
   dataType: "json",
   success: function (response) {
      
        
	  for(var key in response){
								
					var tr_str = "<tr>" +
					"<td aling='center'>" + response[key].gid +"</td>"+
					"<td aling='center'>" + response[key].fecha +"</td>"+
					"<td aling='center'>" + response[key].hora +"</td>"+ 
					"<td aling='center'>" + response[key].direccion +"</td>"+
					"<td aling='center'>" + response[key].bus +"</td>"+
					"<td aling='center'>" + response[key].ruta +"</td>"+
					"<td aling='center'>" + response[key].tipo +"</td>"+
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
