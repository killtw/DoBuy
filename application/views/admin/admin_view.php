<!doctype html>

<html lang="zh-tw">
	<head>
		<meta charset="UTF-8">
		<title>管理頁面</title>
		<link rel="stylesheet" href="<?=site_url('css/admin.css');?>" />
		<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/smoothness/jquery-ui.css" />
		<script src="<?=site_url('js/jquery.min.js');?>"></script>
		<script src="<?=site_url('js/jquery-ui.min.js');?>"></script>
		<script>
			$(function() {
				$('#accordion').accordion();
			});
		</script>
	</head>

	<body>
		<div id="accordion">
			<h3><a href="#">Deals</a></h3>
			<div>
				<iframe src="<?=site_url('admin/deals');?>" style="width:100%; height:500px;" frameborder="0"></iframe>
			</div>
			<h3><a href="#">Users</a></h3>
			<div>
				<iframe src="<?=site_url('admin/users');?>" style="width:100%; height:500px;" frameborder="0"></iframe>
			</div>
		</div>
	</body>
</html>
