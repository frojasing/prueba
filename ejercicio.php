<?php
//Obtiene datos de api
$data = json_decode( file_get_contents("https://farmanet.minsal.cl/maps/index.php/ws/getLocalesRegion?id_region=7"), true);

$validaok =0;
isset($_GET['farmacia']);
isset($_GET['comuna']);

//Recorre array
for ($i=0; $i<count($data); $i++){	
  //Busca en array según criterio
	if ($data[$i]["local_nombre"] == $_GET['farmacia'] and $data[$i]["comuna_nombre"] ==$_GET['comuna']) {
    	$validaok = $validaok +1;
  	 //carga en nuevo array datos encontrados
    	$array []= array("local_nombre"=> $data[$i]["local_nombre"],
        	"local_direccion"=> $data[$i]["local_direccion"],
        	"local_telefono"=> $data[$i]["local_telefono"],
        	"local_lat"=> $data[$i]["local_lat"],
        	"local_lng"=> $data[$i]["local_lng"]);   	 
    	}   	 
	}
  //entrega información encontrada
	if ($validaok > 0) {
    	echo json_encode($array);
	}
  //Indica que no encontró registros
	else{
    	//echo "sin datos";
    	echo json_encode(array(
        	'estado' => '400', // success or not?
        	'mensaje' => 'No se encontraron farmacias con el criterio de busqueda'
    	));   	 
	}    
?>
