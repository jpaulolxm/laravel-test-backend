<?php

namespace App\Models;

use Exception;

class TipoDePropriedadeEnum
{
  const CASA = 1;
  const APT  = 2;
  const SALA_COMERCIAL = 3;
  const OUTROS = 4;

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
      static::CASA           => ['id' => self::CASA, 'name' => 'Casa'],
      static::APT            => ['id' => self::APT, 'name' => 'Apartamento'],
      static::SALA_COMERCIAL => ['id' => self::SALA_COMERCIAL, 'name' => 'Sala Comercial'],
      static::OUTROS         => ['id' => self::OUTROS, 'name' => 'Outros'],
    ];
  }
}
