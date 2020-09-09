<?php

/**
 * Класс для проверки настройки phpcs и phpmd.
 *
 * @author Залатов Александр <zalatov.ao@gmail.com>
 */
class LintersExample {
	const MYNAME = 'test';
	const LOWER = 'test';

	/**
	 * Класс для проверки настройки phpcs и phpmd.
	 *
	 * @author Залатов Александр <zalatov.ao@gmail.com>
	 */
	function test() {



		echo '123' . '222';


		echo 222;
	}

	/**
	 * Класс для проверки настройки phpcs и phpmd.
	 *
	 * @return bool
	 *
	 * @author Залатов Александр <zalatov.ao@gmail.com>
	 */
	public function test2() {
		if (1) {
			return false;
		}
		else {
			return true;
		}
	}
}
