<?php

declare(strict_types=1);

/**
 * @inheritdoc
 *
 * @author Насибуллин Рафаэль
 */
class NumberValidator extends \yii\validators\NumberValidator
{
	const ATTR_MIN            = 'min';
	const ATTR_MAX            = 'max';
	const ATTR_NUMBER_PATTERN = 'numberPattern';
	const ATTR_MESSAGE        = 'message';
}