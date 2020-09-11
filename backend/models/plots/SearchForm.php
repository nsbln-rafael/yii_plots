<?php

declare(strict_types=1);

namespace backend\models\plots;

use common\validators\RegexpValidator;
use common\validators\TrimValidator;
use Yii;
use yii\base\Model;

/**
 * Форма поиска участков по кадастровым номерам.
 *
 * @author Насибуллин Рафаэль
 */
class SearchForm extends Model
{
	/** @var string Кадастровые номера */
	public $cadastral_numbers           = '';
	public const ATTR_CADASTRAL_NUMBERS = 'cadastral_numbers';

	/**
	 * {@inheritdoc}
	 *
	 * @author Насибуллин Рафаэль
	 */
	public function rules(): array
	{
		return [
			[static::ATTR_CADASTRAL_NUMBERS, TrimValidator::class],
			[static::ATTR_CADASTRAL_NUMBERS, RegexpValidator::class,
				RegexpValidator::ATTR_PATTERN => '/^((\d{2}:\d{2}:\d{6,7}:\d+,?\s?)+)$/u',
				RegexpValidator::ATTR_MESSAGE => 'Неправильный формат номера(ов). Пример: 01:02:0100014:6, 01:02:0100014:7',
			],
		];
	}

	/**
	 * {@inheritdoc}
	 *
	 * @author Насибуллин Рафаэль
	 */
	public function formName(): string
	{
		return '';
	}

	/**
	 * Поиск участков по кадастровым номерам.
	 *
	 * @return array
	 *
	 * @author Насибуллин Рафаэль
	 */
	public function search(): array
	{
		$plots = [];

		if ('' !== $this->cadastral_numbers) {
			$numbers = preg_split('/,\s?|\s+/u', $this->cadastral_numbers);
			$numbers = array_map('trim', $numbers);
			$numbers = array_unique($numbers);

			$plots = Yii::$app->ros_registry->search($numbers);
		}

		return $plots;
	}
}
