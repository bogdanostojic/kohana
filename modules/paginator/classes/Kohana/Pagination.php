<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Author: Gerasimov Ilya
 * Github: https://github.com/Omashu/
 * 
 * Examples:
 * 
 * 	Create by base URL:
 * 
 * 		#1: Pagination::factory(array(
 * 			'base_url' => '/page',
 * 			'count_items' => 40,
 * 			'items_per_page' => 10,
 * 			'current_page' => 1,
 * 		), 'default');
 * 
 * 		#2: Pagination::factory('/page', 1, 40, 10);
 * 
 * 		Return urls: '/page1', '/page2', '/page3' ...
 * 
 * 	Create by route:
 * 
 * 		#3: Pagination::factory(array(
 * 					'current_page' => 1,
 * 					'count_items' => 40,
 * 					'items_per_page' => 10,
 * 					'route' => 'items',
 * 					'route_page_key' => 'page',
 * 					'route_args' => array('order_by' => 'rating', 'order_way' => 'desc'),
 * 				), 'config_key');
 * 				Route 'items' example: "items/page<page>?order_by=<order_by>&order_way=<order_way>"
 * 
 * 		Return urls: 'items/page1?order_by=rating&order_way=desc' ...
 */

class Kohana_Pagination {

	const VERSION = "1.0";
	protected static $config = NULL;

	/*** MAIN SETTINGS ***/

	/**
	 * Template
	 */
	protected $view = "pagination/pagination";

	/**
	 * Route name for create urls
	 */
	protected $route = NULL;

	/**
	 * Route argument key for substitution to page number
	 */
	protected $route_page_key = NULL;

	/**
	 * Route argument values
	 */
	protected $route_args = array();

	/**
	 * Base url for create urls
	 */
	protected $base_url = NULL;

	/**
	 * Page view type
	 * Values: normal OR pieces
	 * normal: 1,2,3,4,5,6,7,8,9
	 * pieces: 1,2...56...9 (example)
	 */
	protected $switch_type = "normal";

	/*** ADDITIONAL SETTINGS ***/

	/**
	 * View button to the first page
	 */
	protected $show_first = TRUE;

	/**
	 * View button to the prev page
	 */
	protected $show_prev = TRUE;

	/**
	 * View button to the prev page
	 */
	protected $show_last = TRUE;

	/**
	 * View button to the next page
	 */
	protected $show_next = TRUE;

	/**
	 * Wrap in <div/>
	 */
	protected $show_in_block = TRUE;

	/**
	 * Wrap in <ul/>
	 */
	protected $show_in_list = TRUE;

	protected $block_params = array('class' => 'pagination');
	protected $list_params = array('class' => '');

	protected $li_active_params = array('class' => 'active');
	protected $a_active_params = array('class' => '');
	protected $span_active_params = array('class' => '');

	protected $li_divider_params = array('class' => 'divider');
	protected $span_divider_params = array('class' => '');

	/*** LANGS ***/
	protected $lang_next = 'Next';
	protected $lang_prev = 'Prev';
	protected $lang_first = '&laquo;';
	protected $lang_last = '&raquo;';
	protected $lang_divider = '...';

	/*** PROCESS ***/
    private $current_page = 1;
	public $count_items = 0;
	public $items_per_page = 0;
	protected $count_pages = 0;
	protected $left = 3;
	protected $right = 3;
	protected $switches = array();
	protected function __construct() {}

	/**
	 * @return object
	 */
	public static function factory() {
		if (is_null(Pagination::$config)) {
			Pagination::$config = Kohana::$config->load("pagination");
		}

		$group = Pagination::$config->get('default');
		$group = !is_array($group) ? array() : $group;

		$args = func_get_args();
		$num_args = func_num_args();
		$model = new Pagination();

		if ($num_args === 2 AND is_array($args[0]) AND is_string($args[1])) {
			$group = Pagination::$config->get($args[1]);
			$group = !is_array($group) ? array() : $group;
			$settings = array_merge($args[0], $group);
		} else if ($num_args === 1 AND is_array($args[0])) {
			$settings = array_merge($args[0], $group);
		} else if ($num_args === 4) {
			$settings = array(
				'base_url' => isset($args[0]) ? (string) $args[0] : $model->base_url,
				'current_page' => isset($args[1]) ? (int) $args[1] : $model->current_page,
				'count_items' => isset($args[2]) ? (int) $args[2] : $model->count_items,
				'items_per_page' => isset($args[3]) ? (int) $args[3] : $model->items_per_page,
			);
			$settings = array_merge($settings, $group);
		} else {
			return NULL;
		}

		// set settings
		foreach ($settings as $key => $value) {
			$model->{$key} = $value;
		}

		return $model;
	}

	/**
	 * Getter
	 * @param string $var variable
	 * @param mixed $default
	 * @return mixed
	 */
	public function get($var, $default = NULL) {
		if (isset($this->{$var})) {
			return $this->{$var};
		}

		return $default;
	}

