<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
	/**
	 * @file
	 * This file contains hook functions that get called when data operations are performed on 'snacks' table. 
	 * For example, when a new record is added, when a record is edited, when a record is deleted, … etc.
	*/

	/**
	 * Called before rendering the page. This is a very powerful hook that allows you to control all aspects of how the page is rendered.
	 * 
	 * @param $options
	 * (passed by reference) a DataList object that sets options for rendering the page.
	 * @see https://bigprof.com/appgini/help/working-with-generated-web-database-application/hooks/DataList
	 * 
	 * @param $memberInfo
	 * An array containing logged member's info.
	 * @see https://bigprof.com/appgini/help/working-with-generated-web-database-application/hooks/memberInfo
	 * 
	 * @param $args
	 * An empty array that is passed by reference. It's currently not used but is reserved for future uses.
	 * 
	 * @return
	 * True to render the page. False to cancel the operation (which could be useful for error handling to display 
	 * an error message to the user and stop displaying any data).
	*/

	function snacks_init(&$options, $memberInfo, &$args) {

		$options->Template="templates/snacks_templateTV_new.html";
		$options->QueryFrom="(SELECT `ID`, `brand`, `category`, `flavor`, `item`, `Illustration`, `serving_size`, `calories`, `fat`, `carbs`, `protein`, `fiber`, `sodium`, `am_link`, `name`, `rating`, `starcount`,
		(select count(1) from favorites f where f.member='{$memberInfo['username']}' and f.snackid=snacks.id) as favorite from snacks) snacks ";
		return TRUE;
	}

	/**
	 * Called before displaying page content. Can be used to return a customized header template for the table.
	 * 
	 * @param $contentType
	 * specifies the type of view that will be displayed. Takes one the following values: 
	 * 'tableview', 'detailview', 'tableview+detailview', 'print-tableview', 'print-detailview', 'filters'
	 * 
	 * @param $memberInfo
	 * An array containing logged member's info.
	 * @see https://bigprof.com/appgini/help/working-with-generated-web-database-application/hooks/memberInfo
	 * 
	 * @param $args
	 * An empty array that is passed by reference. It's currently not used but is reserved for future uses.
	 * 
	 * @return
	 * String containing the HTML header code. If empty, the default 'header.php' is used. If you want to include
	 * the default header besides your customized header, include the <%%HEADER%%> placeholder in the returned string.
	*/

	function snacks_header($contentType, $memberInfo, &$args) {
		$header='';

		switch($contentType) {
			case 'tableview':
				$sql="SET SESSION group_concat_max_len = 1000000";
				sql($sql,$eo);
				$sql="SELECT snackid, rating from ratings where member='{$memberInfo['username']}'";
				$res=sql($sql,$eo);
				while ($row=db_fetch_assoc($res)) {
					$rating[$row['snackid']]=$row['rating'];
				}
				$rating=json_encode($rating);
				$sql="SELECT count(1) from snacks";
				$maxitems=db_fetch_row(sql($sql,$eo));
				$sql="select GROUP_CONCAT(brand) from (SELECT DISTINCT concat('{id:\"',brand, '\",text: \"',brand ,' (',count(brand),')','\"}') as brand  from snacks GROUP by brand) a";
				$brand=db_fetch_row(sql($sql,$eo));
				$sql="select GROUP_CONCAT(category) from (SELECT DISTINCT concat('{id:\"',category, '\",text: \"',category ,' (',count(category),')','\"}') as category  from snacks GROUP by category) a";
				$category=db_fetch_row(sql($sql,$eo));
				$sql="select GROUP_CONCAT(flavor) from (SELECT DISTINCT concat('{id:\"',flavor, '\",text: \"',flavor ,' (',count(flavor),')','\"}') as flavor  from snacks GROUP by flavor) a";
				$flavor=db_fetch_row(sql($sql,$eo));
				$sql="select GROUP_CONCAT(item) from (SELECT DISTINCT concat('{id:\"',item, '\",text: \"',item ,' (',count(item),')','\"}') as item  from snacks GROUP by item) a";
				$item=db_fetch_row(sql($sql,$eo));
				$hooks_dir = dirname(__FILE__);
				$file="{$hooks_dir}/../snacks_view.php";
				$contents = file_get_contents($file);
				$pattern = "/RecordsPerPage = \d*/";
				preg_match($pattern, $contents, $matches);
				$displaycount=explode("= ",$matches[0])[1];	
				$disabledbutton	= $displaycount == $maxitems ? 'cards-page-button-disabled' : '';
				$sql="SELECT min(cast(calories as decimal(10,2))) as calories_min, max(cast(calories as decimal(10,2))) as calories_max,
 min(cast(fat as decimal(10,2))) as fat_min, max(cast(fat as decimal(10,2))) as fat_max,
 min(cast(carbs as decimal(10,2))) as carbs_min, max(cast(carbs as decimal(10,2))) as carbs_max,
 min(cast(protein as decimal(10,2))) as protein_min, max(cast(protein as decimal(10,2))) as protein_max,
 min(cast(fiber as decimal(10,2))) as fiber_min, max(cast(fiber as decimal(10,2))) as fiber_max,
 min(cast(sodium as decimal(10,2))) as sodium_min, max(cast(sodium as decimal(10,2))) as sodium_max
FROM `snacks`";
				$row=db_fetch_assoc(sql($sql,$eo));
				$mi=0;
				if ($memberInfo['username']!='guest') $mi=1;
				$header="<%%HEADER%%><style>
					html,body{background-color:#f5f6fa !important;}
					#dashboard{background-color:#f5f6fa !important; }
					body{
						overflow-y:scroll;height: 100%;
					}
					</style>
					<script>
					const mi={$mi};
					const calories_min={$row['calories_min']};
					const calories_max={$row['calories_max']};
					const fat_min={$row['fat_min']};
					const fat_max={$row['fat_max']};
					const carbs_min={$row['carbs_min']};
					const carbs_max={$row['carbs_max']};
					const protein_min={$row['protein_min']};
					const protein_max={$row['protein_max']};
					const fiber_min={$row['fiber_min']};
					const fiber_max={$row['fiber_max']};
					const sodium_min={$row['sodium_min']};
					const sodium_max={$row['sodium_max']};
					const rating_min=0;
					const rating_max=5;
					const brand_filter=[{$brand[0]}];
					const category_filter=[{$category[0]}];
					const flavor_filter=[{$flavor[0]}];
					const item_filter=[{$item[0]}];
					const ratingarr={$rating};
					const txt='    <section class=\"container\">\
    <div style=\"text-align:center;\" class=\"filters filter-section\">\
        <div class=\"row\">\
        <div class=\"sliders row\">\
			<div class=\"editable filter\">\
				<div class=\"textlabel\">Calories (kcal)<i sort=\"calories\" class=\"sort-by-asc\"></i><i sort=\"calories\" class=\"sort-by-desc\"></i></div>\
				<div id=\"steps-slider-calories\" class=\"opensans steps-slider noUi-target noUi-ltr noUi-horizontal noUi-txt-dir-ltr\"></div>\
				<div class=\"flex-container space-between\">\
					<input type=\"text\"  pattern=\"[0-9.]+\" id=\"input-calories-min\" class=\"input-min flex-item\">\
					<input type=\"text\"  pattern=\"[0-9.]+\" id=\"input-calories-max\" class=\"input-max flex-item\">\
				</div>\
			</div>\
			<div class=\"editable filter\">\
				<div class=\"textlabel\">Fat (g)<i sort=\"fat\" class=\"sort-by-asc\"></i><i sort=\"fat\" sort=\"sodium\" class=\"sort-by-desc\"></i></div>\
				<div id=\"steps-slider-fat\" class=\"opensans steps-slider noUi-target noUi-ltr noUi-horizontal noUi-txt-dir-ltr\"></div>\
				<div class=\"flex-container space-between\">\
					<input type=\"text\"  pattern=\"[0-9.]+\" id=\"input-fat-min\" class=\"input-min flex-item\">\
					<input type=\"text\"  pattern=\"[0-9.]+\" id=\"input-fat-max\" class=\"input-max flex-item\">\
				</div>\
			</div>\
			<div class=\"editable filter\">\
				<div class=\"textlabel\">Carbs (g)<i sort=\"carbs\" class=\"sort-by-asc\"></i><i sort=\"carbs\" class=\"sort-by-desc\"></i></div>\
				<div id=\"steps-slider-carbs\" class=\"opensans steps-slider noUi-target noUi-ltr noUi-horizontal noUi-txt-dir-ltr\"></div>\
				<div class=\"flex-container space-between\">\
					<input type=\"text\"  pattern=\"[0-9.]+\" id=\"input-carbs-min\" class=\"input-min flex-item\">\
					<input type=\"text\"  pattern=\"[0-9.]+\" id=\"input-carbs-max\" class=\"input-max flex-item\">\
				</div>\
			</div>\
			<div class=\"editable filter\">\
				<div class=\"textlabel\">Protein (g)<i sort=\"protein\" class=\"sort-by-asc\"></i><i sort=\"protein\" class=\"sort-by-desc\"></i></div>\
				<div id=\"steps-slider-protein\" class=\"opensans steps-slider noUi-target noUi-ltr noUi-horizontal noUi-txt-dir-ltr\"></div>\
				<div class=\"flex-container space-between\">\
					<input type=\"text\"  pattern=\"[0-9.]+\" id=\"input-protein-min\" class=\"input-min iflex-item\">\
					<input type=\"text\"  pattern=\"[0-9.]+\" id=\"input-protein-max\" class=\"input-max flex-item\">\
				</div>\
			</div>\
			<div class=\"editable filter\">\
				<div class=\"textlabel\">Fiber (g)<i sort=\"fiber\" class=\"sort-by-asc\"></i><i sort=\"fiber\" class=\"sort-by-desc\"></i></div>\
				<div id=\"steps-slider-fiber\" class=\"opensans steps-slider noUi-target noUi-ltr noUi-horizontal noUi-txt-dir-ltr\"></div>\
				<div class=\"flex-container space-between\">\
					<input type=\"text\"  pattern=\"[0-9.]+\" id=\"input-fiber-min\" class=\"input-min flex-item\">\
					<input type=\"text\"  pattern=\"[0-9.]+\" id=\"input-fiber-max\" class=\"input-max flex-item\">\
				</div>\
			</div>\
			<div class=\"editable filter\">\
				<div class=\"textlabel\">Sodium (mg)<i sort=\"sodium\" class=\"sort-by-asc\"></i><i sort=\"sodium\" class=\"sort-by-desc\"></i></div>\
				<div id=\"steps-slider-sodium\" class=\"opensans steps-slider noUi-target noUi-ltr noUi-horizontal noUi-txt-dir-ltr\"></div>\
				<div class=\"flex-container space-between\">\
					<input type=\"text\"  pattern=\"[0-9.]+\" id=\"input-sodium-min\" class=\"input-min flex-item\">\
					<input type=\"text\"  pattern=\"[0-9.]+\" id=\"input-sodium-max\" class=\"input-max lex-item\">\
				</div>\
			</div>\
			<div class=\"editable filter\">\
				<div class=\"textlabel\">Rating<i sort=\"rating\" class=\"sort-by-asc\"></i><i sort=\"rating\" class=\"sort-by-desc\"></i></div>\
				<div id=\"steps-slider-rating\" class=\"opensans steps-slider noUi-target noUi-ltr noUi-horizontal noUi-txt-dir-ltr\"></div>\
				<div class=\"flex-container space-between\">\
					<input type=\"text\"  pattern=\"[0-9.]+\" id=\"input-rating-min\" class=\"input-min flex-item\">\
					<input type=\"text\"  pattern=\"[0-9.]+\" id=\"input-rating-max\" class=\"input-max lex-item\">\
				</div>\
			</div>\
		</div>\
            <div class=\"filter\">\
                <span class=\"filter-label\">Brand:</span>\
                <span><input id=\"brand\" name=\"brand\" class=\"filter\"></span>\
            </div>\
            <div class=\"filter\">\
                <span class=\"filter-label\">Category:</span>\
                <span><input id=\"category\" name=\"category\" class=\"filter\"></span>\
            </div>\
            <div class=\"filter\">\
                <span class=\"filter-label\">Flavor:</span>\
                <span><input id=\"flavor\" name=\"flavor\" class=\"filter\"></span>\
            </div>\
            <div class=\"filter\">\
                <span class=\"filter-label\">Item:</span>\
                <span><input id=\"item\" name=\"item\" class=\"filter\"></span>\
            </div>\
            <div class=\"filter\">\
                <span class=\"filter-label\">Search:</span>\
                <span><input placeholder=\"Search\" id=\"search\" name=\"search\" class=\"filter\"></span>\
            </div>\
            <div class=\"filter\">\
                <span>\
					<div class=\"myfavorites\">\
						<input class=\"toggle-heart\"  id=\"myfavorites\" type=\"checkbox\" />\
						<label class=\"toggle-heart-label\" for=\"myfavorites\" aria-label=\"like\">My Favorites ❤</label>\
					</div>\
				</span>\
            </div>\
            <div class=\"filter\">\
                <span><button type=\"submit\" id=\"reset_filters\" name=\"reset_filters\" class=\"filter\"><i class=\"glyphicon glyphicon-remove\"></i> Reset all filters</span>\
            </div>\
        </div>\
		<input id=\"pagination\" name=\"pagination\" type=\"text\" style=\"display:none;\">\
		<input id=\"sorter\" name=\"sorter\" type=\"text\" style=\"display:none;\">\
		<input id=\"filter_calories_sort\" name=\"filter_calories_sort\" type=\"text\" style=\"display:none;\">\
		<input id=\"filter_fat_sort\" name=\"filter_fat_sort\" type=\"text\" style=\"display:none;\">\
		<input id=\"filter_carbs_sort\" name=\"filter_carbs_sort\" type=\"text\" style=\"display:none;\">\
		<input id=\"filter_protein_sort\" name=\"filter_protein_sort\" type=\"text\" style=\"display:none;\">\
		<input id=\"filter_fiber_sort\" name=\"filter_fiber_sort\" type=\"text\" style=\"display:none;\">\
		<input id=\"filter_sodium_sort\" name=\"filter_sodium_sort\" type=\"text\" style=\"display:none;\">\
		<input id=\"filter_rating_sort\" name=\"filter_rating_sort\" type=\"text\" style=\"display:none;\">\
';
  var rangeFilters = {
      'calories': {'min':{$row['calories_min']}, 'max': {$row['calories_max']}},
      'fat': {'min':{$row['fat_min']}, 'max': {$row['fat_max']}},
      'carbs': {'min':{$row['carbs_min']}, 'max': {$row['carbs_max']}},
      'protein': {'min':{$row['protein_min']}, 'max': {$row['protein_max']}},
      'fiber': {'min':{$row['fiber_min']}, 'max': {$row['fiber_max']}},
      'sodium': {'min':{$row['sodium_min']}, 'max': {$row['sodium_max']}},
      'rating': {'min':0, 'max': 5}
    };
	const cardpage='<div class=\"cards-page\"><div class=\"cards-pageNumber\">1 - {$displaycount} / {$maxitems[0]}</div><div class=\"cards-page-button\">				 <div class=\"at-pagination-button cards-page-button-disabled backward\"><svg class=\"at-svg-icon\" viewBox=\"0 0 24 24\"><g><path d=\"M15.41 16.09l-4.58-4.59 4.58-4.59L14 5.5l-6 6 6 6z\"></path></g></svg></div>				 <div class=\"at-pagination-button {$disabledbutton} forward\"><svg class=\"at-svg-icon\" viewBox=\"0 0 24 24\"><g><path d=\"M8.59 16.34l4.58-4.59-4.58-4.59L10 5.75l6 6-6 6z\"></path></g></svg></div>			 </div></div>';
		\$j(function() {	
			\$j('#brand').select2({
				placeholder: 'Brand',
				data: brand_filter,
				multiple: true
			});
			\$j('#category').select2({
				placeholder: 'Category',
				data: category_filter,
				multiple: true
			});
			\$j('#flavor').select2({
				placeholder: 'Flavor',
				data: flavor_filter,
				multiple: true
			});
			\$j('#item').select2({
				placeholder: 'Item',
				data: item_filter,
				multiple: true
			});
		});
				</script>";
				break;

			case 'detailview':
				$header='';
				break;

			case 'tableview+detailview':
				$header='';
				break;

			case 'print-tableview':
				$header='';
				break;

			case 'print-detailview':
				$header='';
				break;

			case 'filters':
				$header='';
				break;
		}

		return $header;
	}

	/**
	 * Called after displaying page content. Can be used to return a customized footer template for the table.
	 * 
	 * @param $contentType
	 * specifies the type of view that will be displayed. Takes one the following values: 
	 * 'tableview', 'detailview', 'tableview+detailview', 'print-tableview', 'print-detailview', 'filters'
	 * 
	 * @param $memberInfo
	 * An array containing logged member's info.
	 * @see https://bigprof.com/appgini/help/working-with-generated-web-database-application/hooks/memberInfo
	 * 
	 * @param $args
	 * An empty array that is passed by reference. It's currently not used but is reserved for future uses.
	 * 
	 * @return
	 * String containing the HTML footer code. If empty, the default 'footer.php' is used. If you want to include 
	 * the default footer besides your customized footer, include the <%%FOOTER%%> placeholder in the returned string.
	*/

	function snacks_footer($contentType, $memberInfo, &$args) {
		$footer='';

		switch($contentType) {
			case 'tableview':
				$footer='';
				$footer='<%%FOOTER%%><script>
				$j(".table-responsive").removeClass("table-responsive").addClass("cards-container").css("height","100%");
				</script>';
				break;

			case 'detailview':
				$footer='';
				break;

			case 'tableview+detailview':
				$footer='';
				break;

			case 'print-tableview':
				$footer='';
				break;

			case 'print-detailview':
				$footer='';
				break;

			case 'filters':
				$footer='';
				break;
		}

		return $footer;
	}

	/**
	 * Called before executing the insert query.
	 * 
	 * @param $data
	 * An associative array where the keys are field names and the values are the field data values to be inserted into the new record.
	 * Note: if a field is set as read-only or hidden in detail view, it can't be modified through $data. You should use a direct SQL statement instead.
	 * For this table, the array items are: 
	 *     $data['brand'], $data['category'], $data['flavor'], $data['item'], $data['Illustration'], $data['serving_size'], $data['calories'], $data['fat'], $data['carbs'], $data['protein'], $data['fiber'], $data['sodium']
	 * $data array is passed by reference so that modifications to it apply to the insert query.
	 * 
	 * @param $memberInfo
	 * An array containing logged member's info.
	 * @see https://bigprof.com/appgini/help/working-with-generated-web-database-application/hooks/memberInfo
	 * 
	 * @param $args
	 * An empty array that is passed by reference. It's currently not used but is reserved for future uses.
	 * 
	 * @return
	 * A boolean TRUE to perform the insert operation, or FALSE to cancel it.
	*/

	function snacks_before_insert(&$data, $memberInfo, &$args) {

		return TRUE;
	}

	/**
	 * Called after executing the insert query (but before executing the ownership insert query).
	 * 
	 * @param $data
	 * An associative array where the keys are field names and the values are the field data values that were inserted into the new record.
	 * For this table, the array items are: 
	 *     $data['brand'], $data['category'], $data['flavor'], $data['item'], $data['Illustration'], $data['serving_size'], $data['calories'], $data['fat'], $data['carbs'], $data['protein'], $data['fiber'], $data['sodium']
	 * Also includes the item $data['selectedID'] which stores the value of the primary key for the new record.
	 * 
	 * @param $memberInfo
	 * An array containing logged member's info.
	 * @see https://bigprof.com/appgini/help/working-with-generated-web-database-application/hooks/memberInfo
	 * 
	 * @param $args
	 * An empty array that is passed by reference. It's currently not used but is reserved for future uses.
	 * 
	 * @return
	 * A boolean TRUE to perform the ownership insert operation or FALSE to cancel it.
	 * Warning: if a FALSE is returned, the new record will have no ownership info.
	*/

	function snacks_after_insert($data, $memberInfo, &$args) {

		return TRUE;
	}

	/**
	 * Called before executing the update query.
	 * 
	 * @param $data
	 * An associative array where the keys are field names and the values are the field data values.
	 * Note: if a field is set as read-only or hidden in detail view, it can't be modified through $data. You should use a direct SQL statement instead.
	 * For this table, the array items are: 
	 *     $data['ID'], $data['brand'], $data['category'], $data['flavor'], $data['item'], $data['Illustration'], $data['serving_size'], $data['calories'], $data['fat'], $data['carbs'], $data['protein'], $data['fiber'], $data['sodium']
	 * Also includes the item $data['selectedID'] which stores the value of the primary key for the record to be updated.
	 * $data array is passed by reference so that modifications to it apply to the update query.
	 * 
	 * @param $memberInfo
	 * An array containing logged member's info.
	 * @see https://bigprof.com/appgini/help/working-with-generated-web-database-application/hooks/memberInfo
	 * 
	 * @param $args
	 * An empty array that is passed by reference. It's currently not used but is reserved for future uses.
	 * 
	 * @return
	 * True to perform the update operation or false to cancel it.
	*/

	function snacks_before_update(&$data, $memberInfo, &$args) {

		return TRUE;
	}

	/**
	 * Called after executing the update query and before executing the ownership update query.
	 * 
	 * @param $data
	 * An associative array where the keys are field names and the values are the field data values.
	 * For this table, the array items are: 
	 *     $data['ID'], $data['brand'], $data['category'], $data['flavor'], $data['item'], $data['Illustration'], $data['serving_size'], $data['calories'], $data['fat'], $data['carbs'], $data['protein'], $data['fiber'], $data['sodium']
	 * Also includes the item $data['selectedID'] which stores the value of the primary key for the record.
	 * 
	 * @param $memberInfo
	 * An array containing logged member's info.
	 * @see https://bigprof.com/appgini/help/working-with-generated-web-database-application/hooks/memberInfo
	 * 
	 * @param $args
	 * An empty array that is passed by reference. It's currently not used but is reserved for future uses.
	 * 
	 * @return
	 * True to perform the ownership update operation or false to cancel it. 
	*/

	function snacks_after_update($data, $memberInfo, &$args) {

		return TRUE;
	}

	/**
	 * Called before deleting a record (and before performing child records check).
	 * 
	 * @param $selectedID
	 * The primary key value of the record to be deleted.
	 * 
	 * @param $skipChecks
	 * A flag passed by reference that determines whether child records check should be performed or not.
	 * If you set $skipChecks to TRUE, no child records check will be made. If you set it to FALSE, the check will be performed.
	 * 
	 * @param $memberInfo
	 * An array containing logged member's info.
	 * @see https://bigprof.com/appgini/help/working-with-generated-web-database-application/hooks/memberInfo
	 * 
	 * @param $args
	 * An empty array that is passed by reference. It's currently not used but is reserved for future uses.
	 * 
	 * @return
	 * True to perform the delete operation or false to cancel it.
	*/

	function snacks_before_delete($selectedID, &$skipChecks, $memberInfo, &$args) {

		return TRUE;
	}

	/**
	 * Called after deleting a record.
	 * 
	 * @param $selectedID
	 * The primary key value of the record to be deleted.
	 * 
	 * @param $memberInfo
	 * An array containing logged member's info.
	 * @see https://bigprof.com/appgini/help/working-with-generated-web-database-application/hooks/memberInfo
	 * 
	 * @param $args
	 * An empty array that is passed by reference. It's currently not used but is reserved for future uses.
	 * 
	 * @return
	 * None.
	*/

	function snacks_after_delete($selectedID, $memberInfo, &$args) {

	}

	/**
	 * Called when a user requests to view the detail view (before displaying the detail view).
	 * 
	 * @param $selectedID
	 * The primary key value of the record selected. False if no record is selected (i.e. the detail view will be 
	 * displayed to enter a new record).
	 * 
	 * @param $memberInfo
	 * An array containing logged member's info.
	 * @see https://bigprof.com/appgini/help/working-with-generated-web-database-application/hooks/memberInfo
	 * 
	 * @param $html
	 * (passed by reference) the HTML code of the form ready to be displayed. This could be useful for manipulating 
	 * the code before displaying it using regular expressions, … etc.
	 * 
	 * @param $args
	 * An empty array that is passed by reference. It's currently not used but is reserved for future uses.
	 * 
	 * @return
	 * None.
	*/

	function snacks_dv($selectedID, $memberInfo, &$html, &$args) {

	}

	/**
	 * Called when a user requests to download table data as a CSV file (by clicking on the SAVE CSV button)
	 * 
	 * @param $query
	 * Contains the query that will be executed to return the data in the CSV file.
	 * 
	 * @param $memberInfo
	 * An array containing logged member's info.
	 * @see https://bigprof.com/appgini/help/working-with-generated-web-database-application/hooks/memberInfo
	 * 
	 * @param $args
	 * An empty array. It's currently not used but is reserved for future uses.
	 * 
	 * @return
	 * A string containing the query to use for fetching the CSV data. If FALSE or empty is returned, the default query is used.
	*/

	function snacks_csv($query, $memberInfo, &$args) {

		return $query;
	}
	/**
	 * Called when displaying the table view to retrieve custom record actions
	 * 
	 * @return
	 * A 2D array describing custom record actions. The format of the array is:
	 *   [
	 *      [
	 *         'title' => 'Title', // the title/label of the custom action as displayed to users
	 *         'function' => 'js_function_name', // the name of a javascript function to be executed when user selects this action
	 *         'class' => 'CSS class(es) to apply to the action title', // optional, refer to Bootstrap documentation for CSS classes
	 *         'icon' => 'icon name' // optional, refer to Bootstrap glyphicons for supported names
	 *      ], ...
	 *   ]
	*/

	function snacks_batch_actions(&$args) {

		return [];
	}
