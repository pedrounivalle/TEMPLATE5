function download_table_as_csv(table_id, separator = ';') {
  // Select rows from table_id
  var rows = document.querySelectorAll('table#' + table_id + ' tr');
  // Construct csv
  var csv = [];
  for (var i = 0; i < rows.length; i++) {
      var row = [], cols = rows[i].querySelectorAll('td, th');
      for (var j = 0; j < cols.length; j++) {
          // Clean innertext to remove multiple spaces and jumpline (break csv)
          var data = cols[j].innerText.replace(/(\r\n|\n|\r)/gm, '').replace(/(\s\s)/gm, ' ')
          // Escape double-quote with double-double-quote (see https://stackoverflow.com/questions/17808511/properly-escape-a-double-quote-in-csv)
          data = data.replace(/"/g, '""');
          // Push escaped string
          row.push('"' + data + '"');
      }
      csv.push(row.join(separator));
  }
  var csv_string = csv.join('\n');
  // Download it
  var filename = 'export_' + table_id + '_' + new Date().toLocaleDateString() + '.csv';
  var link = document.createElement('a');
  link.style.display = 'none';
  link.setAttribute('target', '_blank');
  link.setAttribute('href', 'data:text/csv;charset=utf-8,%EF%BB%BF' + encodeURIComponent(csv_string));
  link.setAttribute('download', filename);
  document.body.appendChild(link);
  link.click();
  document.body.removeChild(link);
}; 

//funcion para activar/desactivar los checkbox
function activeCheck(){
  for (j = 0; j< 8; j++) {
    if ($("#table2 td").length==0) {  
      checks[j].disabled=true;
    }else{
      checks[j].disabled=false;
    };
  };
};

//funcion para esconder/mostrar columnas de la tabla
function offColumn(){
  for (j = 0; j< 8; j++) {
    column=columns[j];
    checkBox=checks[j];

    for (i = 0; i < column.length; i++) {
      if (checkBox.checked == true){
        column[i].style.display = "table-cell";
      }else{
        column[i].style.display = "none";
      }
    };    
  };
};

//funcion para limpiar la tabla
function cleanTable(){
  $('#table2 > tr > td').remove();
  activeCheck();
};

//funcion para enviar datos al php, recibir JSON y llenar tabla
function fillTable(){
  //Valores capturadas de los inputs
  var init = $("#initDate").val();
  var end = $("#endDate").val();
  //Estructura para el envio de datos
  var data= {
  init :init,
  end :end
  }; 
  //funcion para llenar la tabla con el JSON
  function append_json(data){
    if (data.length==0) {
      alert("No hay datos disponibles para las fechas seleccionadas");
    }else{
      var table = document.getElementById('table2');
      //por cada grupo de valores se crea una tr (table row)
      data.forEach(function(object){
      	var tr = document.createElement('tr');
        tr.innerHTML ='<td class="gid">' + object.gid + '</td>' +
                      '<td class="nombre">' + object.nombre + '</td>' +
                      '<td class="email">' + object.email + '</td>' +
                      '<td class="fecha">' + object.fecha + '</td>' +
                      '<td class="descripcion">' + object.descripcion + '</td>'+
					  '<td class="direccion">' + object.direccion + '</td>' +
                      '<td class="barrio">' + object.barrio + '</td>' +
                      '<td class="numerocomuna">' + object.numerocomuna + '</td>';
        //se organiza para que las filas se inserten inmediatamente bajo la cabecera y se limite a 50 filas
        if($("#table tr").length == 1){
          table.appendChild(tr);}
        else{
          table.insertBefore(tr,table.childNodes[2]);            
        }
      });
    };
  };

  //funcion para crear csv con datos ambientales
  


  //peticion post con ajax
  $.ajax({
    url: "./php/generateTable.php",
    type: "post",
    data: data, //dato a enviar
    success: function (response){
      //si es exitosa la peticion, recibir la respuesta como json y almacenarla en data
      const data = JSON.parse(response);
      //console.log(data);
      //llama funcion de llenado de tabla
      append_json(data); 

    },
    //mostrar errores en consola
    error: function(jqXHR, textStatus, errorThrown){
      console.log(textStatus, errorThrown);
    }

  });
  //ejecutar activeCheck 250ms después de finalizar fillTable
  setTimeout(activeCheck,1000);
};

//lista con listas de elementos de cada columna
columns = [
  document.getElementsByClassName("gid"),
  document.getElementsByClassName("nombre"),
  document.getElementsByClassName("email"),
  document.getElementsByClassName("fecha"),
  document.getElementsByClassName("descripcion")
];

//lista con checkbox
checks = document.getElementsByClassName("check");