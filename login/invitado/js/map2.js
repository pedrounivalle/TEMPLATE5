

//definicion mapa

	
var mymap = L.map('mapid').setView([ 3.4 , -76.51], 11);

//mapas base
var osm=new L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png',{ 
				attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'}),
				
	hibrido = new L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}',{
    maxZoom: 20,
    subdomains:['mt0','mt1','mt2','mt3']}),
	
	googlestreets = new L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',{
    maxZoom: 20,
    subdomains:['mt0','mt1','mt2','mt3']}),
	
	satelite = new L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}',{
    maxZoom: 20,
    subdomains:['mt0','mt1','mt2','mt3']}).addTo(mymap);

/* var raster = L.tileLayer.wms('http://3.83.125.29:8080/geoserver/pedro/wms', {
		layers: 'rasterpeñas:rasterpeñas',
		attribution: 'Este es mi mapa',
		format: 'image/png',
		transparent: true
	});
	var curvas = L.tileLayer.wms('http://3.83.125.29:8080/geoserver/pedro/wms', {
		layers: 'curvas:curvas84',
		attribution: 'Este es mi mapa',
		format: 'image/png',
		transparent: true
	}); */
	
	var inundacion = L.tileLayer.wms('http://34.203.234.250:8080/geoserver/finalSIG3/wms', {
		layers: 'finalSIG3:eventos3',
		attribution: 'Este es mi mapa',
		format: 'image/png',
		transparent: true
	});
	
	var barrios = L.tileLayer.wms('http://34.203.234.250:8080/geoserver/finalSIG3/wms?service=WMS&version=1.1.0&request=GetMap&layers=finalSIG3%3Abarrios&bbox=-76.5922622680664%2C3.280346393585205%2C-76.45315551757812%2C3.507817268371582&width=469&height=768&srs=EPSG%3A4326&styles=&format=application/openlayers', {
		layers: 'finalSIG3:barrios',
		attribution: 'Este es mi mapa',
		format: 'image/png',
		transparent: true
	});
	
	var comunas = L.tileLayer.wms('http://34.203.234.250:8080/geoserver/finalSIG3/wms', {
		layers: 'finalSIG3:comunas',
		attribution: 'Este es mi mapa',
		format: 'image/png',
		transparent: true
	});
	
	var comunas_idesc = L.tileLayer.wms('http://ws-idesc.cali.gov.co:8081/geoserver/wms?service=WMS&version=1.1.0&', {
		layers: 'idesc:mc_comunas',
		attribution: 'Creditos de la capa',
		format: 'image/png',
		transparent: true
	});
	var barrios_idesc = L.tileLayer.wms('http://ws-idesc.cali.gov.co:8081/geoserver/wms?service=WMS&version=1.1.0&', {
		layers: 'idesc:mc_barrios',
		attribution: 'Creditos de la capa',
		format: 'image/png',
		transparent: true
	});
		
		
//shape de parcela

//mymap.addLayer(inundacion)
var myIcon2 = L.icon({
  iconUrl: 'images/pin.png',
  iconSize: [30, 30],
  iconAnchor: [7.5, 7.5],
  // popupAnchor: [0, -28]
});


var positivos = L.geoJSON(null, {
	pointToLayer: function (feature, latlng) {
            return L.marker(latlng, {icon: myIcon2});
    },onEachFeature: function (feature, layer) {
		layer.bindPopup('<table border> <TR><TH>nombre</TH><td>'+feature.properties.nombre+'</td></tr><TR><TH>fecha</TH><td>'+feature.properties.fecha+'</td></tr><TR><TH>descripcion</TH><td>'+feature.properties.descripcion+'</td></tr><TR><TH>direccion</TH><td>'+feature.properties.direccion+'</td></tr><TR><TH>barrio</TH><td>'+feature.properties.barrio+'</td></tr><TR><TH>comuna</TH><td>'+feature.properties.numerocomuna+'</td></tr>');
	}});	
										



$.ajax({  
  url: "php/positivos.php",
  type: "get",          
  dataType: 'json',
  contentType: "application/json; charset=utf-8",
  success: function (data){ 
    positivos.addData(data);         
  }
});
//-----------------------------------------------------------


	var baseMaps = {
  	"hibrido": hibrido,
	"google Street": googlestreets,
	"satelite": satelite,
	"Osm": osm

};

var overlayMaps = {
	"barios":barrios_idesc,
	"comunas":comunas_idesc
};	
	
//Add layer control
L.control.layers(baseMaps, overlayMaps).addTo(mymap);
	
