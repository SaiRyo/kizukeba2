<?php
/**
 *  smarty modifier:checked()
 *
 *  sample:
 *  <code>
 *  $smarty->assign("form", 2);
 *
 *  <input type="radio" name="test" value="1" {"1"|checked:$form}>
 *  <input type="radio" name="test" value="2" {"2"|checked:$form}>
 *  </code>
 *  <code>
 *  <input type="radio" name="test" value="1">
 *  <input type="radio" name="test" value="2" checked="checked">
 *  </code>
 *
 *  @param  string  $string 期待値
 *  @param  string  $string 実際値
 *  @return string  期待値に一致する場合 checked="checked"
 */
function smarty_modifier_checked($expected, $actual) {

	// 初期化
	$sRet = '';

	// 実際値が配列の場合
	// 配列内に期待値がある
	if (is_array($actual) && in_array($expected, $actual, true)) {
		$sRet = 'checked="checked"';
	}
	// 実際値が文字列の場合
	else if (is_string($actual) && $expected === $actual) {
		$sRet = 'checked="checked"';
	}

	return $sRet;
}