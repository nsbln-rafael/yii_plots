<?php

declare(strict_types=1);

namespace common\validators;

/**
 * @inheritdoc
 *
 * @author Насибуллин Рафаэль
 */
class StringValidator extends \yii\validators\StringValidator
{
	public const ATTR_MIN            = 'min';
	public const ATTR_MAX            = 'max';
	public const ATTR_NUMBER_PATTERN = 'length';
}
