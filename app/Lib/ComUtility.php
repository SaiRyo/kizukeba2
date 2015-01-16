<?php
//------------------------------------------------------------------------------
//--    クラス： ComUtility
//--    Class ： ComUtility
//------------------------------------------------------------------------------
/**
 *
 * 共通関数群
 * 
 */
class ComUtility
{
	//--------------------------------------------------------------------------
	//--    関数名： 正しいIDかチェックする
	//--    Method： isValidId()
	//--------------------------------------------------------------------------
	/**
	 * 正しいIDかチェックする
	 *
	 * @param    $param							[I]チェック対象
	 * @param    $ok							[I/O]チェックOK
	 * @param    $ng							[I/O]チェックNG
	 * @return   boolean						判定結果
	 *											1つでもOKがあればtrue
	 */
	public static function isValidId($param, &$ok = array(), &$ng = array()) {
		$bRet = false;

		if (! is_array($param)) {
			$param = array($param);
		}

		if (count($param) > 0) {
			foreach($param as $val) {
				if (is_numeric($val) && $val >= 0 && $val <= BIGINT_MAX) {
					$ok[] = $val;
					$bRet = true;
				}
				else {
					$ng[] = $val;
				}
			}
		}

		return $bRet;
	}

	//--------------------------------------------------------------------------
	//--    関数名： 変数の空チェック
	//--    Method： isNilValue()
	//--------------------------------------------------------------------------
	/**
	 * string,arrayの空チェックを行う。
	 *
	 * stringチェック対象 1:''
	 *                    2:\0
	 *                    3:NULL
	 *                    4:false
	 *                    5:strlen(xx) <= 0
	 * arrayのチェック対象 1:empty
	 *
	 * @param    String or Array  $param   [I]パラメータチェック対象
	 * @return   boolean          判定結果   （値あり：false、値なし:true）
	 */
	public static function isNilValue($param) {

		// 変数初期化
		$bDec = false;

		// Array
		if (is_array($param)) {
			// 空チェック（値あり：false、値なし:true）
			$bDec = empty($param);
		}
		// String
		else {
			// 空チェック（値あり：false、値なし:true）
			$bDec = ( $param === ''   || $param === "\0"  ||
					$param === NULL || $param === false );
		}

		return $bDec;
	}

	//--------------------------------------------------------------------------
	//--    関数名： 空変数を空文字に変換
	//--    Method： convNilValue()
	//--------------------------------------------------------------------------
	/**
	 * string,arrayの空チェックを行い、空の場合空文字を返す
	 *
	 * stringチェック対象 1:''
	 *                    2:\0
	 *                    3:NULL
	 *                    4:false
	 *                    5:strlen(xx) <= 0
	 * arrayのチェック対象 1:empty
	 *
	 * @param    String or Array  $param   [I]パラメータチェック対象
	 * @return   mix
	 */
	public static function convNilValue($param) {

		// 変数初期化
		$mixRet = '';

		// Array
		if (is_array($param)) {
			// 空チェック
			$mixRet = empty($param) ? '' : $param;
		}
		// String
		else {
			// 空チェック
			if (( $param === '' || $param === "\0"
				|| $param === NULL || $param === false )) {

				$mixRet = '';
			}
			else {
				$mixRet = $param;
			}
		}

		return $mixRet;
	}

	//--------------------------------------------------------------------------
	//--    関数名： パラメーター配列取得
	//--    Method： getRequestParams()
	//--------------------------------------------------------------------------
	/**
	 * requestから指定のパラメーターを取り出す
	 * string,arrayの空チェックを行い、空の場合空文字を返す
	 *
	 *
	 * @param    array  $arParams       パラメーター名
	 * @param    array  $arReqestData   リクエストデータ
	 * @return   array  空チェック後配列
	 */
	public static function getRequestParams($arParams, $arReqestData) {

		// 変数初期化
		$arRet = array();

		if (!is_array($arParams)) {
			return $arRet;
		}

		// パラメーター走査
		foreach ($arParams as $sField) {

			// 走査内初期化
			$arRet[$sField] = '';

			// 存在チェック
			if (array_key_exists($sField, $arReqestData)) {
				// 値がなければ空文字
				$arRet[$sField] = self::convNilValue($arReqestData[$sField]);
			}
		}

		return $arRet;
	}
}