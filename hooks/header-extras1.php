<script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/9.2.0/bootstrap-slider.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/9.2.0/css/bootstrap-slider.min.css">
<script src="resources/nouislider/nouislider.min.js"></script>
<link rel="stylesheet" href="resources/nouislider/nouislider.min.css">
<script src="resources/wnumb/wNumb.min.js"></script>

<style>

</style>
<script>
if (window.location.href.includes('snacks_view')) {
	$j('body').append('<div style="" id="loadingDiv"><div class="loader">Loading...</div></div>');
}
</script>
<?php
	$sql="SET GLOBAL group_concat_max_len = 10000";
	sql($sql,$eo);