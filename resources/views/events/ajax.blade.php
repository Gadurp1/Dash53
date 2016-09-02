<html>
<head>
<title>Laravel ajax pagination example : Tutsway.com</title>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
</head>
<body>
<div id="ajaxContent">
</div>
<script src="//cdn.jsdelivr.net/jquery/2.1.1/jquery.js"></script>
<script>
$( document ).ready(function() {
var Url = '/eventsAjax';
$('#ajaxContent').load(Url);
});
</script>
</body>
</html>
