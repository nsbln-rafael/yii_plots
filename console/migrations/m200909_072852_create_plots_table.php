<?php

declare(strict_types=1);

use yii\db\Migration;

/**
 * Создание таблицы 'участки'.
 *
 * @author Насибуллин Рафаэль
 */
class m200909_072852_create_plots_table extends Migration
{
	private const TABLE_NAME = 'plots';
	/**
	 * {@inheritdoc}
	 *
	 * @author Насибуллин Рафаэль
	 */
	public function safeUp(): void
	{
		$this->createTable(static::TABLE_NAME, [
			'id'               => $this->primaryKey(),
			'cadastral_number' => $this->string()->notNull(),
			'address'          => $this->string()->notNull(),
			'price'            => $this->decimal(14, 4)->notNull(),
			'area'             => $this->decimal(14, 4)->notNull(),
		]);

		$this->addCommentOnTable(static::TABLE_NAME, 'Справочник участков');
		$this->addCommentOnColumn(static::TABLE_NAME, 'cadastral_number', 'Кадастровый номер');
		$this->addCommentOnColumn(static::TABLE_NAME, 'address', 'Адрес');
		$this->addCommentOnColumn(static::TABLE_NAME, 'price', 'Цена');
		$this->addCommentOnColumn(static::TABLE_NAME, 'area', 'Площадь');
	}

	/**
	 * {@inheritdoc}
	 */
	public function safeDown(): void
	{
		$this->dropTable(static::TABLE_NAME);
	}
}
