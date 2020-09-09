<?php

declare(strict_types=1);

/**
 * @inheritdoc
 *
 * @author Насибуллин Рафаэль
 */
class StringValidator extends \yii\validators\StringValidator
{
	const ATTR_MIN            = 'min';
	const ATTR_MAX            = 'max';
	const ATTR_NUMBER_PATTERN = 'length';
}