function consultar3(){
	 //Valores de las componentes

  var ref = $("#refer").val();
  //Estructura para el envio de datos
 
  
  var positivos = L.geoJSON(null, {
	onEachFeature: function (feature, layer) {
		layer.bindPopup('<table border> <TR><TH>nombre</TH><td>'+feature.properties.nombre+'</td></tr><TR><TH>fecha</TH><td>'+feature.properties.fecha+'</td></tr><TR><TH>descripcion</TH><td>'+feature.properties.descripcion+'</td></tr><TR><TH>email</TH><td>'+feature.properties.email+'</td></tr>');
	}}).addTo(mymap);	
										



$.ajax({  
  url: "php/comuna.php",
  type: "post", 
  data: {ref},  
  /* dataType: 'json', */
 /*  contentType: "application/json; charset=utf-8", */
  success: function (data){ 
    positivos.addData(JSON.parse(data));         
  }
});
 
  
}
