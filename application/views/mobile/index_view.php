<!doctype html>

<html lang="zh-tw">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width; initial-scale=1">
		<title>Dobuy</title>
		<link rel="stylesheet" href="http://code.jquery.com/mobile/1.0rc1/jquery.mobile-1.0rc1.min.css" />
		<script src="<?=site_url('js/jquery.min.js');?>"></script>
		<script src="http://code.jquery.com/mobile/1.0rc1/jquery.mobile-1.0rc1.min.js"></script>
	</head>

	<body>
		<div data-role="page" data-theme="b">
			<div data-role="header" data-theme="c">
				<h1>Dobuy</h1>
			</div>
			<div data-role="content">
				<ul data-role="listview" data-inset="true" id="category">
					<li data-role="list-divider">Category</li>
					<? foreach($categories as $category): ?>
						<? if($category[2]['num_rows'] > 0): ?>
							<li>
								<a href="<?=site_url("mobile/category/$category[1]");?>"><?=$category[0]?></a><span class="ui-li-count"><?=$category[2]['num_rows'];?></span>
							</li>
						<? endif; ?>
					<? endforeach; ?>
				</ul>

				<ul data-role="listview" data-inset="true" id="city">
					<li data-role="list-divider">City</li>
					<? foreach($cities as $city): ?>
						<? if($city[2]['num_rows'] > 0): ?>
							<li>
								<a href="<?=site_url("mobile/city/$city[1]");?>"><?=$city[0]?></a><span class="ui-li-count"><?=$city[2]['num_rows'];?></span>
							</li>
						<? endif; ?>
					<? endforeach; ?>
				</ul>
			</div>
			<div data-role="footer" data-theme="c">
				<p style="text-align: center;">&copy; 2011 Dobuy</p>
			</div>
		</div>
	</body>
</html>
