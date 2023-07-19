<?php

$filename="header.php";
$dir=dirname(__FILE__)."/../";
$filecontent=file_get_contents($dir.$filename);
if (strpos($filecontent,"PATCH prototype") == 0) {
	$search='<script src="<?php echo PREPEND_PATH; ?>resources/lightbox/js/prototype.js"></script>';
	$replace='<!--  PATCH prototype.js to handle slider on mobile devices
			<script src="<?php echo PREPEND_PATH; ?>resources/lightbox/js/prototype.js"></script>
	-->
			<script>var originalArrayFind = Array.prototype.find;</script>
			<script src="https://ajax.googleapis.com/ajax/libs/prototype/1.7.3.0/prototype.js"></script>
			<script>Array.prototype.find = originalArrayFind;</script>';
	$newfilecontent=str_replace($search,$replace,$filecontent);
	copy($dir.$filename,$dir.$filename."_orig");
	file_put_contents($dir.$filename,$newfilecontent);
}

?>

<script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/9.2.0/bootstrap-slider.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/9.2.0/css/bootstrap-slider.min.css">
<script src="resources/nouislider/nouislider.min.js"></script>
<link rel="stylesheet" href="resources/nouislider/nouislider.min.css">
<script src="resources/wnumb/wNumb.min.js"></script>

<style>
html, body, div {
    // font-family: 'Roboto' !important;
    font-weight: bold;
}
@import url('https://fonts.googleapis.com/css?family=Roboto');

.navbar-fixed-bottom {
    display:none;
}

.opensans {
  font-family: 'Roboto';
}
.flex-container {
  padding: 0;
  margin: 0;
  list-style: none;
  display: flex;
}

.flex-start { 
  justify-content: flex-start; 
}

.flex-end { 
  justify-content: flex-end; 
}  
.flex-end li {
  background: gold;
}

.center { 
  justify-content: center; 
}  
.center li {
  background: deepskyblue;
}

.space-between { 
  justify-content: space-between; 
  margin-left: -3px;
  margin-right: -10px;
  padding-top: 2px;
}  
.space-between li {
  background: lightgreen;
}

.steps-slider {
    height: 2px;
}

.steps-slider .noUi-connect {
    background: black;
}
.textlabel {
	text-align: center;	
	font-size: 15px;
}

.noUi-target {
    border: 0px solid #e2e2e2;
    background: #f5f6fa;
    border: 0px solid #e2e2e2;
    /* box-shadow: inset 0 1px 1px #f0f0f0, 0 3px 6px -5px #bbb; */
}

.input-min {
    width: 40px;
    height: 15px;
    font-size: 14px;
    border: none;
    background: #f5f6fa;
	font-weight: 500;
}
.input-max {
    width: 40px;
    height: 15px;
    font-size: 14px;
    border: none;
    background: #f5f6fa;
	text-align: end;
	font-weight: 500;
}
.input-min:focus {
    outline-color: transparent;
	border-style: hidden hidden solid hidden ;
	border-color: whitesmoke;
	text-align: left;
}

.input-max:focus {
    outline-color: transparent;
	border-style: hidden hidden solid hidden ;
	border-color: whitesmoke;
	text-align: right;
}


.steps-slider .noUi-handle {
    height: 10px;
    width: 10px;
    top: -5px;
    right: -9px; /* half the width */
    border-radius: 9px;
	background-color: black;
    border: 1px solid black;
    cursor: default;
    box-shadow: none;

}
.noUi-handle:after, .noUi-handle:before {
    content: "";
    display: block;
    position: absolute;
    height: 14px;
    width: 1px;
    background: transparent;
    left: 14px;
    top: 6px;
}
.sort-by-asc
{
    left: 3px;
    display: inline-block;
    width: 0;
    height: 0;
    border: solid 5px transparent;
    margin: 4px 4px -1px 6px;
    background: transparent;
    border-bottom: solid 13px #333;
    border-top-width: 0;
	z-index: 2;
}
.container {
    width: 96% !important;
	padding-right: 0px; 
    padding-left: 0px;
}
.sort-activ-asc {
	border-bottom-color: coral !important;
}
.sort-activ-desc {
	border-top-color: coral !important;
}
.sort-by-desc
{
    left: 3px;
    display: inline-block;
    width: 0;
    height: 0;
    border: solid 5px transparent;
    margin: 3px 4px -1px -3px;
    background: transparent;
    border-top: solid 13px #333;
    border-bottom-width: 0;
	z-index: 2;
}
.slider-range {
    display: flex;
    width: 100%;
    margin-bottom: 2px;
    font-size: 9px;
}
.slider_input-left {
    min-width: 32px;
    max-width: 80px;
    margin: -5px;
    padding: 0 0 1px 0;
    height: 11px;
    border: none;
    outline: none;
    background-color: transparent;	
}
.slider_input-right {
	position:absolute;
    right:40px;
	min-width: 32px;
    max-width: 80px;
    margin: -5px;
    padding: 0 0 1px 0;
    height: 11px;
    border: none;
    outline: none;
    background-color: transparent;	
}
.slider-column {
    display: flex;
}
.grid-item { width: 25%; }
.grid-item--width2 { width: 50%; }

