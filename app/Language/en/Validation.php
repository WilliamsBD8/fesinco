<?php

// override core en language system validation or define your own en language validation message
return [
  'required'           => 'El campo {field} es obligatorio.',
  'isset'              => 'El campo {field} debe contener un valor.',
  'valid_email'        => 'El campo {field} debe contener una dirección de correo electrónico válida.',
  'valid_emails'       => 'El campo {field} debe contener todas las direcciones de correo electrónico válidas.',
  'valid_url'          => 'El campo {field} debe contener una URL válida.',
  'valid_ip'           => 'El campo {field} debe contener una IP válida.',
  'min_length'         => 'El campo {field} debe tener al menos {param} caracteres.',
  'max_length'         => 'El campo {field} no puede exceder los {param} caracteres.',
  'exact_length'       => 'El campo {field} debe tener exactamente {param} caracteres.',
  'alpha'              => 'El campo {field} solo puede contener caracteres alfabéticos.',
  'alpha_numeric'      => 'El campo {field} solo puede contener caracteres alfanuméricos.',
  'alpha_numeric_spaces' => 'El campo {field} solo puede contener caracteres alfanuméricos y espacios.',
  'alpha_dash'         => 'El campo {field} solo puede contener caracteres alfanuméricos, guiones bajos y guiones.',
  'numeric'            => 'El campo {field} debe contener solo números.',
  'is_numeric'         => 'El campo {field} debe contener solo caracteres numéricos.',
  'integer'            => 'El campo {field} debe contener un número entero.',
  'regex_match'        => 'El campo {field} no está en el formato correcto.',
  'matches'            => 'El campo {field} no coincide con el campo {param}.',
  'differs'            => 'El campo {field} debe diferir del campo {param}.',
  'is_unique'          => 'El campo {field} debe contener un valor único.',
  'is_natural'         => 'El campo {field} debe contener solo números positivos.',
  'is_natural_no_zero' => 'El campo {field} debe contener un número mayor que cero.',
  'decimal'            => 'El campo {field} debe contener un número decimal.',
  'less_than'          => 'El campo {field} debe contener un número menor que {param}.',
  'less_than_equal_to' => 'El campo {field} debe contener un número menor o igual que {param}.',
  'greater_than'       => 'El campo {field} debe contener un número mayor que {param}.',
  'greater_than_equal_to' => 'El campo {field} debe contener un número mayor o igual que {param}.',
];
