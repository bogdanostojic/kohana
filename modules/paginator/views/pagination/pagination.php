<?php
if ($paginator->get('count_pages') > 1) {
	echo $paginator->view_block('open');
	
	echo $paginator->view_list_item($paginator->view_first());
	echo $paginator->view_list_item($paginator->view_prev());

	echo $paginator->view_switches();

	echo $paginator->view_list_item($paginator->view_next());
	echo $paginator->view_list_item($paginator->view_last());

	echo $paginator->view_block('close');
}
?>