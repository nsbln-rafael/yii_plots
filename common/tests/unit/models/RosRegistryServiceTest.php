<?php

declare(strict_types=1);

namespace common\tests\unit\models;

use Codeception\Test\Unit;
use common\fixtures\PlotFixture;
use common\models\Plot;
use Yii;

/**
 * Тесты компонета, работающего с РосРеестром.
 *
 * @author Насибуллин Рафаэль
 */
class RosRegistryServiceTest extends Unit
{
	/** @var \common\tests\UnitTester Тестировщик */
	protected $tester;


	/**
	 * Фикстуры
	 *
	 * @return array
	 */
	public function _fixtures(): array
	{
		return [
			'plot' => [
			'class' => PlotFixture::className(),
			'dataFile' => codecept_data_dir() . 'plot.php',
			]
		];
	}

	/**
	 * Не получаем участки, если не указываем кадастровые номера.
	 */
	public function testNoPlotsWithoutNumber()
	{
		$service = Yii::$app->ros_registry;
		$plots = $service->search([]);

		expect('Массив участков должен быть пустым', $plots)->count(0);
	}

	/**
	 * Получаем 2 участка, если указываем 2 кадастровых номера.
	 */
	public function testFoundTwoPlotsByTwoNumbers()
	{
		$service = Yii::$app->ros_registry;
		$plots = $service->search([
			'69:27:0000022:1301',
			'69:27:0000022:1302',
		]);

		expect('Массив участков должен быть пустым', $plots)->count(2);
	}

	/**
	 * Добавляем в бд новый участок, который ранее не был сохранен.
	 */
	public function testSaveNewPlot()
	{
		$number  = '69:27:0000022:1306';
		$plotOld = Plot::findOne([Plot::ATTR_CADASTRAL_NUMBER => $number]);

		Yii::$app->ros_registry->search([$number]);

		$plotNew = Plot::findOne([Plot::ATTR_CADASTRAL_NUMBER => $number]);

		expect('Поиск участка в бд не даст результатов', $plotOld)->null();
		expect('Новый участок не является пустым',       $plotNew)->isInstanceOf(Plot::class);
	}
}
