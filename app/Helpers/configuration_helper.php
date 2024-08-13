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