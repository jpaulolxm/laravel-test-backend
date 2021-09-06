<?php

namespace App\Models;

use Exception;

class StatusRelatorioEnum
{
  const PROCESSANDO   = 1;
  const CONCLUIDO     = 2;
  const ERROR         = 3;

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
      static::PROCESSANDO   => ['id' => self::PROCESSANDO, 'name' => 'Processando'],
      static::CONCLUIDO     => ['id' => self::CONCLUIDO,   'name' => 'Concluido'],
      static::ERROR         => ['id' => self::ERROR,       'name' => 'Erro'],
    ];
  }
}
