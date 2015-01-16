<?php
/**
 *  smarty function:assign_assoc()
 *
 *
 *  @param  array   $params     パラメーター
 *  @param  object  &$smarty    Smarty
 *  @return string  URL
 */
function smarty_function_assign_assoc($params, &$smarty) {
	//extracts variables passed in
	extract($params);
	$assoc_array = array();

	if(!isset($value) || !isset($var)) {
		return;
	}

	if(!isset($glue)) {
		$glue = ',';
	}
	$key_val_pairs = explode($glue, $value);
	foreach($key_val_pairs as $pair){
		list($key, $val) = explode('=>',$pair);
		if($val == 'false') {
			$assoc_array[trim($key)] = false;
		}else{
			$assoc_array[trim($key)] = trim($val);
		}
	}
	$smarty->assign($var, $assoc_array);
}