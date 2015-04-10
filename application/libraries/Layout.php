<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Layout {
	var $CI;
	var $layout;
	var $javascript;
	var $css;
	var $meta;
	var $layout_params;
	var $show_header;
	var $head_title;
	var $head_title_append_default;
	var $angular_app;
	function Layout($layout = "layout") {
		$css_array = array (
				"theme-z.css",
				"perfect-scrollbar.min.css" 
		);
		
		$javascript_array = array (
				"jquery.min.js",
				"angular.min.js",
				"angular-ui.js",
				"app.js",
				"filters.js",
				"directives.js",
				"perfect-scrollbar.with-mousewheel.min.js",
				"uustorage/base64.js",
				"uustorage/audio_image_store.js",
				"common.js",
				"ie6.pngfix.js",
				"json2.js",
				"jquery.jplayer.min.js",
				"jquery.cookie.js",
				"page/voice.js",
				"jquery-ui-1.10.2.custom.min.js" 
		);
		
		$this->CI = & get_instance ();
		$this->layout = $layout;
		$this->css = $css_array;
		$this->meta = array ();
		$this->javascript = $javascript_array;
		$this->layout_params = array ();
		$this->show_header = TRUE;
		$this->head_title = "PROJECT E";
		$this->head_title_append_default = FALSE;
	}
	function setLayout($layout) {
		$this->layout = $layout;
	}
	function setAngularApp($name) {
		$this->angular_app = $name;
	}
	
	/**
	 * viewを読み込むする
	 *
	 * $returnはTRUEの場合、layout.phpを読み込まずに指定した$viewを返す
	 *
	 * @param string $view        	
	 * @param array $data        	
	 * @param boolean $return        	
	 * @return type
	 */
	function view($view, $data = null, $return = false) {
		if (! is_array ( $data ))
			$data = array ();
		
		$loadedData = array ();
		$loadedData ['content_for_layout'] = $this->CI->load->view ( $view, $data, true );
		
		if ($return) {
			
			return $loadedData ['content_for_layout'];
		}
		
		// CSS適用
		if (! isset ( $loadedData ["css"] ))
			$loadedData ["css"] = array ();
		$loadedData ["css"] = array_merge ( $loadedData ["css"], $this->css );
		
		// Javascript適用
		if (! isset ( $loadedData ["javascript"] ))
			$loadedData ["javascript"] = array ();
		$loadedData ["javascript"] = array_merge ( $loadedData ["javascript"], $this->javascript );
		
		// Metatag適用
		if (! isset ( $loadedData ["meta"] ))
			$loadedData ["meta"] = array ();
		$loadedData ["meta"] = array_merge ( $loadedData ["meta"], $this->meta );
		
		// 共通ヘッダーの非表示
		$loadedData ["show_header"] = $this->show_header;
		
		foreach ( $this->layout_params as $key => $value ) {
			$loadedData [$key] = $value;
		}
		
		// Head title
		$loadedData ['head_title'] = $this->head_title;
		if ($this->head_title_append_default) {
			$default_title = "bk2 Facebookで”ブカツ”コミュニティ";
			$loadedData ['head_title'] .= " | " . $default_title;
		}
		$this->CI->load->view ( $this->layout, $loadedData, false );
	}
	
	/**
	 * viewの読み込みcssを追加する
	 *
	 * @param string $css
	 *        	例：
	 */
	function css($css) {
		$this->css [] = $css;
	}
	
	/**
	 * viewの読み込みjavascriptを追加する
	 *
	 * @param
	 *        	string javascript_file 例：
	 */
	function javascript($javascript_file) {
		$this->javascript [] = $javascript_file;
	}
	function load_javascript_array($array) {
		foreach ( $array as $k => $v ) {
			$this->javascript [] = $v;
		}
	}
	
	/**
	 * メタタグを追加する
	 *
	 * @param
	 *        	array meta tag 例：array('name' => 'robots', 'content' => 'no-cache')
	 */
	function meta($meta) {
		$this->meta [] = $meta;
	}
	
	/**
	 * paramを設定する
	 *
	 * @param string $param_name        	
	 * @param multi $value        	
	 */
	function layout_params($param_name, $value) {
		$this->layout_params [$param_name] = $value;
	}
	
	/**
	 * 共通ヘッダーの非表示フラグを設定する
	 *
	 * @param boolean $show_header        	
	 */
	function set_show_header($show_header) {
		$this->show_header = $show_header;
	}
	
	/**
	 * ログインユーザーIDを設定する
	 *
	 * @param boolean $login_user_id        	
	 */
	function set_login_user_id($login_user_id) {
		$this->login_user_id = $login_user_id;
	}
	
	/**
	 * headerのタイトルを設定する
	 *
	 * @param string $head_title        	
	 * @param boolean $append_default_header        	
	 */
	function set_head_title($head_title, $append_default_header = TRUE) {
		$this->head_title = $head_title;
		$this->head_title_append_default = $append_default_header;
	}
	public function get_start_page($type) {
		$picture_map = array (
				"fc_start" => "vocabulary.png",
				"ge_start" => "grammar.png",
				"ss_start" => "grammar.png",
				"rd_start" => "read.png",
				"ld_start" => "listen.png",
				"ek_start" => "eiken.png",
				"tc_start" => "imitate.png" 
		);
		$part_map = array (
				"fc_start" => "単熟語",
				"ge_start" => "文法",
				"ss_start" => "文法",
				"rd_start" => "リーディング",
				"ld_start" => "リスニング",
				"ek_start" => "英検形式に慣れる",
				"tc_start" => "模擬試験" 
		);
		$data ["pic"] = $picture_map [$type];
		$data ["part"] = $part_map [$type];
		$data ["type"] = $type;
		
		return $this->CI->load->view ( "study_start", $data, true );
	}
	public function get_end_page($type) {
		$part_map = array (
				"fc_end" => "単熟語",
				"ge_end" => "文法",
				"ss_end" => "文法",
				"rd_end" => "リーディング",
				"ld_end" => "リスニング",
				"ek_end" => "英検形式に慣れる",
				"tc_end" => "模擬試験" 
		);
		
		$data ["part"] = $part_map [$type];
		$data ["type"] = $type;
		
		return $this->CI->load->view ( "study_end", $data, true );
	}
	public function get_common_header_page() {
		$data = Array ();
		return $this->CI->load->view ( "header", $data, true );
	}
	public function get_extra_footer() {
		$data = Array ();
		return $this->CI->load->view ( "extra_footer", $data, true );
	}
}
