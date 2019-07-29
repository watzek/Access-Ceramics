<?php
	//maybe more understandable to make this a class
	const DEFAULT_CATEGORY = 'artists';
	const DEFAULT_LIM = 20;
	const MAX_QUERY_LIM = 10000;
	const DEFAULT_OFFSET = 0;
	const DEFAULT_VIEW = 'comfort';
	const DEFAULT_ORDER = '';
	const DEFAULT_STATE ='main';

	const CATEGORY_NAMES =
	[
		'artists',
		'institutions',
		'glazings',
		'materials',
		'objects',
		'techniques',
		'temperatures',
		''
	];

	const STYLE_PACKS =
	[
		[
			'comfortable' => '/css/comfortable.css',
			'grid' => '/css/pane.css',
			'list' => '/css/list.css',
			'default' => 'comfortable'
		],
		[
			'grid' => '/css/category.css',
			'default' => 'grid'
		]
	];
?>
