<?php

class Controller {

	protected function view($view, $param = []){
		extract($param);

		include('views/' . $view . '.php');
	}
}
