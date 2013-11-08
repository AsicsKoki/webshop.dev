<?php

class HomeController extends BaseController {

	 public function __construct()
    {
 	$this->beforeFilter('auth', array('except' => array('login','authenticate','getRegister')));
	parent::__construct();
    }

	public function welcome(){
		return View::make('index');
	}
}