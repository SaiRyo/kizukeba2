<?php



//----------------------------------------------------------------------
// App::uses
//----------------------------------------------------------------------
/**
 * 利用クラス宣言
 *
 */
App::uses('AppController', 'Controller');

/**
 * スタッフマスタコントローラー
 *
 *
 * @package		app.Controller
 */
class StaffsController extends AppController {

	//----------------------------------------------------------------------
	// プロパティ
	//----------------------------------------------------------------------
	/**
	 * $uses
	 *
	 * @var array
	 */
	public $uses = array('Staff');

	//public $viewClass = 'Smarty';

	public $helpers = array('Html', 'Form');

	/**
	 * $paginate
	 *
	 * paginateの設定
	 *
	 * @var array
	 */
	 //public $uses = array('Staff');
	public $paginate = array(
				//'limit' => NUM_PAGE_LIMIT
				'limit' => 10
				,'order' => array(
							'Staff.name' => 'asc'
							)
				,'paramType' => 'querystring'
			);

	//--------------------------------------------------------------------------
	// メソッド
	//--------------------------------------------------------------------------
	//--------------------------------------------------------------------------
	//--    関数名： 一覧画面
	//--    Method： index()
	//--------------------------------------------------------------------------
	/**
	 * index
	 * 
	 * 一覧画面
	 * 
	 * @access public
	 * @return void
	 */
	public function index() {
		
		$this->set('sampleValue', 'サンプルテキスト');
		$this->set('APP', APP);
		$this->set('DS', DS);
	

		//初期化
		$arData = array();
		//$options['order'] = array('Staff.sort_order' => 'asc');

		//$this->set('arStaffs', $this->Staff->find('all'));

		try{
			//スタッフ情報取得
			$arData = $this->Staff->find('all');
		}
		catch(PDOException $e){
			ComLog::error($e->getMessage());
			ComLog::error($e->queryString);
			throw $e;

		}

		//登録されていない場合
		if(empty($arData) === true){
			//メッセージをviewに渡す
            //$this->set('sErrMessage', __('データが存在しません'));
		}
		else{
			//Viewセット
			$this->set('arStaffs', $arData);
		}

		//indexを表示
		$this->render('index');


	}

	//--------------------------------------------------------------------------
	//--    関数名： 作成画面
	//--    Method： create()
	//--------------------------------------------------------------------------
	/**
	 * create
	 * 
	 * 作成画面
	 * 
	 * @access public
	 * @return void
	 */
	public function create() {

	}

	//--------------------------------------------------------------------------
	//--    関数名： 変更画面
	//--    Method： edit()
	//--------------------------------------------------------------------------
	/**
	 * edit
	 * 
	 * 変更画面
	 * 
	 * @access public
	 * @return void
	 */
	public function edit() {

	}



}
