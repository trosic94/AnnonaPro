<nav class="mainMenu">

<div class="hamburger"></div>

{{ menu('Glavni Meni') }}

<script type="text/javascript">
$(document).ready(function() {

	var scrWidth = $(window).width();

	if (scrWidth > 970) {

		$('nav.mainMenu ul li').on('mouseover', function() {
			$(this).children('ul').show();
		});
		$('nav.mainMenu ul li').on('mouseleave', function() {
			$(this).children('ul').hide();
		});

		$('nav.mainMenu ul li ul').on('mouseleave', function() {
			$(this).hide();
		});	

	} else {

		$('div.hamburger').on('click', function() {
			$('nav.mainMenu ul').toggle();
		});

	}
});
</script>

</nav>