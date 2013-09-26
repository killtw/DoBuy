<div id="head" class="clearfloat">
	<div class="left">
		<a href="<?=site_url();?>"><img src="<?=site_url('image/logo.png');?>" alt="DoBuy!" title="DoBuy!"></a>
	</div>

	<div class="user right">
		<? if(!$fb_data['me']): ?>
		<a href="<?=$this->facebook->getLoginUrl(array('scope' => 'email'));?>"><img src="<?=site_url('image/facebook-login-button.png');?>"></a>
		<? else: ?>
		<div class="left"><img src="https://graph.facebook.com/<?=$fb_data['uid'];?>/picture" alt="<?=$fb_data['me']['name'];?>" class="fbpic"></div>
		<div class="fbc">
			<?=$fb_data['me']['name'];?><br />
			<?=anchor('admin/getid/users/fb_uid/'.$fb_data['uid'], '設定', 'class="uedit"');?><br />
			<?=anchor($this->facebook->getLogoutUrl(), '登出');?>
		</div>
		<? endif; ?>
	</div>
</div>

<div id="dialog-users" title="設定">
	<?=form_open();?>
		<p id="like">
			<?=form_label('喜好', 'like');?>
			<? foreach($categories as $key => $category): ?>
				<?=form_radio(array('name' => 'like', 'id' => "like$key", 'value' => $category[1]));?><?=form_label($category[0], "like$key");?>
			<? endforeach; ?>
		</p>
		<p id="sub">
			<?=form_label('訂閱', 'sub');?>
			<?=form_radio(array('name' => 'sub', 'id' => 'sub1', 'value' => '1'));?><?=form_label('是', 'sub1');?>
			<?=form_radio(array('name' => 'sub', 'id' => 'sub2', 'value' => '0'));?><?=form_label('否', 'sub2');?>
		</p>
	<?=form_close();?>
</div>

<div class="menu">
	<div class="rectangle">
	<div class="search right">
		<?=form_open('home/search', 'id="search"');?>
			<img src="<?=site_url('image/search.png');?>" style="vertical-align: middle;"> <?=form_input('search', '請輸入關鍵字…', 'id="autocomplete"');?>
		<?=form_close();?>
	</div>

	<div class="sort clearfloat">
		<ul>
			<li>
				Sort by
			</li>
			<li>
				<?=anchor('home/index/price/', '價格')?>
			</li>
			<li>
				<?=anchor('home/index/worth/', '原價')?>
			</li>
			<li>
				<?=anchor('home/index/endtime/', '結束時間')?>
			</li>
			<li>
				<select name="category" id="category">
					<option value="category" selected>種類</option>
					<? foreach($categories as $category): ?>
						<? if($category[2]['num_rows'] > 0): ?>
							<option value="<?=$category[1]?>"><?=$category[0].' ('.$category[2]['num_rows'].')';?></option>
						<? endif; ?>
					<? endforeach; ?>
				</select>
			</li>
			<li>
				<select name="city" id="city">
					<option value="city" selected>區域</option>
					<? foreach($cities as $city): ?>
						<? if($city[2]['num_rows'] > 0): ?>
							<option value="<?=$city[1]?>"><?=$city[0].' ('.$city[2]['num_rows'].')';?></option>
						<? endif; ?>
					<? endforeach; ?>
				</select>
			</li>
		</ul>
	</div>
	</div>
	<div class="triangle-l"></div>
	<div class="triangle-r"></div>
</div>