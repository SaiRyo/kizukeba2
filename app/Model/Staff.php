<?php


//----------------------------------------------------------------------
// App::uses
//----------------------------------------------------------------------
/**
 * 利用クラス宣言
 *
 */
App::uses('AppModel', 'Model');
/*
App::uses('AppModel', 'Model');
App::uses('Security', 'Utility');
*/

//------------------------------------------------------------------------------
//--    クラス： Staff
//--    Class ： Staff
//------------------------------------------------------------------------------
/*
 *スタッフ(管理者)情報モデルクラス
 *
 * [copyright]
 * @link
 * @package app.Model
 * @since
 * @license
 *
 */
class Staff extends AppModel {

	//----------------------------------------------------------------------
	// プロパティ
	//----------------------------------------------------------------------
	/**
	 * $useTable
	 *
	 * @var string
	 */
	 public $useTable = 'mst_staff';

	/**
	 * $primaryKey
	 *
	 * @var string
	 */
	public $primaryKey = 'code';

	/**
	 * $sequence
	 *
	 * @var string
	 */
	public $sequence = 'public.seq_staffs';


	//----------------------------------------------------------------------
	// バリデーション
	//----------------------------------------------------------------------
	/**
	 * $validate
	 *
	 * codeを指定するとmessages.iniから一致する文章が出力される
	 * codeがない場合はmessageが出力される
	 *
	 * @var array
	 */
	/*
	public $validate = array();


	}
	*/


	//----------------------------------------------------------------------
	// メソッド
	//----------------------------------------------------------------------
	//----------------------------------------------------------------------
	//-- 関数名 ：コンストラクタ
	//-- Method:__construct()
	//----------------------------------------------------------------------	
	/**
	 * __construct
	 *
	 * .
	 * 
	 * @access public
	 * @return bool
	 */
	/*
	public function __construct() {
		
	}
	*/

	//--------------------------------------------------------------------------
	//--    関数名： 保存前処理
	//--    Method： beforeSave()
	//--------------------------------------------------------------------------
	/**
	 * beforeSave
	 * 
	 * 保存前処理
	 * 
	 * @access public
	 * @return bool
	 */
	/*
	public function beforeSave($options = array()) {

		// パスワードをアップデートしない
		
		if ($this->notPasswordUpdate) {
			unset($this->data[$this->alias]['password']);
		}

		// パスワードを暗号化する
		if (isset($this->data[$this->alias]['password'])) {
			$this->data[$this->alias]['password'] = Security::hash($this->data[$this->alias]['password'], 'blowfish');
		}

		return true;
		
	}
	*/

	//--------------------------------------------------------------------------
	//--    関数名： パスワードチェック
	//--    Method： userPasswordRule()
	//--------------------------------------------------------------------------
	/**
	 * userPasswordRule
	 * 
	 * パスワードチェック
	 * 
	 * @access public
	 * @return bool
	 */
	/*
	public function userPasswordRule($check) {
	}
	*/


}
