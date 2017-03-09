Kohana-3.3-Pagination
=====================

Module pagination for Kohana 3.3

Example 1:
---------------
	// base url, current page, count items, items per page
	$model = Pagination::factory('/index/page', 1, 40, 10);
	echo $model;

Example 2:
---------------
	// options required = count_items, items_per_page, current_page AND (base_url OR route)
	// config = string or empty but use default
	$model = Pagination::factory(array options, string config);
	echo $model;

Example 3 (create by route):
----------------------------
	// example route items: "items/page<p>?order_by=<order_by>&order_way=<order_way>"
	$model = Pagination::factory(array(
		'current_page' => 1,
		'count_items' => 100,
		'items_per_page' => 25,
		'route' => 'items',
		'route_page_key' => 'p',
		'route_args' => array(
			'order_by' => 'rating',
			'order_way' => 'desc',
		)
	));
	echo $model;

Options:
--------
* `current_page` - required, int current page
* `count_items` - required, int all count items
* `items_per_page` - required, int items on page
* `view` - string, template name - default: `pagination/pagination`
* `route` - string, route key for create urls by route - default: `NULL`
* `route_page_key` - string, route argument key for replace on page number - default: `NULL`
* `route_args` - array, route other arguments for replace - default: `array()`
* `base_url` - string, base url for create urls by url - default: `NULL`
* `switch_type` - string, show type, normal (1,2,3,4,5,6,7) OR pieces (1,2...6,7..9,10) - default: `normal`
* `show_first` - bool, show button to first page - default: `TRUE`
* `show_prev` - bool, show button to prev page - default: `TRUE`
* `show_last` - bool, show button to last page - default: `TRUE`
* `show_next` - bool, show button to next page - default: `TRUE`
* `show_in_block` - bool, wrap in div - default: `TRUE`
* `show_in_list` - bool, wrap in ul - default: `TRUE`
* `block_params` - array, attributes for block - default: `array('class' => 'pagination')`
* `list_params` - array, attributes for list - default: `array()`
* `li_active_params` - array, attributes for active li - default: `array('class' => 'active')`
* `a_active_params` - array, attributes for active li > a - default: `array()`
* `span_active_params` - array, attributes for active li > a > span - default: `array()`
* `li_divider_params` - array, attributes for divider li - default: `array('class' => 'divider')`
* `span_divider_params` - array, attributes for divider li > span - default: `array()`
* `lang_next` - string, button next text, default: `Next`
* `lang_prev` - string, button prev text, default: `Prev`
* `lang_first` - string, button first text, default: `&laquo;`
* `lang_last` - string, button last text, default: `&raquo;`
* `lang_divider` - string, divider text, default: `...`