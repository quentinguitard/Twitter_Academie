<?php

require_once('controllers/controller.php');
class ProfileController extends Controller
{

	public function index(){
		return $this->view('profile');
	}
	
}