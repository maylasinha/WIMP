<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class PetSize extends Enum
{
  const Small = 0;
  const Medium = 1;
  const Big = 2;

  public static function getDescription($value): string
	{
		switch ($value) {
			case self::Small:
				return 'Pequeno';
			break;

			case self::Medium:
				return 'Médio';
			break;

			case self::Big:
				return 'Grande';
			break;

			default:
				return parent::getDescription($value);
		}
	}
}