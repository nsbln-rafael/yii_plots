<?php

declare(strict_types=1);

namespace common\validators;

/**
 * @inheritdoc
 *
 * @author Насибуллин Рафаэль
 */
class NumberValidator extends \yii\validators\NumberValidator
{
	public const ATTR_MIN            = 'min';
	public const ATTR_MAX            = 'max';
	public const ATTR_NUMBER_PATTERN = 'numberPattern';
	public const ATTR_MESSAGE        = 'message';
}
