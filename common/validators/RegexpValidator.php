<?php

declare(strict_types=1);

namespace common\validators;

/**
 * @inheritdoc
 *
 * @author Насибуллин Рафаэль
 */
class RegexpValidator extends \yii\validators\RegularExpressionValidator
{
	public const ATTR_PATTERN = 'pattern';
	public const ATTR_MESSAGE = 'message';
}
