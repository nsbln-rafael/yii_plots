<?php

declare(strict_types=1);

namespace common\components\rosRegistry;

use common\components\rosRegistry\response\PlotResponse;

/**
 * Парсер ответа(участков) из РосРеестра.
 *
 * @author Насибуллин Рафаэль
 */
class PlotsParser
{
	/**
	 * Парсинг
	 *
	 * @param string $json JSON с информацией об участке
	 *
	 * @return PlotResponse|null
	 *
	 * @author Насибуллин Рафаэль
	 */
	public function parse(string $json): ?PlotResponse
	{
		$data   = json_decode($json, true);
		$result = null;

		if (true === isset($data['feature'])) {
			$data                     = $data['feature']['attrs'];
			$result                   = new PlotResponse;
			$result->cadastral_number = $data['cn'];
			$result->address          = $data['address'];
			$result->area             = $data['area_value'];
			$result->price            = $data['cad_cost'];
		}

		return $result;
	}
}
