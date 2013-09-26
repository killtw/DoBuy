<!doctype html>

<html lang="zh-tw">
	<head>
		<meta charset="utf-8">
		<title>DoBuy</title>
	</head>

	<body style="font: 14px Tahoma,Geneva,sans-serif; margin: 0; padding: 0;">
		<div id="head" class="clearfloat" style="width: 860px; margin:0 auto; margin-top:15px; padding:0; display: inline-block;">
			<div>
				<a href="<?=site_url();?>"><img src="<?=site_url('image/logo.png');?>"></a>
			</div>
		</div>
		<div id="main" style="width: 860px; padding: 0; margin: 0 auto;">
			<div id="content">
				<div id="deals" style="text-align: center;">
					<? if($query->num_rows > 0){ ?>
						<? foreach($query->result() as $row): ?>
							<div>
								<h1 style="margin-bottom: 20px; margin-top: 20px; line-height: 120%; font-family: Arial,Helvetica,sans-serif;"><a href="<?=site_url('home/frame/'.$row->id);?>" title="<?=$row->title;?>" target="_blank" style="background: none repeat scroll 0 0 transparent; color: #092E20; text-decoration: none;"><?=mb_strimwidth($row->title, 0, 112, '…', 'UTF-8');?></a></h1>
								<div class="deal clearfloat" style="display: inline-block; font: 14px Arial, Helvetica, sans-serif;">
									<div class="image round5" style="margin-right: 22px; width: 400px; text-align: center; overflow:hidden; display: block; float: left; border-radius: 5px; -moz-border-radius: 5px; -webkit-border-radius: 5px;">
										<div style="border: #b6b6b6 1px solid;">
											<a href="<?=$row->image;?>"><img src="<?=$row->image;?>" title="<?=$row->title;?>" height="210px" style="vertical-align: bottom;"></a>
										</div>
									</div>

									<div class="info" style="display: block; float: left; width: 420px;">
										<p>
											<span class="price" style="font-size: 60px; line-height: 70px; height: 66px; font-weight: bold; width: 100px; *width: 140px; position: relative; color: #F53231; text-shadow: 0 2px 2px rgba(0,0,0,0.7); overflow: hidden;">$<?=$row->price;?></span>
											<span class="buy" style="position: relative; top: -10px; left: 50px; *top: 0; *left: 0;"><a href="<?=site_url("home/frame/$row->id");?>" title="Buy it!" class="round12" target="_blank" style="color: #fff; font-weight: bold; background: #8AC631; font-size: 30px; *font-size: 28; padding: 10px 30px; display: inline-block; -moz-box-shadow: 0 1px 0 white; -webkit-box-shadow: 0 1px 0 white; box-shadow: 0 1px 0 white; border-radius: 12px; -moz-border-radius: 12px; -webkit-border-radius: 12px; text-decoration: none;">Buy it!</a></span>
										</p>

										<div class="detail round5" style="margin: 10px auto; padding: 6px 0; width: 380px; border: #b6b6b6 1px solid; border-radius: 5px; -moz-border-radius: 5px; -webkit-border-radius: 5px;">
											<table class="calc" style="width: 320px; margin: 0 auto;">
												<tr>
													<td style="width: 80px;
			text-align: center;">
														<span>原價</span>
													</td>
													<td style="width: 80px;
			text-align: center;">
														<span>折扣</span>
													</td>
													<td style="width: 80px;
			text-align: center;">
														<span>節省</span>
													</td>
												</tr>
												<tr>
													<td style="width: 80px;
			text-align: center;">
														<span class="discount" style="font-size: 20px;"><del>$<?=$row->worth;?></del></span>
													</td>
													<td style="width: 80px;
			text-align: center;">
														<span class="discount" style="font-size: 20px;"><?=($row->worth>0)?sprintf("%.1f",($row->price/$row->worth)*10):'?';?>折</span>
													</td>
													<td style="width: 80px;
			text-align: center;">
														<span class="discount" style="font-size: 20px;">$<?=$row->worth-$row->price;?></span>
													</td>
												</tr>
											</table>
											<? if(!empty($row->address)) { ?>
												<div class="address">
													<hr style="margin: 3px auto; border:0; background-color:#B6B6B6; color:#B6B6B6; height:1px; width: 80%;" />
													<strong><?=$row->address;?></strong>
												</div>
											<? } ?>
										</div>

										<div class="share left" style="float: left; text-align: left; padding-left: 20px;">
											<a href="http://www.facebook.com/sharer.php?u=<?=urlencode(site_url('home/frame/'.$row->id));?>&t=<?=urlencode($row->title);?>" target="_blank"><img src="<?=site_url('image/facebook.png');?>"></a>
											<a href="http://www.plurk.com/?qualifier=shares&status=<?=urlencode(site_url('home/frame/'.$row->id));?> (<?=$row->title;?>)" target="_blank"><img src="<?=site_url('image/plurk.png');?>"></a>
											<a href="http://twitter.com/home/?status=<?=$row->title;?> <?=urlencode(site_url('home/frame/'.$row->id));?>" target="_blank"><img src="<?=site_url('image/twitter.png');?>"></a>
										</div>
									</div>
								</div>
							</div>
						<? endforeach; ?>
					<? }else{ ?>
						<div>No results</div>
					<? } ?>
				</div>
			</div>
		</div>
	</body>
</html>