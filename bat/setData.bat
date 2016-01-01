set datapath=%dp0%../helpers/data.txt
echo %1 %2 %3 > %datapath%
echo scene_id %1 fadetime %2 class_id %3
REM timeout 4