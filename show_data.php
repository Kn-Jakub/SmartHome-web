<html>
<head>
	<title>Show form data</title>
</head>
<body>

<p>The &lt;form&gt; sent me the following data:</p>

<script>
var params = location.search.replace(/^\?/,'').split('&');
for (var i = 0; i < params.length; i += 1) {
	var key_val = params[i].split('=');
	if (key_val.length >= 2) {
		var key = key_val[0];
		var val = key_val[1];
		document.write('<p>GET[' + key + '] = <strong>' + val + '</strong></p>');
	}
}
</script>

</body>
</html>
