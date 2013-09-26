<!doctype html>

<html lang="zh-tw">
	<head>
		<meta charset="UTF-8">
	</head>

	<body>
		<div data-role="page" data-theme="c" data-add-back-btn="true">
			<div data-role="header" data-theme="c">
				<h1>Dobuy</h1>
			</div>
			<div data-role="content">
				<ul data-role="listview" data-inset="true" data-filter="true">
					<li data-role="list-divider"><?=$title;?></li>
					<? if($query->num_rows() > 0): ?>
						<? foreach($query->result() as $row): ?>
							<li>
								<a href="<?=site_url('mobile/deal/'.$row->id);?>">
									<img src="<?=$row->image?>" title="<?=$row->title?>">
									<h1><?=$row->title?></h1>
									<h2 style="color: red;">特價: <?=$row->price?></h2>
									<p>原價: <?=$row->worth?></p>
								</a>
							</li>
						<? endforeach; ?>
					<? endif; ?>
				</ul>
			</div>
			<div data-role="footer" data-theme="c">
				<p style="text-align: center;">&copy; 2011 Dobuy</p>
			</div>
		</div>
	</body>
</html>