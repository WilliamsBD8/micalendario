<?php

function generateCaptcha(){
  $session = session();
  $operations = ['mas', 'menos'];
  $number_a = (int) rand(1, 10);
  $number_b = (int) rand(1, 10);

  // Asegurarse de que number_a sea mayor que number_b
  if ($number_a < $number_b) {
      $temp = $number_a;
      $number_a = $number_b;
      $number_b = $temp;
  }

  $session->set('captcha', (object)[
      'number_a'  => $number_a,
      'number_b'  => $number_b,
      'operacion' => $operations[array_rand($operations)]
  ]);
}

function ValidateReCaptcha($captcha){
  $number_a   = session('captcha')->number_a;
  $number_b   = session('captcha')->number_b;
  $operacion  = session('captcha')->operacion;
  $resultado = 0;
  switch ($operacion) {
    case 'mas':
      $resultado = $number_a + $number_b;
      break;
    case 'menos':
      $resultado = $number_a - $number_b;
      break;
    
    default:
      $resultado = $number_a * $number_b;
      break;
  }
  if($resultado == $captcha)
    return true;
  else return false;
}