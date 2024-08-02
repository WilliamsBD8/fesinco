<?
require '../include.php'; 


//1. buscamos los archivos que no esten cargados
//2. abrimos el primer archivo
//3. recorremos registros por registro y lo insertmos
//4. abrimos el segundo archivo
//5. recorremos registros por registro y lo insertmos
//6. cambiamos estado de bd a cargado

function convierte_fecha_mysql($data){
	$porciones = explode("-", $data);
			
	$porciones[2]=($porciones[2])?$porciones[2]:'00';
			
	if($porciones[1]=='Jan') $porciones[1]='01';
	if($porciones[1]=='Feb') $porciones[1]='02';
	if($porciones[1]=='Mar') $porciones[1]='03';
	if($porciones[1]=='Apr') $porciones[1]='04';
	if($porciones[1]=='May') $porciones[1]='05';
	if($porciones[1]=='Jun') $porciones[1]='06';
	if($porciones[1]=='Jul') $porciones[1]='07';
	if($porciones[1]=='Aug') $porciones[1]='08';
	if($porciones[1]=='Sep') $porciones[1]='09';
	if($porciones[1]=='Oct') $porciones[1]='10';
	if($porciones[1]=='Nov' || $porciones[1]=='nov') $porciones[1]='11';
	if($porciones[1]=='Dec') $porciones[1]='12';
	
	$porciones[1]=($porciones[1])?$porciones[1]:'00';
	$porciones[0]=($porciones[0])?$porciones[0]:'00';
	$data= "20".$porciones[2] ."-".$porciones[1] ."-".$porciones[0]."";
	
	return $data;
}

echo '<br><h1>Proceso para cargue de archivos para extractos de FESINCO</h1>';
$text = "SELECT * FROM extractos WHERE estado='PARA CARGAR' ";
$rowExtractos = mysql_query($text);
while ($objExtracto = mysql_fetch_object($rowExtractos)) {
	
	echo '<h2>1. Se inicia cargue de archivos de aportes</h2>';
	
	//$file_aportes = _RUTA_EXTRACTOS.$objExtracto->archivo_aportes;
	//$file_cartera = _RUTA_EXTRACTOS.$objExtracto->archivo_cartera;
	$file_aportes = 'http://www.fesinco.co/cms/assets/uploads/extracto/'.$objExtracto->archivo_aportes;
	$file_cartera = 'http://www.fesinco.co/cms/assets/uploads/extracto/'.$objExtracto->archivo_cartera;
	//***archivos de ahorro****///
	$handle = fopen($file_aportes, "r");
	if( $handle ) {
		$aux_cont=0;
		while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
			if($aux_cont<>0){
			//formateo de fecha
			$data[2]=convierte_fecha_mysql($data[2]);
						
			$import = "INSERT INTO extracto_aportes_ahorro 			(numero, cedula, fecha, salahoper, 
																	salresesp, salahovol, salahopro, salaportes, 
																	ctaahorro, ctaaportes, ctareserva, total,
																	cartera, nivelendeu, salario, fecha_cargue,
																	estado) 
																	VALUES 
																	('$data[0]', '$data[1]', '$data[2]', '$data[3]',
																	'$data[4]', '$data[5]', '$data[6]', '$data[7]',
																	'$data[8]', '$data[9]', '$data[10]', '$data[11]',
																	'$data[12]', '$data[13]', '$data[14]', NOW(),
																	'ACTIVO')";
			mysql_query($import) or die(mysql_error().' --> '.$import);
			}
			$aux_cont++;
		}	
		$aux_cont--;//sincroniza el contador
		echo '<h2>2. Se crearon '.$aux_cont.' registros de aportes exitosamente</h2>';
		fclose($handle);
	}
	//***archivos de cartera****///
	echo '<h2>3. Se inicia cargue de archivos de cartera</h2>';
	
	$handle = fopen($file_cartera, "r");
	if( $handle ) {
		$aux_cont=0;
		while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
			if($aux_cont<>0){
			
				$data[2]=convierte_fecha_mysql($data[2]);
				$data[3]=convierte_fecha_mysql($data[3]);
				$data[4]=convierte_fecha_mysql($data[4]);
				
				$import = "INSERT INTO extracto_cartera (registro, cedula, feccorte, fecsolici, 
																	fecfinal, numero, codigo, tasanual, 
																	tasmes, valor, ctapact, ctapend,
																	valcta, saldo, fecha_cargue,estado) 
																	VALUES 
																	('$data[0]', '$data[1]', '$data[2]', '$data[3]',
																	'$data[4]', '$data[5]', '$data[6]', '$data[7]',
																	'$data[8]', '$data[9]', '$data[10]', '$data[11]',
																	'$data[12]', '$data[13]', NOW(),'ACTIVO')";
				mysql_query($import) or die(mysql_error().' --> '.$import);
			}
			$aux_cont++;
		}	
		$aux_cont--;//sincroniza el contador
		echo '<h2>4. Se crearon '.$aux_cont.' registros de cartera exitosamente</h2>';
		fclose($handle);
	}
	
				$update  = "UPDATE extractos set estado='CARGADO'
									WHERE id_cargue=".$objExtracto->id_cargue;
				mysql_query($update) or die(mysql_error().' --> '.$update);
				
				
}


echo '<h2>Fin del proceso de cargue</h2>
	<br><br><a href="" onclick="window.close();">cerrar ventana</a>';
?>