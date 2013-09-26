<div id="content">
	<div id="deals">
		<?php if($query->num_rows > 0){ ?>
			<?php foreach($query->result() as $row): ?>
				<script>
					$(function () {
						$('#time-left-<?=$row->id?>-value').countdown({
							until: new Date(<?=date("Y,m-1,d,H,i,s",strtotime($row->endtime))?>),
							compact: true,
							compactLabels: ['', '', '', '天'],
							expiryText: '你錯過它了'
						});
					});
				</script>
				<div>
					<h1 style="margin-bottom: 20px; margin-top: 20px;"><a href="<?=site_url('home/frame/'.$row->id);?>" title="<?=$row->title?>" target="_blank"><?=mb_strimwidth($row->title, 0, 112, '…', 'UTF-8')?></a></h1>
					<div class="deal clearfloat">
						<div class="image round5">
							<div>
								<a href="<?=$row->image?>" class="highslide" onclick="return hs.expand(this)"><img src="<?=$row->image?>" title="<?=$row->title?>" height="210px"></a>
							</div>
						</div>

						<div class="info">
							<p>
								<span class="price">$<?=$row->price?></span>
								<span class="buy"><a href="<?=site_url('home/frame/'.$row->id);?>" title="Buy it!" class="round12" target="_blank">Buy it!</a></span>
							</p>

							<div class="detail round5">
								<table class="calc">
									<tr>
										<td>
											<span>原價</span>
										</td>
										<td>
											<span>折扣</span>
										<td>
											<span>節省</span>
										</td>
										</td>
									</tr>
									<tr>
										<td>
											<span class="discount">$<?=$row->worth?></span>
										</td>
										<td>
											<span class="discount"><?=($row->worth>0)?sprintf("%.1f",($row->price/$row->worth)*10):'?'?>折</span>
										</td>
										<td>
											<span class="discount">$<?=$row->worth-$row->price?></span>
										</td>
									</tr>
								</table>
								<? if(!empty($row->address)) { ?>
									<div class="address">
										<hr />
										<strong><?=$row->address?></strong>
									</div>
								<? } ?>
							</div>

							<div class="share left">
								<a href="#" onclick="javascript: void(window.open('http://www.facebook.com/sharer.php?u=' .concat(encodeURIComponent('<?=site_url('home/frame/'.$row->id);?>')).concat('&t=<?=$row->title?>&src=sp')));"><img src="<?=site_url('image/facebook.png');?>"></a>
								<a href="#" onclick="javascript: void(window.open('http://www.plurk.com/?qualifier=shares&status=' .concat(encodeURIComponent('<?=site_url('home/frame/'.$row->id);?>')).concat(' ') .concat('&#40;') .concat('<?=$row->title?>') .concat('&#41;')));"><img src="<?=site_url('image/plurk.png');?>"></a>
								<a href="#" onclick="javascript: void(window.open('http://twitter.com/home/?status='.concat('<?=$row->title?>') .concat(' ') .concat(encodeURIComponent('<?=site_url('home/frame/'.$row->id);?>'))));"><img src="<?=site_url('image/twitter.png');?>"></a>
							</div>

							<div class="time-left">
								<span class="countdown_section">
									<span id="time-left-<?=$row->id?>-value"></span>
								</span>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		<?php }else{ ?>
			<div>No results</div>
		<?php } ?>
	</div>

	<?=$pagination?>

</div>