<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	
	public $viewClass = 'Smarty';
	var $ext = '.html';
	//var $view = 'Smarty';

	// Twitter BootStrapのヘルパーを追加
	public $helpers = array(
		'Session',
		'Html' => array('className' => 'TwitterBootstrap.BootstrapHtml'),
		'Form' => array('className' => 'TwitterBootstrap.BootstrapForm'),
		'Paginator' => array('className' => 'TwitterBootstrap.BootstrapPaginator'),
	);

	// Twitter BootStrap CSSフレームワーク適用
	public $layout = 'TwitterBootstrap.default';

	//--------------------------------------------------------------------------
	// メソッド
	//--------------------------------------------------------------------------
	//--------------------------------------------------------------------------
	//--    関数名： beforeRender
	//--    Method： beforeRender()
	//--------------------------------------------------------------------------
	/**
	 * レンダリングの前処理。コントローラーのアクションの後でビューが描画される前に呼ばれる。
	 *
	 * @return void
	 */
	public function beforeRender() {

		//----------------------------------------------------------------------
		// 共通
		//----------------------------------------------------------------------
		// 共通templateディレクトリ
		// APP、DSはCakePHP定数
		$sCommonDir = APP . 'View' . DS . 'Common';
		$this->set('CommonDir', $sCommonDir);

		// Session->flash
		/*
		$SessionFlashAttr = array('element' => 'default', 'params' => array('class' => 'alert alert-error'));
		$this->set('SessionFlashAttr', $SessionFlashAttr);
		*/
	}


	//--------------------------------------------------------------------------
	//--    関数名： beforeFilter
	//--    Method： beforeFilter()
	//--------------------------------------------------------------------------
	/**
	 * アクションの
	 *
	 * @return void
	 */
	/*
	public function beforeRender() {


	}
	*/

	
}
