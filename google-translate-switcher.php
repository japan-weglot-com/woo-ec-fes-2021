<?php
/**
 * Google Translate Switcher
 *
 * Plugin Name: Google Translate Switcher - Demo
 * Description: Demo - Enables the language switcher to translate web pages on Google Translate 
 * Version:     1
 * License:     GPLv2 or later
 * License URI: http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

function set_swicther_in_the_content(){
	$supported_languages = array(
		'en'	=>	'English',
		'zh_TW'	=>	'繁體中文',
		'th'	=>	'ไทย'
	);

	$list_html　= '';
	$base_url = "https://translate.google.com/translate";
	$current_page_url = (is_ssl() ? 'https' : 'http') . '://' . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
	$parameter_template = '?sl=%s&tl=%s&u=%s';
	$list_html_template = '<li class="gts-li"><a href="%s">%s</a></li>';
	
	foreach( $supported_languages as $key => $name ){
		$parameter = sprintf( $parameter_template, "auto", $key, $current_page_url );
		$href_url = $base_url . $parameter;
		$list_html .= sprintf( $list_html_template, $href_url, $name );
		$list_html .= PHP_EOL;
	}

	$html = <<<EOT
		<style>
			.google-translate-switcher {
				position: fixed;
				left: 10em;
				bottom: 0;
				background-color:#D7D7D7;
				z-index:1000;
			}
			.gts-button__label{
				background-color: #4080F2;
				padding: 10px 20px;
				font-weight:bold;
				color:#E2E2E2;
				text-align:center;

			}
			.gts-ul{
				margin:16px auto;
				padding:0 16px;
			}
			.gts-li {
				list-style:none;
				margin-bottom:10px;
			}

			.gts-li a{
				display:block;
				background-color:#fff;
				text-align:center;
				line-height:30px;
				border-radius:4px;
				box-shadow: 1px 1px 0px 0px rgba(0, 0, 0, 0.25);
				color:#4080F2;
			}

			.gts-li a:hover{
				position:relative;
				top:1px;
				left:1px;
				box-shadow:none;
				color:#000;
			}
		</style>

		<aside class="google-translate-switcher">
		<label class="gts-button__label" ><span class="gts-button__span">Googleでページ翻訳</span></label>
		  <ul class="gts-ul">
		  {$list_html}
		  </ul>
		</aside>
EOT;
	echo $html;
}
add_action( 'wp_footer', 'set_swicther_in_the_content' );
