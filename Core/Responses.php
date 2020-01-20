<?php

namespace Core;

class Responses
{

  public function json(array $arr)
  {
    header('Content-Type', 'application/json');
    echo json_encode($arr, JSON_PRETTY_PRINT);
  }

}
