@echo off
setlocal DISABLEDELAYEDEXPANSION

cd %~dp0/../
set BIN_TARGET=vendor/squizlabs/php_codesniffer/bin/phpcs

php "%BIN_TARGET%" %* --runtime-set installed_paths %~dp0/../vendor/escapestudios/symfony2-coding-standard,%~dp0/../vendor/slevomat/coding-standard --extensions=php --standard=%~dp0/../phpcs.xml
