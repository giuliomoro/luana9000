rem :loop
:loop
@ECHO OFF
set db_name=otg
set db_user=root
REM db_use_password can be true or false
set db_use_password=false
set db_password=987654321z
REM set mysql_path=C:\xampp\mysql\bin\
set mysql_path=C:\Programmi\AppServ\mysql\bin\

set pdbpwd=-p%db_password%
echo 100
"%mysql_path%mysql" -u%db_user% %pdbpwd% -e "USE %db_name%; INSERT INTO `%db_name%`.`requests` (`scene_id`,`fadetime`,`class_id`) VALUES ('1000', '1000', '101');
timeout 2
echo 101
"%mysql_path%mysql" -u%db_user% %pdbpwd% -e "USE %db_name%; INSERT INTO `%db_name%`.`requests` (`scene_id`,`fadetime`,`class_id`) VALUES ('1001', '1000', '101');
timeout 2
echo 102
"%mysql_path%mysql" -u%db_user% %pdbpwd% -e "USE %db_name%; INSERT INTO `%db_name%`.`requests` (`scene_id`,`fadetime`,`class_id`) VALUES ('1002', '1000', '101');
timeout 2
echo 103
"%mysql_path%mysql" -u%db_user% %pdbpwd% -e "USE %db_name%; INSERT INTO `%db_name%`.`requests` (`scene_id`,`fadetime`,`class_id`) VALUES ('1003', '1000', '101');
timeout 2
echo 104
"%mysql_path%mysql" -u%db_user% %pdbpwd% -e "USE %db_name%; INSERT INTO `%db_name%`.`requests` (`scene_id`,`fadetime`,`class_id`) VALUES ('1004', '1000', '101');
timeout 2
echo 105
"%mysql_path%mysql" -u%db_user% %pdbpwd% -e "USE %db_name%; INSERT INTO `%db_name%`.`requests` (`scene_id`,`fadetime`,`class_id`) VALUES ('1005', '1000', '101');
timeout 2
echo 106
"%mysql_path%mysql" -u%db_user% %pdbpwd% -e "USE %db_name%; INSERT INTO `%db_name%`.`requests` (`scene_id`,`fadetime`,`class_id`) VALUES ('1006', '1000', '101');
timeout 2
echo 107
"%mysql_path%mysql" -u%db_user% %pdbpwd% -e "USE %db_name%; INSERT INTO `%db_name%`.`requests` (`scene_id`,`fadetime`,`class_id`) VALUES ('1007', '1000', '101');
timeout 2
echo 108
"%mysql_path%mysql" -u%db_user% %pdbpwd% -e "USE %db_name%; INSERT INTO `%db_name%`.`requests` (`scene_id`,`fadetime`,`class_id`) VALUES ('1008', '1000', '101');
timeout 2
echo 109
"%mysql_path%mysql" -u%db_user% %pdbpwd% -e "USE %db_name%; INSERT INTO `%db_name%`.`requests` (`scene_id`,`fadetime`,`class_id`) VALUES ('1009', '1000', '101');
timeout 2
echo 110
"%mysql_path%mysql" -u%db_user% %pdbpwd% -e "USE %db_name%; INSERT INTO `%db_name%`.`requests` (`scene_id`,`fadetime`,`class_id`) VALUES ('1010', '1000', '101');
timeout 2
echo 111
"%mysql_path%mysql" -u%db_user% %pdbpwd% -e "USE %db_name%; INSERT INTO `%db_name%`.`requests` (`scene_id`,`fadetime`,`class_id`) VALUES ('1011', '1000', '101');
timeout 2
echo 112
"%mysql_path%mysql" -u%db_user% %pdbpwd% -e "USE %db_name%; INSERT INTO `%db_name%`.`requests` (`scene_id`,`fadetime`,`class_id`) VALUES ('1012', '1000', '101');
timeout 2
echo 200
"%mysql_path%mysql" -u%db_user% %pdbpwd% -e "USE %db_name%; INSERT INTO `%db_name%`.`requests` (`scene_id`,`fadetime`,`class_id`) VALUES ('1013', '1000', '101');
timeout 2
@ECHO ON 
goto loop
rem goto loop