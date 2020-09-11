<?php

declare(strict_types=1);

namespace common\validators;

/**
 * @inheritdoc
 *
 * @author Насибуллин Рафаэль
 */
class TrimValidator extends \yii\validators\FilterValidator
{
	/** @var string Фукнция trim для фильтра */
	public $filter = 'trim';
}