.i_container {
    font-family: 'Roboto' !important;
    position: relative;
    text-align: center;
    color: #1e272e;
    font-size: 120%;
    text-align: center;
    margin: 0 auto;
    margin-top: 10px;
	float: left;
	position: relative;
}
.img {
    height: 250px !important;	
}
.imgParameter {
	height: 250px !important;
    min-width: 100px;
    background-position: 50%!important;
    background-repeat: no-repeat!important;
    background-size: cover!important;
}
.imgContainer {
    position: relative;
}
.name {
    display: block;
    font-size: 1.5em;
    text-decoration: none;
    color: black;
    margin-bottom: 10px;
    margin-top: 15px;
}
.popup {
    display: none;
    position: absolute;
    z-index: 100;
    pointer-events: none;
    box-shadow: 0 3px 6px rgb(0 0 0 / 16%), 0 3px 6px rgb(0 0 0 / 23%);
    background: #fff;
    border-radius: 5px;
    padding: 3px;
    border: 1px solid #d3d3d3;
}

.cards-container {
	height:	100% !important;
    display: -webkit-flex;
    -webkit-flex-wrap: wrap;
    -webkit-justify-content: center;
    display: flex;

}
.cards-container .card {
	height:100%
}
.i_card {
	min-width: 300px;
	max-width: 90%;
	width: 300px;
}

.column {
  margin: 1rem;
  background-color: #ccc;
}
.i_card-content {
	max-width: 330px;
    display: block;
    margin: 8px;
    padding: 8px;
    box-shadow: rgb(0 0 0 / 40%) 0 4px 8px 0;
    transition: box-shadow 500ms cubic-bezier(0.22, 0.84, 0.57, 1.5);
    background-color: white;
    border-radius: 2px;
	display: flex;
    flex: 1 0 auto;
	flex-direction: row;
    justify-content: space-around;
}

.imgContainer {
    position: relative;
}
.imgParameter {
    height: 250px !important;
}
.imgParameter {
    height: 100px;
    min-width: 100px;
    background-position: 50%!important;
    background-repeat: no-repeat!important;
    background-size: cover!important;
}
.name {
    display: block;
    font-size: 1.5em;
    text-decoration: none;
    color: black;
    margin-bottom: 10px;
    margin-top: 15px;
}
a:-webkit-any-link {
    color: -webkit-link;
    cursor: pointer;
    text-decoration: none;
	color: black;
	font-size: 1.5em;
}

.popup {
    display: none;
    position: absolute;
    z-index: 100;
    pointer-events: none;
    box-shadow: 0 3px 6px rgb(0 0 0 / 16%), 0 3px 6px rgb(0 0 0 / 23%);
    background: #fff;
    border-radius: 5px;
    padding: 3px;
    border: 1px solid #d3d3d3;
}

.top-left {
    position: absolute;
    top: 32.4%;
    left: 4.5%;
    text-align: left;
}
.top-center {
    position: absolute;
    top: 32.4%;
    left: 39%;
    text-align: left;
}
.bottom-center {
    position: absolute;
    bottom: 5.2%;
    left: 39%;
    text-align: left;
}
.top-right {
    position: absolute;
    top: 32.4%;
    left: 73.5%;
    text-align: left;
}
.bottom-right {
    position: absolute;
    bottom: 5.2%;
    left: 73.5%;
    text-align: left;
}
.bottom-left {
    position: absolute;
    bottom: 5.2%;
    left: 4.5%;
    text-align: left;
}
.card-content {
    display: block;
    width: 100%;
    margin: 8px;
    padding: 8px;
    box-shadow: rgb(0 0 0 / 40%) 0 4px 8px 0;
    transition: box-shadow 500ms cubic-bezier(0.22, 0.84, 0.57, 1.5);
    background-color: white;
    border-radius: 2px;
    border-radius: 5px;
    transition: transform 0.4s ease;
}
.slider-handle {
    position: absolute;
    top: 7px;
    width: 5px;
    height: 5px;
}
.row .pagination-section {
    margin-top: -45px;
    margin-right: 10px;
    margin-left: 10px;
}
.filter {
	    display: inline-block;
    vertical-align: top;
    padding-bottom: 10px;
    padding-right: 10px;
    width: 220px;
    min-width: 0;
	margin-left: 5px;
	margin-right: 5px;
}
.cards-page {
    margin: 8px 0 8px 0;
    border-top: solid #E5E5E5 1px;
    border-bottom: solid #E5E5E5 1px;
    display: -webkit-flex;
    -webkit-align-items: center;
    display: flex;
    align-items: center;	
}
.cards-pageNumber {
    margin-left: 15px;
}
.cards-page-button {
    margin-left: auto;
    display: flex;
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}
div.cards-page-button-disabled {
    opacity: 0.3;
    cursor: default;
}
.cards-page-button > div {
    cursor: pointer;
    margin: 2px;
}
.at-pagination-button {
    width: 24px;
    height: 24px;
}
.at-svg-icon {
    flex: auto;
}
svg:not(:root) {
    overflow: hidden;
}

