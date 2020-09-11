<?php

declare(strict_types=1);

namespace common\components\rosRegistry;

use common\components\rosRegistry\response\PlotResponse;
use common\models\Plot;
use yii\base\Component;
use yii\httpclient\Client;
use yii\web\BadRequestHttpException;

/**
 * Компонент для поиска участков в РосРеестре.
 *
 * @author Насибуллин Рафаэль
 */
class RosRegistryService extends Component
{
	/** @var Client HTTP-клиент */
	private $client;

	/** @var PlotsParser Парсер участков РосРеестра */
	private $parser;

	/** @var string URL поиска по кадастровому номеру */
	private $url;

	/**
	 * {@inheritdoc}
	 *
	 * @param Client      $client HTTP-клиент
	 * @param PlotsParser $parser Парсер
	 *
	 * @author Насибуллин Рафаэль
	 */
	public function __construct(Client $client, PlotsParser $parser, $config = [])
	{
		$this->client = $client;
		$this->parser = $parser;
		$this->url    = 'https://pkk2.rosreestronline.ru/api/id/?';

		parent::__construct($config);
	}

	/**
	 * Поиск участков по кадастровым номерам.
	 *
	 * @param array $numbers Кадастровые номера
	 *
	 * @return array
	 *
	 * @author Насибуллин Рафаэль
	 */
	public function search(array $numbers): array
	{
		$plots = [];

		foreach ($numbers as $number) {
			$number = $this->getFormattedNumber($number);
			$plot   = Plot::findOne([Plot::ATTR_CADASTRAL_ID => $number]);

			if (null !== $plot) {
				array_push($plots, $plot);

				continue;
			}

			$data = $this->getData($number);

			if (null !== $data) {
				$plot                   = new Plot;
				$plot->cadastral_number = $data->cadastral_number;
				$plot->cadastral_id     = $data->cadastral_id;
				$plot->price            = $data->price;
				$plot->area             = $data->area;
				$plot->address          = $data->address;
				$plot->save();

				array_push($plots, $plot);
			}
		}

		return $plots;
	}

	/**
	 * Форматирование кадастрового номера в формат пригодный для API https://pkk2.rosreestronline.ru.
	 * В номере убираются нули, если они указаны в начале какой-либо группы цифр.
	 * Пример: из "01:02:0100014:7" получаем "1:2:100014:7".
	 *
	 * @param string $number Кадастровый номер
	 *
	 * @return string
	 *
	 * @author Насибуллин Рафаэль
	 */
	private function getFormattedNumber(string $number): string
	{
		$array  = explode(':', $number);
		$array  = array_map('intval', $array);
		$result = implode(':', $array);

		return $result;
	}

	/**
	 * Отправка запрос в РосРеестр и получение ответа.
	 *
	 * @param string $number Кадастровый номер
	 *
	 * @return PlotResponse|null
	 *
	 * @author Насибуллин Рафаэль
	 */
	private function getData(string $number): ?PlotResponse
	{
		$response = $this->client->createRequest()
			->setMethod('GET')
			->setUrl($this->url . http_build_query(['l' => 1 , 'i' => $number]))
			->send();

		if ($response->isOk) {
			$data = $this->parser->parse($response->content);
		} else {
			throw new BadRequestHttpException('Ошибка! Не удалось получить данные. Попробуйте позже.');
		}

		return $data;
	}
}
