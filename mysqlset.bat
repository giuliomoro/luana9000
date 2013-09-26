call %~dp0/config/config.bat
set pdbpwd=
IF "%db_use_password%"=="true" set pdbpwd=-p%db_password%
%mysql_path%mysql -u%db_user% %pdbpwd% -e "USE %db_name%; INSERT INTO `%db_name%`.`requests` (`scene_id`,`fadetime`,`class_id`) VALUES ('%1',  '%2', '%3');
REM timeout 5
exit