.row {
    margin-right: 0px;
    margin-left: 0px;
}
.loader,
.loader:after {
	border-radius: 50%;
	width: 10em;
	height: 10em;
}
.loader {            

}
#loadingDiv {
	position:absolute;;
	top:0;
	left:0;
	width:100%;
	height:100%;
	background-color:#fff;
	z-index: 999;
}

#search::placeholder {
	top: 26px;
}
input::placeholderp::first-letter {
    text-transform:capitalize;
}
.select2-container-multi .select2-choices {
    min-height: 34px;
    background: #f5f5f5;
}

.sliders { padding: 15px 0 30px 0; }
.filter-section .filter-label {
  display: block;
  font-weight: bold;
  font-size: 1.5em;
  text-align: center;
}
.slider-handle.custom {
	background: transparent none;
}
.slider.slider-horizontal {
	width:100%;
}
.slider-tick, .slider-tick.in-selection {
    display: none;
}

.slider-handle.custom::before {
    line-height: 20px;
    font-size: 36px;
    content: '\2022'; /*unicode dot character*/
    color: #000000;
}
.slider.slider-horizontal .slider-tick, .slider.slider-horizontal .slider-handle {
    margin-left: -4px;
}
.slider-handle {
    position: absolute;
    top: -4px;
    width: 5px;
    height: 5px;
}
/*
.bootstrap-slider .slider-selection { background: #2175b0; }
.bootstrap-slider .slider-selection {
    background: #000000;
}
.slider.slider-horizontal .slider-selection, .slider.slider-horizontal .slider-track-low, .slider.slider-horizontal .slider-track-high {
    height: 20%;
    top: 0;
    bottom: 0;
}
.slider.slider-horizontal .slider-tick-label-container {
    white-space: nowrap;
    margin-top: 7px;
}
*/
/** STAR css  **/

.sp {
	width: 5px;
	height: 25px;
}

.st, .emptyStar, .halfStar, .fullStar, .myhalfStar, .myfullStar, .fullStarHover, .emptyStarHover {
	position: relative;
	display: inline-block;
	font-size: 25px;
	color: transparent;
	overflow: hidden;
	white-space: pre;
	box-sizing: border-box;
}

.fullStarHover {
	color: gold !important;
}

.emptyStarHover {
	color: #777 !important;
	text-shadow: 0 0 1px white !important;
}

.halfStar:before, .myhalfStar:before, .fullStarHover:before, .emptyStarHover:before {
	display: block;
	z-index: 1;
	position: absolute;
	top: 0;
	width: 50%;
	content: attr(data-content);
	overflow: hidden;
}

.halfStar:after, .myhalfStar:after, .fullStarHover:after, .emptyStarHover:after {
	display: block;
	direction: rtl;
	position: absolute;
	z-index: 2;
	top: 0;
	left: 50%;
	width: 50%;
	content: attr(data-content);
	overflow: hidden;
}


.fullStar, .halfStar:before {
	color: orange;
}

.tstarrating {
	cursor: pointer;
	float: left;
    width: 60%;	
}
.startextcontainer {
	text-align: left;
	float: left;
    width: 50%;	
	
}
.facts {
	text-align: left;
    float: left;
}
.myfullStar, .myhalfStar:before {
	color: gold;
}

.emptyStar, .halfStar:after, .myhalfStar:after {
	color: #777;
	text-shadow: 0 0 1px white;
}

.fullStarHover:before, .fullStarHover:after {
	color: gold !important;
}

.emptyStarHover:before, .emptyStarHover:after {
	color: #777;
	text-shadow: 0 0 1px white !important;
}

.trans {
	-moz-transition: all ease-in-out .2s;
	-o-transition: all ease-in-out .2s;
	-webkit-transition: all ease-in-out .2s;
	transition: all ease-in-out .2s;
}

body {
  display: flex;
  justify-content: center;
  margin: 0;
  height: 100vh;
}
.favorites {
	display: flex;
    justify-content: flex-end;	
	visibility: hidden;
}
.myfavorites {
	visibility: hidden;
	text-align: center;	
}
.toggle-heart {
  position: absolute;
  left: -100vw;
}
.toggle-heart:checked + label {
  color: #e2264d;
}

.toggle-heart-label {
  align-self: center;
  color: #aab8c2;
  font-size: 2em;
  cursor: pointer;
}
#reset_filters, #search {
	padding-top: 5px;
	padding-bottom: 5px;
	height: 34px;
	width: 210px;
}
</style>
<script>
if (window.location.href.includes('snacks_view')) {
	$j('body').append('<div style="" id="loadingDiv"><div class="loader">Loading...</div></div>');
}
</script>
<?php
	$sql="SET GLOBAL group_concat_max_len = 10000";
	sql($sql,$eo);