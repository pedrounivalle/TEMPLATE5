var time = [];
var data_ta = [];
var data_ts = [];
var data_tbh = [];
var data_hs = [];
var data_ra = [];
var data_pr = [];
var data_vv = [];
var data_pp30 = [];
var data_pp60 = [];
var data_pp90 = [];

//label  
const labels = time;


//grafica  

const dataH = {
  labels: labels,
  datasets: [{
    label: 'cantidad de huecos',
    backgroundColor: 'rgb(133, 193, 233)',
    borderColor: 'rgb(133, 193, 233)',
    pointBackgroundColor: 'rgb(133, 193, 233)',
    data: data_hs,
  }]
};
const configH = {
  type: 'bar',
  data: dataH,
  options: {
    maintainAspectRatio: false,
    plugins: {
      title: {
        display: true,
        text: 'huecos por comuna'
      }
    },
    scales: {
      x: {
        display: true,
        title: {
          display: true,
          text: 'N° de comuna'
        }     
      }
    }
  }
};

var hChart = new Chart(
  document.getElementById('hChart'),
  configH
);


var i='blabla';

//funcion enviar datos a php, recibir JSON y llenar listas con datos para graficas(simulando llegada de datos)
function simulaDatos(){
  //peticion post con ajax
  $.ajax({
    url: "./php/graphic.php",
    type: "post",
    data: {i},
    async: false,    
    success: function (response){
      //si es exitosa la peticion, recibir la respuesta como json y almacenarla en data
      const data = JSON.parse(response);
      // console.log(data);
      data.forEach(function(object){      
        time.push(object.numerocomuna);
        
        data_hs.push(parseFloat(object.count));
             
      });        
    },
    //mostrar errores en consola
    error: function(jqXHR, textStatus, errorThrown){
      console.log(textStatus, errorThrown);
    }
  }); 

 

  hChart.data.labels=time;
  hChart.data.datasets[0].data=data_hs;


       
  hChart.update();      
 


   time=[];
       
  data_hs=[];
  
  
	
};

simulaDatos();
//correr la funcion cada x ms (para simular llegada de datos)
setInterval(simulaDatos,5000); 