<?php
#Vars - written at 2013-08-03
$dbhost="127.0.0.1";
$dbname="mysql";
$dbuser="root";
$dbpass="";
$dbport=3306;
$dbsocket="";
$compression=0;
$backup_path="C:/wamp/www/nmims/msd1.24.4/work/backup/";
$logdatei="C:/wamp/www/nmims/msd1.24.4/work/log/mysqldump_perl.log";
$completelogdatei="C:/wamp/www/nmims/msd1.24.4/work/log/mysqldump_perl.complete.log";
$sendmail_call="/usr/lib/sendmail -t -oi -oem";
$nl="\n";
$cron_dbindex=-3;
$cron_printout=1;
$cronmail=0;
$cronmail_dump=0;
$cronmailto="";
$cronmailto_cc="";
$cronmailfrom="";
$cron_use_sendmail=1;
$cron_smtp="localhost";
$cron_smtp_port="25";
@cron_db_array=("food","nmims","nsa","performance_schema","test");
@cron_dbpraefix_array=("","","","","");
@cron_command_before_dump=("","","","","");
@cron_command_after_dump=("","","","","");
@ftp_server=("","","");
@ftp_port=(21,21,21);
@ftp_mode=(0,0,0);
@ftp_user=("","","");
@ftp_pass=("","","");
@ftp_dir=("/","/","/");
@ftp_timeout=(30,30,30);
@ftp_useSSL=(0,0,0);
@ftp_transfer=(0,0,0);
$mp=0;
$multipart_groesse=0;
$email_maxsize=3145728;
$auto_delete=0;
$max_backup_files=3;
$perlspeed=10000;
$optimize_tables_beforedump=1;
$logcompression=0;
$log_maxsize=1048576;
$complete_log=1;
$my_comment="";
?>