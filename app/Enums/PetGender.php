<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class PetGender extends Enum
{
  const Male = 0;
  const Female = 1;

  public static function getDescription($value): string
	{
		switch ($value) {
			case self::Male:
				return 'Macho';
			break;

			case self::Female:
				return 'Feminino';
			break;

			default:
				return parent::getDescription($value);
		}
	}
}