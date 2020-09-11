<?php

declare(strict_types=1);

namespace common\models;

use common\validators\NumberValidator;
use common\validators\StringValidator;
use yii\db\ActiveRecord;
use yii\validators\RequiredValidator;

/**
 * Модель для таблицы 'участки'.
 *
 * @property int    $id               Идентификатор
 * @property string $cadastral_number Кадастровый номер
 * @property string $cadastral_id     Отформатированный кадастровый номер
 * @property string $address          Адрес
 * @property float  $price            Цена
 * @property float  $area             Площадь
 *
 * @author Насибуллин Рафаэль
 */
class Plot extends ActiveRecord
{
	public const ATTR_ID               = 'id';
	public const ATTR_CADASTRAL_NUMBER = 'cadastral_number';
	public const ATTR_CADASTRAL_ID     = 'cadastral_id';
	public const ATTR_ADDRESS          = 'address';
	public const ATTR_PRICE            = 'price';
	public const ATTR_AREA             = 'area';

	/**
	 * {@inheritdoc}
	 *
	 * @author Насибуллин Рафаэль
	 */
	public static function tableName(): string
	{
		return 'plots';
	}

	/**
	 * {@inheritdoc}
	 *
	 * @author Насибуллин Рафаэль
	 */
	public function fields(): array
	{
		return [
			static::ATTR_CADASTRAL_NUMBER,
			static::ATTR_ADDRESS,
			static::ATTR_AREA,
			static::ATTR_PRICE,
		];
	}

	/**
	 * {@inheritdoc}
	 *
	 * @author Насибуллин Рафаэль
	 */
	public function rules(): array
	{
		return [
			[static::ATTR_CADASTRAL_NUMBER, RequiredValidator::class],
			[static::ATTR_CADASTRAL_NUMBER, StringValidator::class, StringValidator::ATTR_MAX => 255],
			[static::ATTR_CADASTRAL_ID,     RequiredValidator::class],
			[static::ATTR_CADASTRAL_ID,     StringValidator::class, StringValidator::ATTR_MAX => 255],
			[static::ATTR_ADDRESS,          RequiredValidator::class],
			[static::ATTR_ADDRESS,          StringValidator::class, StringValidator::ATTR_MAX => 255],
			[static::ATTR_PRICE,            RequiredValidator::class],
			[static::ATTR_PRICE,            NumberValidator::class],
			[static::ATTR_AREA,             RequiredValidator::class],
			[static::ATTR_AREA,             NumberValidator::class],
		];
	}

	/**
	 * {@inheritdoc}
	 *
	 * @author Насибуллин Рафаэль
	 */
	public function attributeLabels(): array
	{
		return [
			static::ATTR_ID               => 'ID',
			static::ATTR_CADASTRAL_NUMBER => 'Кадастровый номер',
			static::ATTR_ADDRESS          => 'Адрес',
			static::ATTR_PRICE            => 'Цена',
			static::ATTR_AREA             => 'Площадь',
		];
	}
}
