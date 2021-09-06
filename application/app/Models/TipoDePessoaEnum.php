<?php

namespace App\Models;

use Exception;

class TipoDePessoaEnum
{
  const FISICA    = 1;
  const JURIDICA  = 2;

  /**
   * @throws Exception
   */
  public static function getName($key): string
  {
    try {

      return static::map()[$key]['name'];

    } catch (Exception $e) {

      throw new Exception("Indice não localizado: $key in " . $e->getMessage());
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
      static::FISICA   => ['id' => self::FISICA,   'name' => 'Pessoa Física'],
      static::JURIDICA => ['id' => self::JURIDICA, 'name' => 'Pessoa Jurídica'],
    ];
  }
}
