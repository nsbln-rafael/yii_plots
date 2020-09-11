<?php

declare(strict_types=1);

namespace frontend\models\plots;

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
	public const ATTR_ID               = 'id';
	public const ATTR_CADASTRAL_NUMBER = 'cadastral_number';
	public const ATTR_PRICE            = 'price';
	public const ATTR_ADDRESS          = 'address';
	public const ATTR_AREA             = 'area';

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
				RegexpValidator::ATTR_MESSAGE => 'Неправильный формат номер(ов). Пример: 01:02:0100014:6, 01:02:0100014:7',
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
	 * {@inheritdoc}
	 *
	 * @author Насибуллин Рафаэль
	 */
	public function attributeLabels(): array
	{
		return [
			static::ATTR_ID                => 'ID',
			static::ATTR_CADASTRAL_NUMBER  => 'Кадастровый номер',
			static::ATTR_CADASTRAL_NUMBERS => 'Кадастровые номера',
			static::ATTR_ADDRESS           => 'Адрес',
			static::ATTR_PRICE             => 'Цена',
			static::ATTR_AREA              => 'Площадь',
		];
	}

	/**
	 * Поиск участков по кадастровым номерам.
	 *
	 * @param array $params Параметры запроса
	 *
	 * @return array
	 *
	 * @author Насибуллин Рафаэль
	 */
	public function search(array $params): array
	{
		$plots = [];

		$this->load($params);

		if (false === $this->validate()) {
			return $plots;
		}

		if (true === isset($params[static::ATTR_CADASTRAL_NUMBERS])) {
			$numbers = preg_split('/,\s?|\s+/u', $params[static::ATTR_CADASTRAL_NUMBERS]);
			$numbers = array_map('trim', $numbers);
			$numbers = array_unique($numbers);

			$plots = Yii::$app->ros_registry->search($numbers);
		}

		return $plots;
	}
}
