<?php
//------------------------------------------------------------------------------
//--
//--    FILE NAME : SmartyView.php
//--
//--    $Id: SmartyView.php 46 2013-10-10 12:44:20Z komaki $
//--
//------------------------------------------------------------------------------
//--   @COPYRIGHT 2013 BY NEOJAPAN  CORPORATION ALL RIGHTS RESERVED
//------------------------------------------------------------------------------
/**
 * Methods for displaying presentation data in the view.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */


/**
 * require Smarty 3.x singleton
 *
 * @link http://www.smarty.net/
 * @copyright 2008 New Digital Group, Inc.
 * @author Monte Ohrt <monte at ohrt dot com>
 * @author Uwe Tews
 * @author Rodney Rehm
 * @package Smarty
 */
class SmartySingleton {
	static private $instance = null;

	private function __construct() {}
	private function __clone() {}
	private function __wakeup() {}

	static public function instance() {
		if (is_null(self::$instance)) {

			App::import('Vendor', 'Smarty', array('file' => 'smarty' . DS . 'Smarty.class.php'));
			$smarty = new Smarty();
			$smarty->template_dir = APP . 'View' . DS;
			
			//plugins dir(s) must be set by array
			$smarty->plugins_dir = array(
				APP . 'View' . DS . 'SmartyPlugins',
				APP . 'Vendor' . DS . 'smarty' . DS . 'plugins'
			);
			$smarty->config_dir        = APP . 'View' . DS . 'SmartyConfigs' . DS;
			$smarty->compile_dir       = TMP . 'smarty' . DS . 'compile' . DS;
			$smarty->cache_dir         = TMP . 'smarty' . DS . 'cache' . DS;
			$smarty->error_reporting   = 'E_ALL & ~E_NOTICE';
			$smarty->default_modifiers = array('escape:"html"');
			$smarty->compile_check     = true;

			//UNDONE: if you need, modify section.
			/*
			$smarty->autoload_filters = array(
				'pre' => array('hoge'),
				'output' => array('escape')
			);
			$smarty->left_delimiter = '{';
			$smarty->right_delimiter = '}';
			//for development
			$smarty->debugging = (Configure::read('debug') == 0) ? false : true;
			*/

			self::$instance = $smarty;
		}
		return self::$instance;
	}

}
/**
 * SmartyView
 *
 * smarty view
 *
 * @package       app.View
 */
class SmartyView extends View {

	/**
	 * __construct
	 *
	 * @return void
	 */
	function __construct (&$controller) {
		// 親処理
		parent::__construct($controller);

		// smarty instance
		$this->Smarty = SmartySingleton::instance();

		// 拡張子
		$this->ext= '.html';

		// コントローラーからのパラメーター
		$this->viewVars['params'] = $this->params;
	}

	/**
	 * render
	 *
	 * @param string $view Name of view file to use
	 * @param string $layout Layout to use.
	 * @return string Rendered Element
	 * @throws CakeException if there is an error in the view.
	 */
	public function render($view = null, $layout = null) {
		// バリデーション結果を埋め込み
		$arErrors = array();
		foreach ($this->validationErrors as $sModel => $arModelErrors) {
			foreach ($arModelErrors as $sfield => $arMsg) {
				$arErrors[$sModel . '_' . $sfield] = $arMsg[0];
			}
		}
		$this->viewVars['validationErrors'] = $arErrors;
		return parent::render($view, $layout);
	}

	/**
	 * Renders and returns output for given view filename with its
	 * array of data. Handles parent/extended views.
	 *
	 * @param string $___viewFn Filename of the view
	 * @param array $___dataForView Data to include in rendered view. If empty the current View::$viewVars will be used.
	 * @return string Rendered output
	 * @throws CakeException when a block is left open.
	 */
	protected function _render($___viewFn, $___dataForView = array()) {
	
		// templateの拡張子判断
		$isCtpFile = (substr($___viewFn, -3) === 'ctp');

		// データが無い
		if (empty($___dataForView)) {
			// プロパティからセットし直す
			$___dataForView = $this->viewVars;
		}

		// templateがctpファイル
		if ($isCtpFile) {
			// 親処理
			$out = parent::_render($___viewFn, $___dataForView);
		}
		else {

			foreach($___dataForView as $data => $value) {
				if (!is_object($data)) {
					$this->Smarty->assign($data, $value);
				}
			}

			$this->Smarty->assign('_view', $this);

			ob_start();
			$this->Smarty->display($___viewFn);
			$out = ob_get_clean();
		}
		return $out;
	}

	/**
	* Interact with the HelperCollection to load all the helpers.
	* 
	* Load helpers to use in tpl, like {$Html->link("Go Google", 'http://google.co.jp')}
	*
	* @return void
	*/
	public function loadHelpers() {

		$helpers = HelperCollection::normalizeObjectArray($this->helpers);
		foreach ($helpers as $name => $properties) {
			list($plugin, $class) = pluginSplit($properties['class']);
			$this->{$class} = $this->Helpers->load($properties['class'], $properties['settings']);
			$this->Smarty->assign($name, $this->{$class});
		}
		$this->_helpersLoaded = true;
	}
}