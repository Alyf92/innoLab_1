@ECHO OFF
setlocal DISABLEDELAYEDEXPANSION
SET BIN_TARGET=%~dp0/phpmd
SET COMPOSER_BIN_DIR=%~dp0
php "%BIN_TARGET%" %*
