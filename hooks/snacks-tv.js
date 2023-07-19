Object.defineProperty(String.prototype, 'capitalize', {
  value: function() {
    return this.charAt(0).toUpperCase() + this.slice(1);
  },
  enumerable: false
});
jQuery.fn.fadeOutAndRemove = function(speed){
    $(this).fadeOut(speed,function(){
        $(this).remove();
    })
}
function debounce(fn, delay) {
  var timer = null;
  return function () {
    var context = this, args = arguments;
    clearTimeout(timer);
    timer = setTimeout(function () {
      fn.apply(context, args);
    }, delay);
  };
}

$j(function() {

	$j('#top_buttons,table.table.table-striped.table-bordered.table-hover,.pagination-section,.page-header').remove();
	$j('.table-responsive').removeClass('table-responsive').addClass('cards-container').addClass('container');
	$j('input[id^="filter"]').attr('data-slider-handle',"custom");
	$j('[data-tablename="snacks"]').hide();
	$j('[name="myform"] .row:first').before(txt);
	$j('.table-snacks').prepend(cardpage);
	$j('.table-snacks').append(cardpage);
  // Create object to store filter for each group
	var buttonFilters = {};
	var buttonFilter = '*';

	var stepsSlidercalories = document.getElementById("steps-slider-calories");
	var stepsSliderfat = document.getElementById("steps-slider-fat");
	var stepsSlidercarbs = document.getElementById("steps-slider-carbs");
	var stepsSliderprotein = document.getElementById("steps-slider-protein");
	var stepsSliderfiber = document.getElementById("steps-slider-fiber");
	var stepsSlidersodium = document.getElementById("steps-slider-sodium");
	var stepsSliderrating = document.getElementById("steps-slider-rating");
	const inputscalories = [];
	inputscalories[0]=document.getElementById("input-calories-min");
	inputscalories[1]=document.getElementById("input-calories-max");
	const inputsfat = [];
	inputsfat[0]=document.getElementById("input-fat-min");
	inputsfat[1]=document.getElementById("input-fat-max");
	const inputscarbs = [];
	inputscarbs[0]=document.getElementById("input-carbs-min");
	inputscarbs[1]=document.getElementById("input-carbs-max");
	const inputsprotein = [];
	inputsprotein[0]=document.getElementById("input-protein-min");
	inputsprotein[1]=document.getElementById("input-protein-max");
	const inputsfiber = [];
	inputsfiber[0]=document.getElementById("input-fiber-min");
	inputsfiber[1]=document.getElementById("input-fiber-max");
	const inputssodium = [];
	inputssodium[0]=document.getElementById("input-sodium-min");
	inputssodium[1]=document.getElementById("input-sodium-max");
	const inputsrating = [];
	inputsrating[0]=document.getElementById("input-rating-min");
	inputsrating[1]=document.getElementById("input-rating-max");

	noUiSlider.create(stepsSlidercalories, {
		start: [parseInt(calories_min), parseInt(calories_max)],
		connect: true,
		step: 1,
		range: {
			"min": parseInt(calories_min),
			"max": parseInt(calories_max)
		},
		format: wNumb({
			decimals: 0
		})
	});
	noUiSlider.create(stepsSliderfat, {
		start: [parseInt(fat_min), parseInt(fat_max)],
		connect: true,
		step: 0.1,
		range: {
			"min": parseInt(fat_min),
			"max": parseInt(fat_max)
		},
		format: wNumb({
			decimals: 0
		})
	});
	noUiSlider.create(stepsSlidercarbs, {
		start: [parseInt(carbs_min), parseInt(carbs_max)],
		// behaviour: 'drag-tap',
		connect: [false,true,false],
		step: 1,
		range: {
			"min": parseInt(carbs_min),
			"max": parseInt(carbs_max)
		},
		format: wNumb({
			decimals: 0
		})
	});
	noUiSlider.create(stepsSliderprotein, {
		start: [parseInt(protein_min), parseInt(protein_max)],
		connect: true,
		step: 1,
		range: {
			"min": parseInt(protein_min),
			"max": parseInt(protein_max)
		},
		format: wNumb({
			decimals: 0
		})
	});
	noUiSlider.create(stepsSliderfiber, {
		start: [parseInt(fiber_min), parseInt(fiber_max)],
		connect: true,
		range: {
			"min": parseInt(fiber_min),
			"max": parseInt(fiber_max)
		},
		format: wNumb({
			decimals: 0
		})
	});
	noUiSlider.create(stepsSlidersodium, {
		start: [parseInt(sodium_min), parseInt(sodium_max)],
		connect: true,
		step: 1,
		range: {
			"min": parseInt(sodium_min),
			"max": parseInt(sodium_max)
		},
		format: wNumb({
			decimals: 0
		})
	});
	noUiSlider.create(stepsSliderrating, {
		start: [parseInt(rating_min), parseInt(rating_max)],
		connect: true,
		step: 1,
		range: {
			"min": parseInt(rating_min),
			"max": parseInt(rating_max)
		},
		format: wNumb({
			decimals: 0
		})
	});
	stepsSlidercalories.noUiSlider.on("update", function (values, handle) {
		inputscalories[handle].value = values[handle];
	});
	stepsSliderfat.noUiSlider.on("update", function (values, handle) {
		inputsfat[handle].value = values[handle];
	});
	stepsSlidercarbs.noUiSlider.on("update", function (values, handle) {
		inputscarbs[handle].value = values[handle];
	});
	stepsSliderprotein.noUiSlider.on("update", function (values, handle) {
		inputsprotein[handle].value = values[handle];
	});
	stepsSliderfiber.noUiSlider.on("update", function (values, handle) {
		inputsfiber[handle].value = values[handle];
	});
	stepsSlidersodium.noUiSlider.on("update", function (values, handle) {
		inputssodium[handle].value = values[handle];
	});
	stepsSliderrating.noUiSlider.on("update", function (values, handle) {
		inputsrating[handle].value = values[handle];
	});

	stepsSlidercalories.noUiSlider.on("set", function (values, handle, unencoded, tap, positions, noUiSlider) { ajax_request();})
	stepsSliderfat.noUiSlider.on("set", function (values, handle, unencoded, tap, positions, noUiSlider) { ajax_request();})
	stepsSlidercarbs.noUiSlider.on("set", function (values, handle, unencoded, tap, positions, noUiSlider) { ajax_request();})
	stepsSliderprotein.noUiSlider.on("set", function (values, handle, unencoded, tap, positions, noUiSlider) { ajax_request();})
	stepsSliderfiber.noUiSlider.on("set", function (values, handle, unencoded, tap, positions, noUiSlider) { ajax_request();})
	stepsSlidersodium.noUiSlider.on("set", function (values, handle, unencoded, tap, positions, noUiSlider) { ajax_request();})
	stepsSliderrating.noUiSlider.on("set", function (values, handle, unencoded, tap, positions, noUiSlider) { ajax_request();})

	inputscalories.forEach(function (input, handle) {
		input.addEventListener("change", function () {
			stepsSlidercalories.noUiSlider.setHandle(handle, this.value);
			ajax_request();
		});
		input.addEventListener("keydown", function (e) {

			var values = stepsSlidercalories.noUiSlider.get();
			var value = Number(values[handle]);
			// [[handle0_down, handle0_up], [handle1_down, handle1_up]]
			var steps = stepsSlidercalories.noUiSlider.steps();
			// [down, up]
			var step = steps[handle];
			var position;
			// 13 is enter,
			// 38 is key up,
			// 40 is key down.
			switch (e.which) {
				case 13:
					stepsSlidercalories.noUiSlider.setHandle(handle, this.value);
					break;
				case 38:
					// Get step to go increase slider value (up)
					position = step[1];
					// false = no step is set
					if (position === false) {
						position = 1;
					}
					// null = edge of slider
					if (position !== null) {
						stepsSlidercalories.noUiSlider.setHandle(handle, value + position);
					}
					break;
				case 40:
					position = step[0];
					if (position === false) {
						position = 1;
					}
					if (position !== null) {
						stepsSlidercalories.noUiSlider.setHandle(handle, value - position);
					}
					break;
			}
			ajax_request();
		});
	});
	inputsfat.forEach(function (input, handle) {
		input.addEventListener("change", function () {
			stepsSliderfat.noUiSlider.setHandle(handle, this.value);
			ajax_request();
		});
		input.addEventListener("keydown", function (e) {
			var values = stepsSliderfat.noUiSlider.get();
			var value = Number(values[handle]);
			// [[handle0_down, handle0_up], [handle1_down, handle1_up]]
			var steps = stepsSliderfat.noUiSlider.steps();
			// [down, up]
			var step = steps[handle];
			var position;
			// 13 is enter,
			// 38 is key up,
			// 40 is key down.
			switch (e.which) {
				case 13:
					stepsSliderfat.noUiSlider.setHandle(handle, this.value);
					break;
				case 38:
					// Get step to go increase slider value (up)
					position = step[1];
					// false = no step is set
					if (position === false) {
						position = 1;
					}
					// null = edge of slider
					if (position !== null) {
						stepsSliderfat.noUiSlider.setHandle(handle, value + position);
					}
					break;
				case 40:
					position = step[0];
					if (position === false) {
						position = 1;
					}
					if (position !== null) {
						stepsSliderfat.noUiSlider.setHandle(handle, value - position);
					}
					break;
			}
		});
	});
	inputscarbs.forEach(function (input, handle) {
		input.addEventListener("change", function () {
			stepsSlidercarbs.noUiSlider.setHandle(handle, this.value);
			ajax_request();
		});
		input.addEventListener("keydown", function (e) {
			var values = stepsSlidercarbs.noUiSlider.get();
			var value = Number(values[handle]);
			// [[handle0_down, handle0_up], [handle1_down, handle1_up]]
			var steps = stepsSlidercarbs.noUiSlider.steps();
			// [down, up]
			var step = steps[handle];
			var position;
			// 13 is enter,
			// 38 is key up,
			// 40 is key down.
			switch (e.which) {
				case 13:
					stepsSlidercarbs.noUiSlider.setHandle(handle, this.value);
					break;
				case 38:
					// Get step to go increase slider value (up)
					position = step[1];
					// false = no step is set
					if (position === false) {
						position = 1;
					}
					// null = edge of slider
					if (position !== null) {
						stepsSlidercarbs.noUiSlider.setHandle(handle, value + position);
					}
					break;
				case 40:
					position = step[0];
					if (position === false) {
						position = 1;
					}
					if (position !== null) {
						stepsSlidercarbs.noUiSlider.setHandle(handle, value - position);
					}
					break;
			}
		});
	});
	inputsprotein.forEach(function (input, handle) {
		input.addEventListener("change", function () {
			stepsSliderprotein.noUiSlider.setHandle(handle, this.value);
			ajax_request();
		});
		input.addEventListener("keydown", function (e) {
			var values = stepsSliderprotein.noUiSlider.get();
			var value = Number(values[handle]);
			// [[handle0_down, handle0_up], [handle1_down, handle1_up]]
			var steps = stepsSliderprotein.noUiSlider.steps();
			// [down, up]
			var step = steps[handle];
			var position;
			// 13 is enter,
			// 38 is key up,
			// 40 is key down.
			switch (e.which) {
				case 13:
					stepsSliderprotein.noUiSlider.setHandle(handle, this.value);
					break;
				case 38:
					// Get step to go increase slider value (up)
					position = step[1];
					// false = no step is set
					if (position === false) {
						position = 1;
					}
					// null = edge of slider
					if (position !== null) {
						stepsSliderprotein.noUiSlider.setHandle(handle, value + position);
					}
					break;
				case 40:
					position = step[0];
					if (position === false) {
						position = 1;
					}
					if (position !== null) {
						stepsSliderprotein.noUiSlider.setHandle(handle, value - position);
					}
					break;
			}
		});
	});
	inputsfiber.forEach(function (input, handle) {
		input.addEventListener("change", function () {
			stepsSliderfiber.noUiSlider.setHandle(handle, this.value);
			ajax_request();
		});
		input.addEventListener("keydown", function (e) {
			var values = stepsSliderfiber.noUiSlider.get();
			var value = Number(values[handle]);
			// [[handle0_down, handle0_up], [handle1_down, handle1_up]]
			var steps = stepsSliderfiber.noUiSlider.steps();
			// [down, up]
			var step = steps[handle];
			var position;
			// 13 is enter,
			// 38 is key up,
			// 40 is key down.
			switch (e.which) {
				case 13:
					stepsSliderfiber.noUiSlider.setHandle(handle, this.value);
					break;
				case 38:
					// Get step to go increase slider value (up)
					position = step[1];
					// false = no step is set
					if (position === false) {
						position = 1;
					}
					// null = edge of slider
					if (position !== null) {
						stepsSliderfiber.noUiSlider.setHandle(handle, value + position);
					}
					break;
				case 40:
					position = step[0];
					if (position === false) {
						position = 1;
					}
					if (position !== null) {
						stepsSliderfiber.noUiSlider.setHandle(handle, value - position);
					}
					break;
			}
		});
	});
	inputssodium.forEach(function (input, handle) {
		input.addEventListener("change", function () {
			stepsSlidersodium.noUiSlider.setHandle(handle, this.value);
			ajax_request();
		});
		input.addEventListener("keydown", function (e) {
			var values = stepsSlidersodium.noUiSlider.get();
			var value = Number(values[handle]);
			// [[handle0_down, handle0_up], [handle1_down, handle1_up]]
			var steps = stepsSlidersodium.noUiSlider.steps();
			// [down, up]
			var step = steps[handle];
			var position;
			// 13 is enter,
			// 38 is key up,
			// 40 is key down.
			switch (e.which) {
				case 13:
					stepsSlidersodium.noUiSlider.setHandle(handle, this.value);
					break;
				case 38:
					// Get step to go increase slider value (up)
					position = step[1];
					// false = no step is set
					if (position === false) {
						position = 1;
					}
					// null = edge of slider
					if (position !== null) {
						stepsSlidersodium.noUiSlider.setHandle(handle, value + position);
					}
					break;
				case 40:
					position = step[0];
					if (position === false) {
						position = 1;
					}
					if (position !== null) {
						stepsSlidersodium.noUiSlider.setHandle(handle, value - position);
					}
					break;
			}
		});
	});
	inputsrating.forEach(function (input, handle) {
		input.addEventListener("change", function () {
			stepsSliderrating.noUiSlider.setHandle(handle, this.value);
			ajax_request();
		});
		input.addEventListener("keydown", function (e) {
			var values = stepsSliderrating.noUiSlider.get();
			var value = Number(values[handle]);
			// [[handle0_down, handle0_up], [handle1_down, handle1_up]]
			var steps = stepsSliderrating.noUiSlider.steps();
			// [down, up]
			var step = steps[handle];
			var position;
			// 13 is enter,
			// 38 is key up,
			// 40 is key down.
			switch (e.which) {
				case 13:
					stepsSliderrating.noUiSlider.setHandle(handle, this.value);
					break;
				case 38:
					// Get step to go increase slider value (up)
					position = step[1];
					// false = no step is set
					if (position === false) {
						position = 1;
					}
					// null = edge of slider
					if (position !== null) {
						stepsSliderrating.noUiSlider.setHandle(handle, value + position);
					}
					break;
				case 40:
					position = step[0];
					if (position === false) {
						position = 1;
					}
					if (position !== null) {
						stepsSliderrating.noUiSlider.setHandle(handle, value - position);
					}
					break;
			}
		});
	});

	function updateRangeSlider(slider, slideEvt) {
    console.log('Current slider:' + slider);
    var sldmin = +slideEvt.value[0],
        sldmax = +slideEvt.value[1],
        // Find which filter group this slider is in (in this case it will be either height or weight)
        // This can be changed by modifying the data-filter-group="age" attribute on the slider HTML
        filterGroup = slider.attr('data-filter-group'),
        // Set current selection in variable that can be pass to the label
        currentSelection = sldmin + ' - ' + sldmax;

      // Update filter label with new range selection
      slider.siblings('.filter-label').find('.filter-selection').text(currentSelection);

      // Set min and max values for current selection to current selection
      // If no values are found set min to 0 and max to 100000
      // Store min/max values in rangeFilters array in the relevant filter group
      // E.g. rangeFilters['height'].min and rangeFilters['height'].max
      console.log('Filtergroup: '+ filterGroup);
      rangeFilters[filterGroup] = {
        min: sldmin || 0,
        max: sldmax || 100000
      };
	  console.log("type : "+slideEvt['type']);
      // Trigger isotope again to refresh layout
    if (slideEvt['type'] ==  'slideStop') {  
		ajax_request()
	}
  }
	function ajax_request() {
	  		var ids=[];
		$j('.card').each(function() {ids.push($j(this).attr('data-id'))})
		$j.ajax({
		url: 'hooks/get_filtered_data.php',
		data: { SearchString: $j('#SearchString').val(), 
				brand: $j('#brand').val(), 
				category: $j('#category').val(), 
				flavor: $j('#flavor').val(), 
				item: $j('#item').val(), 
				filter_calories: stepsSlidercalories.noUiSlider.get().join(','), 
				filter_fat: stepsSliderfat.noUiSlider.get().join(','), 
				filter_carbs: stepsSlidercarbs.noUiSlider.get().join(','), 
				filter_protein: stepsSliderprotein.noUiSlider.get().join(','), 
				filter_fiber: stepsSliderfiber.noUiSlider.get().join(','), 
				filter_sodium: stepsSlidersodium.noUiSlider.get().join(','), 
				filter_rating: stepsSliderrating.noUiSlider.get().join(','), 
				FirstRecord: $j('[name="FirstRecord"').val(), 
				pagination: $j('[name="pagination"').val(), 
				search: $j('[name="search"').val(), 
				filter_calories_sort: $j('[name="filter_calories_sort"').val(), 
				filter_fat_sort: $j('[name="filter_fat_sort"').val(), 
				filter_carbs_sort: $j('[name="filter_calories_sort"').val(), 
				filter_calories_sort: $j('[name="filter_carbs_sort"').val(), 
				filter_protein_sort: $j('[name="filter_protein_sort"').val(), 
				filter_fiber_sort: $j('[name="filter_fiber_sort"').val(), 
				filter_sodium_sort: $j('[name="filter_sodium_sort"').val(), 
				filter_rating_sort: $j('[name="filter_rating_sort"').val(), 
				filter_favorites: $j('#myfavorites').is(":checked") ? 1 : 0, 
				sorter: $j('[name="sorter"').val(), 
				ids: ids, 
				csrf_token: $j('#csrf_token').val()
			  },
		success: function(resp) {
			try{
				
				var list = JSON.parse(resp);
				
				var end=0;
				// handle pagination request
				if ($j('#pagination').val() != '') {  // forward
					var till=parseInt($j('[name="FirstRecord"').val()-1)+parseInt(list[3])+(parseInt($j('#pagination').val())*parseInt(list[3]))
					if (till >= parseInt(list[2])) {
						var untill=parseInt(list[2]);
						end=1;
					}
					else var untill = till;
					$j('.cards-pageNumber').text(list[4]+' - '+untill+' / '+list[2]);
					$j('[name="FirstRecord"').val(list[4]);
					if ($j('#pagination').val()=='1') { // forward
						$j('.at-pagination-button.cards-page-button-disabled.backward').removeClass('cards-page-button-disabled');
					}
					else if ($j('#pagination').val()=='-1') {  // backward
						$j('.at-pagination-button.cards-page-button-disabled.forward').removeClass('cards-page-button-disabled');
						if (list[4] == '1') {
							$j('.at-pagination-button.backward').addClass('cards-page-button-disabled');
						}
						
					}
					if (end) {
						$j('.at-pagination-button.forward').addClass('cards-page-button-disabled');
					}
					$j('#pagination').val('');
				}
				else {
					if (list[1] == null) list[4]=0; 
					if (list[2] <= list[3]) {
						$j('.cards-pageNumber').text(list[4]+' - '+list[2]+' / '+list[2]);
						$j('.at-pagination-button.backward, .at-pagination-button.forward' ).addClass('cards-page-button-disabled');
					}
					else {
						$j('.cards-pageNumber').text(list[4]+' - '+list[3]+' / '+list[2]);
						$j('.at-pagination-button.backward' ).addClass('cards-page-button-disabled');
						$j('.at-pagination-button.forward' ).removeClass('cards-page-button-disabled');
					}
				}
				// $j('.i_card-content').remove();
				// $j('.i_card-content').fadeOutAndRemove('fast');
				$j('.i_card-content').remove();
				if (list[1]!==null) {
					elem=list[1].replace(/[\r\n\t]/g,'');
					$j('.cards-container').append(elem);
					// $grid.isotope( 'appended', elem );
					 
				}
				else {}
				// $j('.i_card-content:hidden').remove();
				// $j('.i_card-content:hidden').fadeOutAndRemove('fast');
				// $grid.isotope('reloadItems');
				// $grid.isotope();
				var entry=['brand', 'category', 'flavor', 'item'];
				for (i=0;i<4;i++) {
					if (list[5][i].length != 0) {
						$j('#'+entry[i]).select2({
							placeholder: entry[i].capitalize(),
							data: JSON.parse(list[5][i]),
							multiple: true
						});
					}
				}

			}catch(e) {
				console.log("filter-error try");
			}
			draw_stars();
			style_entries();
		}
	});
  }

	$j('.at-pagination-button:not("cards-page-button-disabled")').on('click', function(pagination) {
	 if ($j(this).hasClass('cards-page-button-disabled')) return;
	 if ($j(this).hasClass('forward')) {
		 $j('#pagination').val('1');
	 }
	 else {
		 $j('#pagination').val('-1')
	 }
	ajax_request();
  })

	$j('#brand,#category,#flavor,#item').on('change',function(e) { 
	console.log($j(this).val());
	if (typeof e.removed != 'undefined') {
		if ($j(this).val().includes(e.removed.id.trim())) {
			if ($j(this).val().includes(',')) {
				arr=$j(this).val().split(',');
				for(  i = 0; i < arr.length; i++){ 
					if ( arr[i] === e.removed.id.trim()) { 
						arr.splice(i, 1); 
					}
				}
				$j(this).val(arr.join(','));
			}
			else {
				$j(this).val('');
			}
		}
	}
	ajax_request();
  });
  
	$j('#search').on('keyup', debounce(function(e) {
		$j('[name="FirstRecord"]').val(1);
		ajax_request(); 
	},400));
	$j('.sort-by-asc').on('click',function(e) {
		if ($j(this).hasClass('sort-activ-asc')) {
			$j(this).removeClass('sort-activ-asc');
			$j('.sort-by-asc').parent().find('i').css('visibility','');
			$j("[name=sorter]").val('');			
		}
		else {
			$j(this).addClass('sort-activ-asc');
			$j('.sort-by-asc').not(this).parent().find('i').css('visibility','hidden');
			$j(this).parent().find('.sort-by-desc').removeClass('sort-activ-desc');
			$j("[name=sorter]").val($j(this).attr('sort')+' asc');
			ajax_request();		
		}
 	
	})
	$j('.sort-by-desc').on('click',function(e) {
		if ($j(this).hasClass('sort-activ-desc')) {
			$j(this).removeClass('sort-activ-desc');
			$j('.sort-by-desc').parent().find('i').css('visibility','');
			$j("[name=sorter]").val('');						
		}
		else {
			$j(this).addClass('sort-activ-desc');
			$j('.sort-by-desc').not(this).parent().find('i').css('visibility','hidden');			
			$j(this).parent().find('.sort-by-asc').removeClass('sort-activ-asc');									
			$j("[name=sorter]").val($j(this).attr('sort')+' desc');									
			ajax_request();		
		}
	})

    $j( "#loadingDiv" ).fadeOut(500, function() {
      // fadeOut complete. Remove the loading div
		$j("#loadingDiv" ).remove(); //makes page more lightweight 
	})

	// Flatten object by concatting values
	function concatValues( obj ) {
	  var value = '';
	  for ( var prop in obj ) {
		value += obj[ prop ];
	  }
	  return value;
	}

	function draw_stars() {

	   $j('.toggle-heart[value="1"]').prop('checked',true);
	   $j('.tstarrating').each(function () {
			var id=$j(this).attr('data-id'); 
			const sx=$j(this).next('.startextcontainer').find('.StarText');
			var av=sx.attr('data-avg');
			var cn=sx.attr('data-count');
			if (ratingarr == null || typeof ratingarr[id] == 'undefined') {
				rt=0;
			}
			else {
				rt=ratingarr[id];
			}
			AdjustRatings(id, rt, av, cn);
	   })
	}
	
	draw_stars();
	style_entries();
	if (mi) {

		$j(document).on("change", '#myfavorites', function (e) {
			ajax_request();
		})
		$j(document).on("click", ".toggle-heart-ind", function () {
			const id=$j(this).parents('.i_card').attr('data-id');
			favorite = $j(this).is(":checked") ? 1:0;
			$j.ajax({
				url: 'hooks/set_favorite.php',
				data: { favorite: favorite, 
						id: id
				  },
				success: function(resp) {
					try{
						// no action needed

					}catch(e) {
						console.log("filter error");
					}
				}
			});
		});
		
		$j(document).on({
			mouseenter: function () {
				// if (!(ratingarr == null) && typeof ratingarr[$j(this).parent().attr('data-id')] != "undefined") return;
				$j(this).addClass("fullStarHover");
				$j(this).prevAll().addClass("fullStarHover");
				$j(this).nextAll().addClass("emptyStarHover");
			},
			mouseleave: function () {
				// if (!(ratingarr == null) && typeof ratingarr[$j(this).parent().attr('data-id')] != "undefined") return;
				$j(this).removeClass("fullStarHover");
				$j(this).prevAll().removeClass("fullStarHover");
				$j(this).nextAll().removeClass("emptyStarHover");
			}
		}, ".st");

		$j(document).on("click", ".st", function () {
			// if (!(ratingarr == null) && typeof ratingarr[$j(this).parent().attr('data-id')] != "undefined") return;
			const id=$j(this).parent().attr('data-id');

			AdjustMyStar(this);

			// // SET VALUES FOR PROCESSING
			// var securityToken = $j('input[name="__RequestVerificationToken"]').val();  // <-- OPTIONAL security token, WE USE FOR SECURITY PURPOSES
			// var key = getKeyP();
			// var type = $j("#profkey").attr("data-keytype");

			var rating = $j(this).attr("data-val");

			// }

			// CALL SERVER CONTROLLER/ACTION FOR PROCESSING 

			$j.ajax({
				url: 'hooks/set_rating.php',
				data: { rating: rating, 
						id: id
				  },
				success: function(resp) {
					try{
						
						var list = JSON.parse(resp);
						lid=parseInt(list.id);
						lrt=parseInt(list.myrating);
						lav=list.rating;
						lcn=parseInt(list.starcount);
						AdjustRatings(lid, lrt,lav, lcn);

						// add to ratingarr
						ratingarr[id]=rt;
						var end=0;


					}catch(e) {
						console.log("rating error");
					}
				}
			});

		});
	}
	else {
		$j('.MyStarText').css('visibility','hidden');
	}
	
	function style_entries() {
		if (mi) {
			$j('.favorites, .myfavorites').css('visibility','unset');
			$j('.StarText[data-avg!=""]').css('visibility','unset');				
		}
	}

	function StarVerbiage(id, ar, tr) {
		ar = parseFloat(ar).toFixed(1);
		// if (tr > 1) { $j("#StarText").text("Avg : " + ar + "  / " + tr + " ratings"); }
		if (tr >= 1) { 
			$j("#StarText-"+id).attr('data-avg',ar ).attr('data-count',tr ).text("Avg : "+ar+" / "+parseInt(tr)+" rating"+(tr > 1 ? "s" : "")).css('visibility','').fadeIn(300); 
		}
		else {
			$j("#StarText-"+id).css('visibility','hidden');
		}

	}
	function AdjustMyStar(e) {
		$j(e).removeClass("fullStar myfullStar emptyStar halfStar myhalfStar").addClass("myfullStar");
		$j(e).prevAll().removeClass("fullStar myfullStar emptyStar halfStar myhalfStar").addClass("myfullStar");
		$j(e).nextAll().removeClass("fullStar myfullStar emptyStar halfStar myhalfStar").addClass("emptyStar");
	}
	function AdjustStar(e) {
		$j(e).removeClass("fullStar myfullStar emptyStar halfStar myhalfStar").addClass("fullStar");
		$j(e).prevAll().removeClass("fullStar myfullStar emptyStar halfStar myhalfStar").addClass("fullStar");
		$j(e).nextAll().removeClass("fullStar myfullStar emptyStar halfStar myhalfStar").addClass("emptyStar");
	}
	function AdjustHalfStar(e) {
		$j(e).removeClass("fullStar myfullStar emptyStar halfStar myhalfStar").addClass("halfStar");
		$j(e).prevAll().removeClass("fullStar myfullStar emptyStar halfStar myhalfStar").addClass("fullStar");
		$j(e).nextAll().removeClass("fullStar myfullStar emptyStar halfStar myhalfStar").addClass("emptyStar");
	}
	function AdjustRatings(id, msr, ar, tr) {
		ar = parseFloat(ar).toFixed(1);
		if (msr == 1 || msr == 2 || msr == 3 || msr == 4 || msr == 5) {
			var x = "#st" + msr;
			var e = $j('#tStarRating-'+id+' '+x);
			AdjustMyStar(e);
			StarVerbiage(id, ar, tr);
			$j('#MyStarText-'+id).text("Your Rating: "+msr).fadeIn(300);
		}
		else if (ar > 0 && tr > 0) {
			var hs = false;  // is there a half star?
			if (ar > 0 && ar < 1.25) { var e = $j("#tStarRating-"+id+" #st1"); }
			else if (ar >= 1.75 && ar < 2.25) { var e = $j("#tStarRating-"+id+" #st2"); }
			else if (ar >= 2.75 && ar < 3.25) { var e = $j("#tStarRating-"+id+" #st3"); }
			else if (ar >= 3.75 && ar < 4.25) { var e = $j("#tStarRating-"+id+" #st4"); }
			else if (ar >= 4.75) { var e = $j("#tStarRating-"+id+" #st5"); }

			else if (ar >= 1.25 && ar < 1.75) { hs = true; var e = $j("#tStarRating-"+id+" #st2"); }
			else if (ar >= 2.25 && ar < 2.75) { hs = true; var e = $j("#tStarRating-"+id+" #st3"); }
			else if (ar >= 3.25 && ar < 3.75) { hs = true; var e = $j("#tStarRating-"+id+" #st4"); }
			else if (ar >= 4.25 && ar < 4.75) { hs = true; var e = $j("#tStarRating-"+id+" #st5"); }
			if (hs) {
				AdjustHalfStar(e);
			}
			else {
				AdjustStar(e);
			}
			StarVerbiage(id, ar, tr);
			$j('#MyStarText-'+id).text("Your Rating: "+msr).fadeIn(300);
		}
		else {
		   $j('#MyStarText-'+id).text("Be first to Rate this!").fadeIn(300);
		}
	}	

});  
