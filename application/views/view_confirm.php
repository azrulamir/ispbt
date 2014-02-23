<!--
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Sistem Pengurusan Buku Teks</title>
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css" type="text/css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>js/side-menu.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>js/window-size.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>js/misc.js" type="text/javascript"></script>
</head>
<body>
<div id="error-wrapper">
-->
<table id="page-header" width="300px">
	<tr>
		<td align="center"><h2>Pengesahan Tindakan!</h2></td>
	</tr>
	<tr>
		<td align="center"><?php echo $confirmquestion; ?></td>
	</tr>
</table>
<center>
<br />
<p><b><?php echo $additionalvalue; ?></b></p>
<br />
<input id="<?php if ($alert == 'yes') { echo 'alert'; } ?>" class="submit" type="button" value="<?php echo $proceedvalue; ?>" onClick="proceed()" />
</center>
<br />
<?php
echo "
<script type=\"text/javascript\">
	function proceed() {
		$('#$submitform').submit();
	}
</script>
";
?>
<!--
</div>
</body>
</html>
-->
