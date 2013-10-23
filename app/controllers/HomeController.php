<?php

class HomeController extends BaseController {

	public function welcome(){
		return View::make('index');
	}
}