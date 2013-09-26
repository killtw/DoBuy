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
			<div data-role="content" data-collapsed="true" style="text-align: center;">
				<? if($query->num_rows() > 0): ?>
					<? foreach($query->result() as $row): ?>
						<img src="<?=$row->image?>" title="<?=$row->title?>" style="width: 290px; text-align: center;">
						<h1><?=$row->title?></h1>
						<h2 style="color: red;">特價: <?=$row->price?></h2>
						<p>原價: <del><?=$row->worth?></del></p>
						<div data-role="controlgroup" data-type="horizontal" style="text-align: center;">
							<a href="http://m.facebook.com/sharer.php?u=<?=urlencode(site_url('home/frame/'.$row->id));?>&t=<?=urlencode($row->title);?>" data-role="button" rel="external" target="_blank">FB</a>
							<a href="http://www.plurk.com/m/?qualifier=shares&content=<?=urlencode(site_url('home/frame/'.$row->id));?> (<?=$row->title;?>)" data-role="button" rel="external" target="_blank">Plurk</a>
							<a href="http://mobile.twitter.com/home/?status=<?=$row->title;?> <?=urlencode(site_url('home/frame/'.$row->id));?>" data-role="button" rel="external" target="_blank">Twitter</a>
						</div>
						<a href="<?=$row->url;?>" data-role="button" data-icon="check" rel="external" target="_blank">前往購買</a> 
					<? endforeach; ?>
				<? endif; ?>
			</div>
			<div data-role="footer" data-theme="c">
				<p style="text-align: center;">&copy; 2011 Dobuy</p>
			</div>
		</div>
	</body>
</html>