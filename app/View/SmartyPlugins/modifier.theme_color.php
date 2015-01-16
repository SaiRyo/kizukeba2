<?php
/**
 *  smarty modifier:theme_color()
 *
 *  sample:
 *  <code>
 *
 *  {1|theme_color}
 *  </code>
 *  <code>
 *  blue
 *  </code>
 *
 *  @param  string  $value カラーコード
 *  @return string  色
 */
function smarty_modifier_theme_color($value) {

	// 初期化
	$sRet = 'blue';

	$arColor = array('1' => 'blue'
					,'2' => 'green'
					,'3' => 'yellow'
					,'4' => 'pink'
					,'5' => 'red'
					,'6' => 'gray'
	);

	if (array_key_exists($value, $arColor)) {
		
		return $arColor[$value];
	}
	return $sRet;
}