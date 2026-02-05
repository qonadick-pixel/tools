<?php

	class Config
	{
		const RECAPTCHA_KEY = '6LdUC04pAAAAAK5HdS4qw2pdmWkDYVz9jqDBx7yt';
		// Подключение к базе данных сервера
		const DB_TYPE = 0; // 0 -  prod ; 1 - test

		/* database prod */

		const DB_HOST_SERVER_PROD = '127.0.0.1';
		
		const DB_USER_SERVER_PROD = 'u2401573_default';
		
		const DB_PASS_SERVER_PROD = 'P00YqU1Vbh52dfME';
	
		const DB_NAME_SERVER_PROD = 'u2401573_default';

		/* database test */

		const DB_HOST_SERVER_TEST = '185.9.145.150';
	
		const DB_USER_SERVER_TEST = 'w347048_site';
		
		const DB_PASS_SERVER_TEST = '123qwe123';
	
		const DB_NAME_SERVER_TEST = 'w347048_site';

		// Почта
		const smtp_enable = '1'; //1 - вкл | 0 - выкл ( если выключен то будет работать функция mail() )
		
		const smtp = 'ssl://server169.hosting.reg.ru'; //smtp сервер почты ( smtp.yandex.ru || smtp.mail.ru || smtp.gmail.com || smtp.rambler.ru || serverXXX.hosting.reg.ru || smtp.beget.com ) - больше тут: https://clck.ru/eSZt9
		
		const smtp_port = '465'; //порт smtp сервера ( 25 || 465 || 587 )
		
		const smtp_secure = 'SSL'; //SSL или TLS
		
		const smtp_debug = '0'; // debugging: 0 = dont error, 1 = errors and messages, 2 = messages only
		
		const smtp_username = 'support@grndtools.ru'; //логин почты, зачастую это почтовый адрес
		
		const smtp_password = 'wX1fS5eT6pzY6dG4'; //пароль. если yandex то нужен пароль приложения!
	
	}
	
	if(Config::DB_TYPE == 0) {
		$con = mysqli_connect(Config::DB_HOST_SERVER_PROD, Config::DB_USER_SERVER_PROD, Config::DB_PASS_SERVER_PROD, Config::DB_NAME_SERVER_PROD) or die("Ошибка BD #2!");
	} else {
		$con = mysqli_connect(Config::DB_HOST_SERVER_TEST, Config::DB_USER_SERVER_TEST, Config::DB_PASS_SERVER_TEST, Config::DB_NAME_SERVER_TEST) or die("Ошибка BD #2!");
	}
	$con->set_charset("utf8")
?>
