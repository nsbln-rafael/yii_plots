<?php

declare(strict_types=1);

namespace console\models\plots;

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
	public $cadastral_numbers;
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
				RegexpValidator::ATTR_MESSAGE => 'Неправильный формат номера(ов). Пример: 01:02:0100014:6, 01:02:0100014:7' . PHP_EOL,
			],
		];
	}


	/**
	 * Поиск участков по кадастровым номерам.
	 *
	 * @param string $numbers Кадастровые номера
	 *
	 * @return array
	 *
	 * @author Насибуллин Рафаэль
	 */
	public function search(string $numbers): array
	{
		$plots = [];

		$this->setAttributes([static::ATTR_CADASTRAL_NUMBERS => $numbers]);

		if (false === $this->validate()) {
			echo $this->getErrors(static::ATTR_CADASTRAL_NUMBERS)[0];

			return $plots;
		}

		if (strlen($this->cadastral_numbers) > 0) {
			$numbers = preg_split('/,\s?|\s+/u', $this->cadastral_numbers);
			$numbers = array_map('trim', $numbers);
			$numbers = array_unique($numbers);

			$plots = Yii::$app->ros_registry->search($numbers);
		}

		return $plots;
	}
}