	/***** VIEWS *****/
	public function view_list_item($html, array $li_params = array()) {
		return ($this->show_in_list 
			? "<li".HTML::attributes($li_params).">"
			:"") . $html . ($this->show_in_list?"</li>":"");
	}

	public function view_first() {
		if (!$this->show_first OR $this->current_page <= 2) {
			return NULL;
		}

		$anchor = HTML::anchor($this->get_page_url(1), $this->lang_first);
		return $anchor;
	}

	public function view_prev() {
		if (!$this->show_prev OR $this->current_page <= 1) {
			return NULL;
		}

		$anchor = HTML::anchor($this->get_page_url($this->current_page-1), $this->lang_prev);
		return $anchor;
	}

	public function view_next() {
		if (!$this->show_next OR $this->current_page >= $this->count_pages) {
			return NULL;
		}

		$anchor = HTML::anchor($this->get_page_url($this->current_page+1), $this->lang_next);
		return $anchor;
	}

	public function view_last() {
		if (!$this->show_last OR $this->current_page >= $this->count_pages
			OR (($this->count_pages - $this->current_page) <= 1)) {
			return null;
		}

		$anchor = HTML::anchor($this->get_page_url($this->count_pages), $this->lang_last);
		return $anchor;
	}

	public function view_block($type) {
		$type = strtolower($type);
		$html = '';
		switch ($type) {
			case 'open':
				if ($this->show_in_block) {
					$html .= "<div".HTML::attributes($this->block_params).">";
				}
				if ($this->show_in_list) {
					$html .= "<ul".HTML::attributes($this->list_params).">";
				}
				break;
			case 'close':
				if ($this->show_in_list) {
					$html .= "</ul>";
				}
				if ($this->show_in_block) {
					$html .= "</div>";
				}
				break;
		}

		return $html;
	}

	public function view_switches() {
		$html = '';
		foreach ($this->switches as $key => $page) {
			// divider
			if (!is_numeric($page)) {
				$html .= $this->view_list_item("<span".HTML::attributes($this->span_divider_params).">" .$page . "</span>", $this->li_divider_params);
				continue;
			}

			// page
			$flag_current = ((int)$page === (int)$this->current_page);
			$item = "<span".HTML::attributes($flag_current ? $this->span_active_params : array()).">" .$page. "</span>";
			if (!$flag_current) {
				$item = HTML::anchor($this->get_page_url($page), $item, $flag_current ?  $this->a_active_params : array());
			}

			$html .= $this->view_list_item($item, $flag_current ?  $this->li_active_params : array());
		}
		return $html;
	}

	protected function get_page_url($page) {
		if ($this->route !== null) {
			// сгенерируем по роуту
			$url = Route::url($this->route, $this->route_args + array($this->route_page_key => $page));
		} else {
			$url = $this->base_url . $page;
		}

		return $url;
	}

	// generate switches
	protected function switches() {
		$this->switches = array();
		if ($this->switch_type === 'normal') {
			$start = $this->current_page - $this->left;
			$start = ($start<=0) ? 1 : $start;
			$end = $this->current_page + $this->right;
			$end = $end > $this->count_pages ? $this->count_pages : $end;

			for ($i=$start; $i <= $end; $i++) { 
				$this->switches[] = $i;
			}
		}
		else if ($this->switch_type === 'pieces') {
			$position = $this->current_page;
			$position_left = $this->current_page - $this->left;
			$position_left = ($position_left<=0) ? 1 : $position_left;

			$position_right = $this->current_page + $this->right;
			$position_right = $position_right > $this->count_pages ? $this->count_pages : $position_right;

			if ( $position_left === 2) {
				$this->switches[] = 1;
			}
			else if ( $position_left > 2) {
				$this->switches[] = 1;
				if ($position_left <= 3) {
					$this->switches[] = $this->lang_divider;
				} else if ( $position_left > 3) {
					$this->switches[] = 2;
					$this->switches[] = $this->lang_divider;
				}
			}

			for ($i = $position_left; $i <= $position_right; $i++) { 
				$this->switches[] = $i;
			}

			$offset = $this->count_pages - $position_right;
			if ($offset > 3) {
				$this->switches[] = $this->lang_divider;
				$this->switches[] = $this->count_pages-1;
				$this->switches[] = $this->count_pages;
			} else if ($offset >= 1) {

				if ($offset >= 2) {
					$this->switches[] = $this->lang_divider;
				}

				$this->switches[] = $this->count_pages;
			}
		}
	}

	public function render() {
		try {
			// counts
			$this->count_items = max(0, (int) $this->count_items);
			$this->items_per_page = max(1, (int) $this->items_per_page);
			$this->count_pages = ceil($this->count_items/$this->items_per_page);

			// generate
			$this->switches();

			return View::factory($this->view)
				->set('paginator', $this)->render();
		} catch (Kohana_Exception $e) {
			return 'Pagination: ' . $e->getMessage();
		}
	}

	public function __toString() {
		return $this->render();
	}
}