<?php
class ShoppingsController extends AppController {

	public function staff_add() {

		//POSTだった場合
		if($_SERVER["REQUEST_METHOD"] == "POST"){
			$this->staff_add_check();
			//$this->render('staff_add_check');

		}

		else{
			$this->render('staff_add');
		}

	}

	public function staff_add_check{

		$this->render('staff_add_check');
	}

/*

	public function staff_adding(){
		$this->render('staff_add');


	}

*/

}