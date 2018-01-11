<?php

require_once('controllers/controller.php');
class EditProfileController extends Controller
{

	public function index(){
		return $this->view('editProfile');
	}
	
}