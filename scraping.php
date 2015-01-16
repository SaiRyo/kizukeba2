<?php
/**
 * Requests collector.

 */
	// simple_html_dom.phpをインクルード
	include_once('lib/simplehtmldom_1_5/simple_html_dom.php');

	// スクレイピングしたいURLを指定
	$html = file_get_html( 'http://b.hatena.ne.jp/' );

	// 引っ張るものを指定してa要素を$elementに代入
	foreach($html->find('a') as $element)

	// $element(a要素)のhrefの後ろにbrタグを入れて吐き出す
	echo $element->href . '<br>';
?>

/**
 *  Get CakePHP's root directory
 */


/**

 */
