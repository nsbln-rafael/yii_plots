<?php

declare(strict_types=1);

namespace console\controllers;

use console\models\plots\SearchForm;
use yii\console\Controller;
use yii\console\widgets\Table;

/**
 * Контроллер для работы с данными участков.
 *
 * @author Насибуллин Рафаэль
 */
class PlotsController extends Controller
{
	/**
	 * Экшн поиска участков по кадастровым номерам.
	 *
	 * @param string $numbers Кадастровые номера
	 *
	 * @return void
	 *
	 * @author Насибуллин Рафаэль
	 */
	public function actionSearch(string $numbers): void
	{
		$model  = new SearchForm();
		$result = $model->search($numbers);
		$rows   = [];

		foreach ($result as $plot) {
			array_push($rows, [
				$plot->id,
				$plot->address,
				$plot->cadastral_number,
				$plot->area,
				$plot->price,
			]);
		}

		if (count($rows) > 0) {
			$table = new Table();
			$table->setHeaders(['ID', 'Address', 'Cadastral number', 'Area', 'Price']);
			$table->setRows($rows);

			echo $table->run();
		}
	}
}
