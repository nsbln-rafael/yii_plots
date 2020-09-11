<?php

declare(strict_types=1);

namespace common\fixtures;

use yii\test\ActiveFixture;

/**
 * Фикстуры участков.
 *
 * @author Насибуллин Рафаэль
 */
class PlotFixture extends ActiveFixture
{
	/** @var string Класс участка */
	public $modelClass = 'common\models\Plot';
}
