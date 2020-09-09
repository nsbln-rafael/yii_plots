<?php

declare(strict_types=1);

namespace app\models;

use NumberValidator;
use StringValidator;
use Yii;
use yii\db\ActiveRecord;
use yii\validators\RequiredValidator;

/**
 * Модель для таблицы 'участки'.
 *
 * @property int    $id               Идентификатор
 * @property string $cadastral_number Кадастровый номер
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
	public function rules(): array
	{
		return [
			[static::ATTR_CADASTRAL_NUMBER, RequiredValidator::class],
			[static::ATTR_CADASTRAL_NUMBER, StringValidator::class, StringValidator::ATTR_MAX => 255],
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
			static::ATTR_ID               => Yii::t('common', 'ID'),
			static::ATTR_CADASTRAL_NUMBER => Yii::t('common', 'Кадастровый номер'),
			static::ATTR_ADDRESS          => Yii::t('common', 'Адрес'),
			static::ATTR_PRICE            => Yii::t('common', 'Цена'),
			static::ATTR_AREA             => Yii::t('common', 'Площадь'),
		];
	}
}
