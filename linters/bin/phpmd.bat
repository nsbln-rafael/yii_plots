@echo off
setlocal DISABLEDELAYEDEXPANSION

cd %~dp0/../
set BIN_TARGET=vendor/phpmd/phpmd/src/bin/phpmd

php "%BIN_TARGET%" %* text %~dp0/../phpmd.xml
