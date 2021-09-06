<?php

namespace App\Models;

use Exception;

class StatusPropriedadeEnum
{
  const NAO_CONTRADO  = 1;
  const CONTRATADO    = 2;

  /**
   * @throws Exception
   */
  public static function getName($key): string
  {
    try {

      return static::map()[$key]['name'];

    } catch (Exception $e) {

      throw new Exception("Indíce não localizado: $key in " . $e->getMessage());
    }
  }

  /**
   * Retrieve a map of enum keys and values.
   *
   * @return array
   */
  public static function map(): array
  {
    return [
      static::NAO_CONTRADO => ['id' => self::NAO_CONTRADO,  'name' => 'Não Contratado'],
      static::CONTRATADO   => ['id' => self::CONTRATADO,    'name' => 'Contratado'],

    ];
  }
}
