<?php

declare(strict_types=1);

use frontend\controllers\PlotsController;
use frontend\models\plots\SearchForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<div>

	<div class="row">

		<div class="col-md-8 col-md-offset-2">
			<div class="text-center">
				<h3>Получение кадастровых данных:</h3>

				<div>
					<?php $form = ActiveForm::begin([
						'id' => 'search-form',
						'method' => 'GET',
						'action' => Url::to(PlotsController::ACTION_PLOTS),
					]); ?>

					<?= $form->field($model, SearchForm::ATTR_CADASTRAL_NUMBERS)->textInput(['autofocus' => true]) ?>

					<div class="form-group">
						<?= Html::submitButton(Html::encode('Получить данные'), ['class' => 'btn btn-primary']) ?>
					</div>

					<?php ActiveForm::end(); ?>
				</div>
			</div>

			<div>
				<?php if (count($result) > 0): ?>
					<p>Всего <?= count($result) ?> записи</p>

					<table class="table">
						<tr class="text-center">
							<th><?= $model->getAttributeLabel(SearchForm::ATTR_ID) ?></th>
							<th><?= $model->getAttributeLabel(SearchForm::ATTR_CADASTRAL_NUMBER) ?></th>
							<th><?= $model->getAttributeLabel(SearchForm::ATTR_ADDRESS) ?></th>
							<th><?= $model->getAttributeLabel(SearchForm::ATTR_AREA) ?> кв.м</th>
							<th><?= $model->getAttributeLabel(SearchForm::ATTR_PRICE) ?> руб.</th>
						</tr>
						<?php foreach ($result as $plot): ?>
							<tr>
								<td><?= $plot->id ?></td>
								<td><?= $plot->cadastral_number ?></td>
								<td><?= $plot->address ?></td>
								<td><?= sprintf('%0.4f', $plot->area) ?></td>
								<td><?= sprintf('%0.4f', $plot->price) ?></td>
							</tr>
						<?php endforeach ?>
					</table>
				<?php else: ?>
					<p>Нет результатов.</p>
				<?php endif ?>
			</div>

		</div>
	</div>

</div>
