<!DOCTYPE html>
<head>
<script type="text/javascript" src="Scripts/jquery.js"></script>
<script type="text/javascript" src="jquery.carouFredSel-6.1.0.js"></script>
<script type="text/javascript" src="jquery.carouFredSel-6.1.0-packed.js"></script>

	<script type="text/javascript">
	$(document).ready(function(){
$(".foo5").carouFredSel({
		items		: {
		visible		: 1,
		width		: 350,
		height		: "46%"
	},
	prev 		: {
		button		: "#foo5_prev",
		key			: "left",
		items		: 1,
	
		duration	: 750
	},
	next 		: {
		button		: "#foo5_next",
		key			: "right",
		items		: 1,
	
		duration	: 750
	},
	pagination : {
		container	: "#foo5_pag",
		keys		: true,
		
		duration	: 750
	},

})
	});
</script>

<style type="text/css">
.image_carousel {
	padding: 15px 0 15px 40px;
	position: relative;
}
.image_carousel img {
	border: 1px solid #ccc;
	background-color: white;
	padding: 9px;
	margin: 7px;
	display: block;
	float: left;
}
a.prev, a.next {
	background: url(http://caroufredsel.dev7studios.com/images/miscellaneous_sprite.png) no-repeat transparent;
	width: 45px;
	height: 50px;
	display: block;
	position: absolute;
	top: 100px;
}
a.prev {			left: 22px;
					background-position: 0 0; }
a.prev:hover {		background-position: 0 -50px; }
a.prev.disabled {	background-position: 0 -100px !important;  }
a.next {			right: 1050px;
					background-position: -50px 0; }
a.next:hover {		background-position: -50px -50px; }
a.next.disabled {	background-position: -50px -100px !important;  }
a.prev.disabled, a.next.disabled {
	cursor: default;
}

a.prev span, a.next span {
	display: none;
}
.pagination {
	text-align: center;
}
.pagination a {
	background: url(http://caroufredsel.dev7studios.com/images/miscellaneous_sprite.png) 0 -300px no-repeat transparent;
	width: 15px;
	height: 15px;
	margin: 0 5px 0 0;
	display: inline-block;
}
.pagination a.selected {
	background-position: -25px -300px;
	cursor: default;
}
.pagination a span {
	display: none;
}
.clearfix {
	float: none;
	clear: both;
}
</style>


</head>
<body>
<div class="html_carousel" style="width:900px">
	<div id="foo5" class="foo5">
			<img src="http://caroufredsel.dev7studios.com/examples/images/large/carousel_1.jpg" alt="carousel 2" width="870" height="400" />
			<img src="http://caroufredsel.dev7studios.com/examples/images/large/carousel_2.jpg" alt="carousel 2" width="870" height="400" />
			<img src="http://caroufredsel.dev7studios.com/examples/images/large/carousel_3.jpg" alt="carousel 3" width="870" height="400" />
			<img src="http://caroufredsel.dev7studios.com/examples/images/large/carousel_4.jpg" alt="carousel 4" width="870" height="400" />
	</div>
	<div class="clearfix"></div>
	<div>
	<a class="prev" id="foo5_prev" href="#"><span>prev</span></a>
	<a class="next" id="foo5_next" href="#"><span>next</span></a>
</div>
	<div class="pagination" id="foo5_pag"></div>
</div>
</body>
</html>
