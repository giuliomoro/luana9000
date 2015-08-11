@ECHO OFF
set datapath=%dp0%../helpers/data.txt
set timeout=1
set firstScene=1000
set lastScene=1013

:loop
for /l %%s IN (%firstScene%,1,%lastScene%) DO (
	echo %%s 500 101 > %datapath%
	echo %%s
	timeout %timeout% 
)
goto loop
