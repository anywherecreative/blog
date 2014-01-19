<?php
	/**
	@author Jeff Manning
	@date 11/01/2014
	**/
	define("PD_BLOG",true);
	require('config.php');
	require('database.class.php');
	require('tags.class.php');
	require('router.class.php');
	require('layout.class.php');
	$conf = new Configuration();
	$router = new Router();
	$template = new Layout();
	require('controllers' . DS . $router->getOption() . '.ctl.php');
	$template->loadView($router->getOption());
?>
