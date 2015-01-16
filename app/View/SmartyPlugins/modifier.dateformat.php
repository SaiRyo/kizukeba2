<?php
/**
 *  smarty modifier:dateformat()
 *
 *  sample:
 *  <code>
 *  $smarty->assign('form', array('Year' => 2013, 'Month' => '09', 'Day' => '01'));
 *
 *  {$arDate|@date_str_format}
 *  </code>
 *  <code>
 *  2013-09-01
 *  </code>
 *
 *  @param  mix     $value 日付配列、日付文字列
 *  @return string  YYYY-MM-DD
 */
function smarty_modifier_dateformat($value) {

	// 初期化
	$sRet = null;

	// 文字列の場合
	if (is_string($value)) {
		// 日付?
		$sTimeStamp = strtotime($value);
		if ($sTimeStamp !== false) {
			$sRet = date('Y-m-d', $sTimeStamp);
		}
	}
	// 配列の場合
	else if (is_array($value) && count($value) === 3) {

		// Year, Month, Day前提
		extract($value);

		// 数値チェック
		if (ctype_digit($Year) && ctype_digit($Month) && ctype_digit($Year)) {
			// 日付チェック
			if (checkdate((int)$Month, (int)$Day, (int)$Year)) {
				$sRet = sprintf('%d-%02d-%02d', $Year, $Month, $Day);
			}
		}
	}

    return $sRet;
}