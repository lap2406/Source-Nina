<?php
	if(!defined('LIBRARIES')) die("Error");
	
	/* Root */
	define('ROOT',__DIR__);

	/* Timezone */
	date_default_timezone_set('Asia/Ho_Chi_Minh');

	/* Cấu hình coder */
	define('NN_MSHD','1359421');
	define('NN_AUTHOR','lapvt.nina@gmail.com');

	/* Cấu hình chung */
	$config = array(
		'author' => array(
			'name' => 'Vũ Tiến Lập',
			'email' => 'lapvt.nina@gmail.com',
			'timefinish' => '06/2021'
		),
		'arrayDomainSSL' => array(),
		'database' => array(
			'server-name' => $_SERVER["SERVER_NAME"],
			'url' => '/thang6_2021/trankimphu_1359421w/',
			'type' => 'mysql',
			'host' => 'localhost',
			'username' => 'demo52_trankimphu',
			'password' => 'QX81X49Pq9',
			'dbname' => 'demo52_trankimphu',
			'port' => 3306,
			'prefix' => 'table_',
			'charset' => 'utf8'
		),
		'website' => array(
			'error-reporting' => false,
			'secret' => '$nina@',
			'salt' => 'swKJjeS!t',
			'debug-developer' => true,
			'debug-css' => true,
			'debug-js' => true,
			'index' => false,
			'upload' => array(
				'max-width' => 1600,
				'max-height' => 1600
			),
			'lang' => array(
				'vi'=>'Tiếng Việt',
			),
			'lang-doc' => 'vi',
			'slug' => array(
				'vi'=>'Tiếng Việt'
			),
			'seo' => array(
				'vi'=>'Tiếng Việt',
			)
		),
		'order' => array(
			'ship' => true
		),
		'login' => array(
			'admin' => 'LoginAdmin'.NN_MSHD,
			'member' => 'LoginMember'.NN_MSHD,
			'attempt' => 5,
			'delay' => 15
		),
		'googleAPI' => array(
			'recaptcha' => array(
				'active' => false,
				'urlapi' => 'https://www.google.com/recaptcha/api/siteverify',
				'sitekey' => '6LezS5kUAAAAAF2A6ICaSvm7R5M-BUAcVOgJT_31',
				'secretkey' => '6LezS5kUAAAAAGCGtfV7C1DyiqlPFFuxvacuJfdq'
			)
		),
		'oneSignal' => array(
			'active' => false,
			'id' => 'af12ae0e-cfb7-41d0-91d8-8997fca889f8',
			'restId' => 'MWFmZGVhMzYtY2U0Zi00MjA0LTg0ODEtZWFkZTZlNmM1MDg4'
		),
		'license' => array(
			'version' => "7.0.0",
			'powered' => "phuctai.nina@gmail.com"
		)
	);

	/* Error reporting */
	error_reporting(($config['website']['error-reporting']) ? E_ALL : 0);

	/* Cấu hình base */
	//if($config['arrayDomainSSL']) require_once LIBRARIES."checkSSL.php";
	$http = 'http://';
	/*if(array_key_exists('HTTPS', $_SERVER) && $_SERVER["HTTPS"] == "on") $http .= "s";
   	$http .= "://";*/
	$config_url = $config['database']['server-name'].$config['database']['url'];
	$config_base = $http.$config_url;
	//$config_base = $http.$config_url;

	/* Cấu hình login */
	$login_admin = $config['login']['admin'];
	$login_member = $config['login']['member'];

	/* Cấu hình upload */
	require_once LIBRARIES."constant.php";
?>