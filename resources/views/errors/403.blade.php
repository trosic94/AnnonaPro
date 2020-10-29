<!DOCTYPE html>
<html>
<head>
    <title>{{ setting('site.title') }} - 419 Page Expired</title>

<style type="text/css">
	body,html {
		height: 100%;
	}
	body { 
		margin: 0;
		padding: 0;
		background-color: #ffffff;
		background-image: url('/images/error/419.jpg');
		background-repeat: no-repeat;
		background-size: cover;
		background-attachment: fixed;
		background-position: center;
	}
	#lnk {
		display: block;
		width: 100%;
		height: 100%;
	}
</style>

</head>
<body>

	<a id="lnk" href="{{ setting('site.site_url') }}"></a>
    
</body>
</html>