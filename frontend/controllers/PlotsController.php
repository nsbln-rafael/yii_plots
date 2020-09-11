<?php

declare(strict_types=1);

namespace frontend\controllers;

use frontend\models\plots\SearchForm;
use Yii;
use yii\web\Controller;

/**
 * Контроллер для работы с данными участков.
 *
 * @author Насибуллин Рафаэль
 */
class PlotsController extends Controller
{
	public const ACTION_PLOTS = 'search';

	/**
	 * Экшн поиска участков по кадастровым номерам.
	 *
	 * @return string
	 *
	 * @author Насибуллин Рафаэль
	*/
	public function actionSearch(): string
	{
		$model  = new SearchForm();
		$result = $model->search(Yii::$app->request->queryParams);

		return $this->render('search', [
			'model'  => $model,
			'result' => $result,
		]);
	}
}
