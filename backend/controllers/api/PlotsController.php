<?php

declare(strict_types=1);

namespace backend\controllers\api;

use backend\models\plots\SearchForm;
use common\models\Plot;
use Yii;
use yii\rest\Controller;
use yii\web\Response;

/**
 * Контроллер для работы с данными участков.
 *
 * @author Насибуллин Рафаэль
 */
class PlotsController extends Controller
{
	/** @var Plot  */
	public $modelClass = 'common\models\Plot';

	/** @var array Используемый сериалайзер */
	public $serializer = [
		'class' => 'yii\rest\Serializer',
		'collectionEnvelope' => 'items',
	];

	/**
	 * Экшн поиска участков по кадастровым номерам.
	 *
	 * @return array
	 *
	 * @author Насибуллин Рафаэль
	*/
	public function actionSearch(): array
	{
		Yii::$app->response->format = Response::FORMAT_JSON;

		$model  = new SearchForm();
		$result = $model->search(Yii::$app->request->queryParams);

		return $result;
	}
}
