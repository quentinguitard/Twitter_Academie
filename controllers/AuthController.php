<?php

require_once('controllers/controller.php');
class AuthController extends Controller
{

	public function index(){
		return $this->view('auth');
	}
	
}