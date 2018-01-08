<?php

require_once('controllers/controller.php');
class HomeController extends Controller
{

	public function index(){
		return $this->view('home');
	}
	
}