<!doctype html>

<html lang="zh-tw">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="<?=site_url('css/style.css');?>" />
		<script src="http://www.google.com/jsapi"></script>
		<script>
			google.load("jquery", "1.6.4");
		</script>
		<script type="text/javascript" src="<?=site_url('js/frame.js');?>"></script>
	<? foreach($query->result() as $row): ?>
		<title><?=$row->title;?></title>
		<meta property="og:title" content="<?=$row->title;?>" />
		<meta property="og:image" content="<?=$row->image;?>" />
	</head>

	<body>
		<div id="bar" style="height: 110px">
			<div class="main" style="margin: 10px auto; height: 80px; padding: 10px">
				<div class="left"><a href="<?=site_url();?>"><img src="<?=site_url('image/logo.png');?>"></a></div>
				<div class="left" style="margin-top: 25px; margin-left: 50px;">
					<a href="http://www.facebook.com/sharer.php?u=<?=urlencode(site_url('home/frame/'.$row->id));?>&t=<?=urlencode($row->title);?>" target="_blank"><img src="<?=site_url('image/facebook.png');?>" style="vertical-align: bottom;"></a>
					<a href="http://www.plurk.com/?qualifier=shares&status=<?=urlencode(site_url('home/frame/'.$row->id));?> (<?=$row->title;?>)" target="_blank"><img src="<?=site_url('image/plurk.png');?>" style="vertical-align: bottom;"></a>
					<a href="http://twitter.com/home/?status=<?=$row->title;?> <?=urlencode(site_url('home/frame/'.$row->id));?>" target="_blank"><img src="<?=site_url('image/twitter.png');?>" style="vertical-align: bottom;"></a>
				</div>
				<div class="right" style="margin: 30px;">
					<a href="<?=$row->url;?>">X</a>
				</div>
			 </div>
		</div>
		<iframe src="<?=$row->url;?>" id="frame" width="100%" height="800px" frameborder="0"></iframe>
	<? endforeach; ?>
	</body>
</html>