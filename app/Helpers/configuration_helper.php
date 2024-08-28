<?php

use App\Models\Configuration;

function configInfo()
{
    $config = new Configuration();
    if($data = $config->find(1)){
        return $data;
    }
    return [];
}

function hexToRgb($hex) {
    // Quitar el símbolo '#' si está presente
    $hex = ltrim($hex, '#');

    // Si el formato es abreviado (e.g., "fff"), expandirlo
    if (strlen($hex) === 3) {
        $hex = str_repeat(substr($hex, 0, 1), 2) . str_repeat(substr($hex, 1, 1), 2) . str_repeat(substr($hex, 2, 1), 2);
    }

    // Convertir hexadecimal a decimal
    $r = hexdec(substr($hex, 0, 2));
    $g = hexdec(substr($hex, 2, 2));
    $b = hexdec(substr($hex, 4, 2));

    return "$r, $g, $b";
}

function maxTruncate($string, $maxLength = 20, $append = '...') {
    // Verificar si la longitud de la cadena es mayor que el máximo permitido
    if (strlen($string) > $maxLength) {
        // Truncar la cadena al tamaño máximo menos la longitud del apéndice
        $truncatedString = substr($string, 0, $maxLength - strlen($append));
        
        // Buscar el último espacio en la cadena truncada
        $lastSpace = strrpos($truncatedString, ' ');
        
        // Si se encuentra un espacio, truncar la cadena hasta ese espacio para evitar cortar palabras
        if ($lastSpace !== false) {
            $truncatedString = substr($truncatedString, 0, $lastSpace);
        }
        
        // Agregar el apéndice (por defecto '...')
        return $truncatedString . $append;
    }
    
    // Si la cadena es más corta que el máximo, devolverla tal cual
    return $string;
}

function transformDate($date){

    $dateTime = new DateTime($date);

    // Formatear la fecha en el nuevo formato deseado
    return $dateTime->format('Y-m-d h:i A');
}

function generarCodigoRandom($longitud = 4) {
    $caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    $codigo = substr(str_shuffle($caracteres), 0, $longitud);
    return $codigo;
}

function convierte_fecha_mysql($data){
	$porciones = explode("-", $data);
			
	$porciones[2]=($porciones[2])?$porciones[2]:'00';
			
	if(strtoupper($porciones[1]) == 'JAN') $porciones[1]='01';
	if(strtoupper($porciones[1]) == 'FEB') $porciones[1]='02';
	if(strtoupper($porciones[1]) == 'MAR') $porciones[1]='03';
	if(strtoupper($porciones[1]) == 'APR') $porciones[1]='04';
	if(strtoupper($porciones[1]) == 'MAY') $porciones[1]='05';
	//if(strtoupper($porciones[1]) == 'may') $porciones[1]='05';
	if(strtoupper($porciones[1]) == 'JUN') $porciones[1]='06';
	if(strtoupper($porciones[1]) == 'JUL') $porciones[1]='07';
	if(strtoupper($porciones[1]) == 'AUG') $porciones[1]='08';
	if(strtoupper($porciones[1]) == 'SEP') $porciones[1]='09';
	if(strtoupper($porciones[1]) == 'OCT') $porciones[1]='10';
	if(strtoupper($porciones[1]) == 'NOV') $porciones[1]='11';
	if(strtoupper($porciones[1]) == 'DEC') $porciones[1]='12';
	
	$porciones[1]=($porciones[1])?$porciones[1]:'00';
	$porciones[0]=($porciones[0])?$porciones[0]:'00';
	$data= "20".$porciones[2] ."-".$porciones[1] ."-".$porciones[0]."";
	
	return $data;
}

function addLi($text, $search = '/<li>/', $textPre = '<li> <i class="bi bi-check2-circle"></i>'){
    $contenidoModificado = preg_replace($search, $textPre, $text);
    return $contenidoModificado;
}

function addLiNew($html) {
    $html = html_entity_decode($html);
    // Utiliza una expresión regular para capturar la etiqueta <i> y el contenido del <div>
    $pattern = '/<li>\s*<p>(<i(.*?)<\/i>)(.*?)<\/p>\s*<\/li>/s';
    
    // Reemplaza el patrón encontrado con la etiqueta <i> movida fuera del <div>
    $result = preg_replace_callback($pattern, function($matches) {
        $icon = $matches[1];
        $content = $matches[3];
        
        // Reordena las etiquetas para mover el <i> fuera del <p>
        return '<li>' . $icon . '<p>' . $content . '</p></li>';
    }, $html);
    
    return $result;
}

function indiPhone($text, $valid = true) {
    // Verifica si el texto contiene '+57'
    if (strpos($text, '+57') !== false) {
        return $text;
    } else {
        $text = "+57 {$text}";
        return $valid ? $text : str_replace(' ', '', $text);
    }
}