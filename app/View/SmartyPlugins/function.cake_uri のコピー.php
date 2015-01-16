<?php
/**
 *  smarty function:cake_uri()
 *
 *
 *  @param  array   $params     パラメーター
 *  @param  object  &$smarty    Smarty
 *  @return string  URL
 */
function smarty_function_cake_uri($params, &$smarty) {

	// 初期化
	$sRet    = '';
	$sCtrl   = '';
	$sAct    = '';
	$arPass  = array();
	$arQuery = array();
	$sQuery  = '';
	$bIsFull = false;
	$arUrl   = array();
	$objVars = $smarty->getTemplateVars('params');
	$arSmartyParams = $objVars->params;

	// コントローラーの指定がある
	if (array_key_exists('ctrl', $params) && !ComUtility::isNilValue($params['ctrl'])) {
		$sCtrl = $params['ctrl'];
		unset($params['ctrl']);
	}
	else {
		$sCtrl = $arSmartyParams['controller'];
		
	}

	// アクションの指定がある
	if (array_key_exists('act', $params) && !ComUtility::isNilValue($params['act'])) {
		$sAct = $params['act'];
		unset($params['act']);
	}
	else {
		$sAct = $arSmartyParams['action'];
	}

	// パラメーターセット
	$arUrl = array();

	$arUrl['controller'] = $sCtrl;
	$arUrl['action'] = $sAct;

	// 拡張子の指定がある
	if (array_key_exists('ext', $params) && !ComUtility::isNilValue($params['ext'])) {
		$arUrl['ext'] = $params['ext'];
	}

	// 追加引数/クエリ検索
	foreach ($params as $sKey => $sValue) {

		// 初期化
		$arQueryKey  = array();
		$sQueryKey   = '';

		// キーの先頭がpass_
		if (strpos($sKey, 'pass_') === 0) {
			$arPass[] = $sValue;
			unset($params[$sKey]);
		}
		// キーの先頭がq_
		else if(strpos($sKey, 'q_') === 0) {
			$arQueryKey = explode('_', $sKey, 2);
			$sQueryKey  = $arQueryKey[1];
			$arQuery[$sQueryKey] = $sValue;
		}
	}

	// クエリがある
	if (!ComUtility::isNilValue($arQuery)) {
		// クエリ生成
		$sQuery = Router::queryString($arQuery, array(), true);
	}

	// フルパス取得フラグがある
	if (array_key_exists('___full', $params)) {
		$bIsFull = true;
	}

	// 配列マージ
	$arUrl = array_merge($arUrl, $arPass);
	// URL生成
	$sRet = Router::url($arUrl, $bIsFull);

	// クエリがある
	if (!ComUtility::isNilValue($sQuery)) {
		$sRet .= $sQuery;
	}

	return $sRet;
}