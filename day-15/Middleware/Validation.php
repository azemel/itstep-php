<?php

namespace pd\middleware;

class Validation {

  public function invoke($context, $next) {
    
    // Валидация
    // Подключите свою реализацию из HW5 или добавьте пару ошибок вручную, 
    // чтобы посмотреть как они повлияют на поток
    $errors = []; //["title" => "Обязательно"];

    $context->errors = $errors;
    
    $response = $next($context);

    return $response;

  }

}