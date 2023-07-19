<?php
// This script and data application were generated by AppGini 22.14
// Download AppGini for free from https://bigprof.com/appgini/download/

	include_once(__DIR__ . '/lib.php');
	@include_once(__DIR__ . '/hooks/favorites.php');
	include_once(__DIR__ . '/favorites_dml.php');

	// mm: can the current member access this page?
	$perm = getTablePermissions('favorites');
	if(!$perm['access']) {
		echo error_message($Translation['tableAccessDenied']);
		exit;
	}

	$x = new DataList;
	$x->TableName = 'favorites';

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = [
		"`favorites`.`id`" => "id",
		"`favorites`.`member`" => "member",
		"`favorites`.`snackid`" => "snackid",
	];
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = [
		1 => '`favorites`.`id`',
		2 => 2,
		3 => 3,
	];

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = [
		"`favorites`.`id`" => "id",
		"`favorites`.`member`" => "member",
		"`favorites`.`snackid`" => "snackid",
	];
	// Fields that can be filtered
	$x->QueryFieldsFilters = [
		"`favorites`.`id`" => "ID",
		"`favorites`.`member`" => "Member",
		"`favorites`.`snackid`" => "Snacks",
	];

	// Fields that can be quick searched
	$x->QueryFieldsQS = [
		"`favorites`.`id`" => "id",
		"`favorites`.`member`" => "member",
		"`favorites`.`snackid`" => "snackid",
	];

	// Lookup fields that can be used as filterers
	$x->filterers = [];

	$x->QueryFrom = "`favorites` ";
	$x->QueryWhere = '';
	$x->QueryOrder = '';

	$x->AllowSelection = 1;
	$x->HideTableView = ($perm['view'] == 0 ? 1 : 0);
	$x->AllowDelete = $perm['delete'];
	$x->AllowMassDelete = (getLoggedAdmin() !== false);
	$x->AllowInsert = $perm['insert'];
	$x->AllowUpdate = $perm['edit'];
	$x->SeparateDV = 1;
	$x->AllowDeleteOfParents = 0;
	$x->AllowFilters = 1;
	$x->AllowSavingFilters = (getLoggedAdmin() !== false);
	$x->AllowSorting = 1;
	$x->AllowNavigation = 1;
	$x->AllowPrinting = 1;
	$x->AllowPrintingDV = 1;
	$x->AllowCSV = 1;
	$x->RecordsPerPage = 10;
	$x->QuickSearch = 1;
	$x->QuickSearchText = $Translation['quick search'];
	$x->ScriptFileName = 'favorites_view.php';
	$x->RedirectAfterInsert = 'favorites_view.php?SelectedID=#ID#';
	$x->TableTitle = 'Favorites';
	$x->TableIcon = 'table.gif';
	$x->PrimaryKey = '`favorites`.`id`';

	$x->ColWidth = [150, 150, ];
	$x->ColCaption = ['Member', 'Snacks', ];
	$x->ColFieldName = ['member', 'snackid', ];
	$x->ColNumber  = [2, 3, ];

	// template paths below are based on the app main directory
	$x->Template = 'templates/favorites_templateTV.html';
	$x->SelectedTemplate = 'templates/favorites_templateTVS.html';
	$x->TemplateDV = 'templates/favorites_templateDV.html';
	$x->TemplateDVP = 'templates/favorites_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HasCalculatedFields = false;
	$x->AllowConsoleLog = false;
	$x->AllowDVNavigation = true;

	// hook: favorites_init
	$render = true;
	if(function_exists('favorites_init')) {
		$args = [];
		$render = favorites_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: favorites_header
	$headerCode = '';
	if(function_exists('favorites_header')) {
		$args = [];
		$headerCode = favorites_header($x->ContentType, getMemberInfo(), $args);
	}

	if(!$headerCode) {
		include_once(__DIR__ . '/header.php'); 
	} else {
		ob_start();
		include_once(__DIR__ . '/header.php');
		echo str_replace('<%%HEADER%%>', ob_get_clean(), $headerCode);
	}

	echo $x->HTML;

	// hook: favorites_footer
	$footerCode = '';
	if(function_exists('favorites_footer')) {
		$args = [];
		$footerCode = favorites_footer($x->ContentType, getMemberInfo(), $args);
	}

	if(!$footerCode) {
		include_once(__DIR__ . '/footer.php'); 
	} else {
		ob_start();
		include_once(__DIR__ . '/footer.php');
		echo str_replace('<%%FOOTER%%>', ob_get_clean(), $footerCode);
	}
