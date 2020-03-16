<?php

  // function validateLength($value, $length) {
  //   $value = strval($value);
  //   if (mb_strlen($value) < $length) {
  //     return "Invalid length";
  //   } 
  // }


  // function validate($form, $validation) {
  //   $errors = [];
  //   $clean = [];

  //   foreach($form as $key => $value) {
  //     [$clean[$key], $error] = call_user_func($validation[$key], $value); 
  //     if ($error !== false) {
  //       $errors[$key] = $error;
  //     } 
  //   }

  //   return [$clean, $errors];
  // }



  // $validation = [
  //   "title" => function($value) {
  //     $clean = trim($value);
  //     $clean = removeDoubleSpaces($clean);

  //     $error =
  //          validateEmpty($clean)
  //       ?? validateMinLength($clean, 3);

  //     return [$clean, $error];
  //   },
  // ];


