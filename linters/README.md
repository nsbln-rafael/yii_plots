### Настройка phpcs и phpmd в PhpStorm

##### Что это такое?

Это проверка стиля кода, разметки, отступов, правил использования методов и функций.  
PHPStorm будет подсвечивать все замечания как ошибки.  
Все эти замечания надо будет исправить до того, как выкладывать код на ревью.

##### Установка

Все необходимые пакеты уже прописаны в `composer.lock`.  
Все необходимые XML-конфигурации тоже уже есть в репозитории.  
Надо просто выполнить `composer install` в директории `linters`.

Если возникает ошибка `The requested PHP extension ... is missing`, то необходимо установить это PHP-расширение, например, так:

```sh
sudo apt install php-intl
```

_Далее…_

На *nix-системе, если необходимо:
- Установить chmod на выполнение sh-файлов;
- Дать права пользователю, запускающему PHPStorm.

Как правило, это делается так:
```sh
sudo chmod -R 777 ./linters
sudo chown -R user:www-data ./linters
```

##### Настройка PHPStorm

Открываем `PhpStorm`, заходим в меню `File -> Settings`.  
Переходим в `Languages & Frameworks -> PHP -> Quality Tools`.  
Ну или написать `Quality tools` в строке поиска слева сверху.

_Далее…_

Разворачиваем `PHP_CodeSniffer` и нажимаем на кнопку `[…]` для выбора файла.  
Выбираем `./linters/bin/phpcs` (или bat-файл для windows).  
Нажимаем на кнопку `Validate`.  
Снизу должна появиться версия и что всё ОК.

_Далее…_

Разворачиваем `Mess Detector` и нажимаем на кнопку `[…]` для выбора файла.  
Выбираем `./linters/bin/phpmd` (или bat-файл для windows).  
Нажимаем на кнопку `Validate`.  
Снизу должна появиться версия и что всё ОК.

_Далее…_

Переходим слева в `Editor -> Inspections`.  
В дереве справа ищем ветку `PHP -> Quality tools`.


_Далее…_

Ставим галочку напротив `PHP Mess Detector validation`.  
Справа меняем `Severinity` на `Error`.  
Нажимаем плюсик и выбираем файл `./linters/phpmd.xml`

_Далее…_

Ставим галочку напротив `PHP_CodeSniffer validation`.  
Справа меняем `Severinity` на `Error`.  
Меняем `Show warnings as:` на `Error`.  
Нажимаем на кнопку обновления справа от `Coding standard`.
Меняем `Coding standard` на `MySource`.  
Убираем галочку с `Installed standard paths`.

##### Как проверить работу

Открыть файл `./linters/example/LintersExample.php`.  
Если всё настроено верно, почти весь файл будет в ошибках.
