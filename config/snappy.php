<?php

return array(

	'pdf' => array(
		'enabled' => TRUE,
		'binary'  => ((php_uname('s') == 'Linux') ? (base_path('vendor/h4cc/wkhtmltopdf-amd64/bin/wkhtmltopdf-amd64')) : (base_path('vendor/wemersonjanuario/wkhtmltopdf-windows/bin/32bit/wkhtmltopdf.exe'))),
		'timeout' => FALSE,
		'options' => ((strlen(env('SYSTEM_PROXY', '')) != 0) ? (array('proxy' => env('SYSTEM_PROXY'))) : (array())),
		'env'     => array(),
	),

	'image' => array(
		'enabled' => TRUE,
		'binary'  => ((php_uname('s') == 'Linux') ? (base_path('vendor/h4cc/wkhtmltoimage-amd64/bin/wkhtmltoimage-amd64')) : (base_path('vendor/wemersonjanuario/wkhtmltopdf-windows/bin/32bit/wkhtmltoimage.exe'))),
		'timeout' => FALSE,
		'options' => ((strlen(env('SYSTEM_PROXY', '')) != 0) ? (array('proxy' => env('SYSTEM_PROXY'))) : (array())),
		'env'     => array(),
	),

);
