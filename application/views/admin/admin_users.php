<!doctype html>

<html lang="zh-tw">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet/less" href="<?=site_url('css/admin.less');?>" />
		<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/smoothness/jquery-ui.css" />
		<script src="http://www.google.com/jsapi"></script>
		<script>
			google.load("jquery", "1.6.4");
			google.load("jqueryui", "1.8.16");
		</script>
		<script src="http://lesscss.googlecode.com/files/less-1.1.3.min.js"></script>
		<script>
			$(function(){$("#dialog-users").dialog({autoOpen:!1,height:420,width:500,modal:!0,buttons:{"\u66f4\u65b0":function(){$.ajax({url:updatehref,type:"POST",data:{email:$("#email").val(),like:$("#like input:radio:checked").val(),level:$("#level input:radio:checked").val(),sub:$("#sub input:radio:checked").val()},success:function(){$($("tbody#users tr#"+updateId+" td")[2]).html($("#email").val());$($("tbody#users tr#"+updateId+" td")[3]).html($("#like input:radio:checked").val());$($("tbody#users tr#"+ updateId+" td")[4]).html($("#level input:radio:checked").val());$($("tbody#users tr#"+updateId+" td")[5]).html($("#sub input:radio:checked").val());$("#level, #sub, #like").buttonset().button("refresh")}});$(this).dialog("close")},"\u53d6\u6d88":function(){$(this).dialog("close")}}});$("a.uedit").live("click",function(){updatehref=$(this).attr("href");updateId=$(this).parents("tr").attr("id");$.ajax({url:updatehref,dataType:"json",success:function(a){$("#email").val(a.email);$("#like").val(a.like); $("#level input:radio").each(function(){a.level.indexOf($(this).val())!=-1&&$(this).attr("checked",!0)});$("#sub input:radio").each(function(){a.sub.indexOf($(this).val())!=-1&&$(this).attr("checked",!0)});$("#like input:radio").each(function(){a.like.indexOf($(this).val())!=-1&&$(this).attr("checked",!0)});$("#level, #sub, #like").buttonset().button("refresh");$("#dialog-users").dialog("open")}});return!1});$("#level, #sub, #like").buttonset()});
		</script>
	</head>

	<body>
		<div id="content">
			<table>
				<thead>
					<? foreach($sorts as $sort_display): ?>
					<th>
						<?=$sort_display;?>
					</th>
					<? endforeach; ?>
					<th>管理</th>
				</thead>

				<tbody id="users">
					<? foreach($query->result() as $user): ?>
					<tr id="<?=$user->id;?>">
						<? foreach($sorts as $sort_name => $sort_display): ?>
							<td>
								<?=$user->$sort_name;?>
							</td>
						<? endforeach; ?>
						<td><?=anchor('admin/getid/users/id/'.$user->id, '編輯', 'class="uedit"')?></td>
					</tr>
					<? endforeach; ?>
				</tbody>
			</table>

			<div id="dialog-users" title="更新">
				<?=form_open();?>
					<p>
						<?=form_label('Email', 'email');?>
						<?=form_input('email', '', 'id="email"');?>
					</p>
					<p id="level">
						<?=form_label('等級', 'level');?>
						<?=form_radio(array('name' => 'level', 'id' => 'level1', 'value' => '1'));?><?=form_label('管理員', 'level1');?>
						<?=form_radio(array('name' => 'level', 'id' => 'level2', 'value' => '0'));?><?=form_label('使用者', 'level2');?>
					</p>
					<p id="sub">
						<?=form_label('訂閱', 'sub');?>
						<?=form_radio(array('name' => 'sub', 'id' => 'sub1', 'value' => '1'));?><?=form_label('是', 'sub1');?>
						<?=form_radio(array('name' => 'sub', 'id' => 'sub2', 'value' => '0'));?><?=form_label('否', 'sub2');?>
					</p>
					<p id="like">
						<?=form_label('喜好', 'like');?>
						<? foreach($categories as $key => $category): ?>
							<?=form_radio(array('name' => 'like', 'id' => "like$key", 'value' => $category[1]));?><?=form_label($category[0], "like$key");?>
						<? endforeach; ?>
					</p>
				<?=form_close();?>
			</div>

			<?=$pagination?>
		</div>
	</body>
</html>