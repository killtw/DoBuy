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
			$(function(){$("#dialog-deals").dialog({autoOpen:!1,height:420,width:500,modal:!0,buttons:{"\u66f4\u65b0":function(){var a=[];$("input:checkbox:checked").each(function(){a.push($(this).val())});$.ajax({url:updatehref,type:"POST",data:{title:$("#title").val(),price:$("#price").val(),worth:$("#worth").val(),city:$("#city").val(),category:a.join(", ")},success:function(){$($("tbody#deals tr#"+updateId+" td")[1]).html($("#title").val());$($("tbody#deals tr#"+updateId+" td")[2]).html($("#price").val()); $($("tbody#deals tr#"+updateId+" td")[3]).html($("#worth").val());$($("tbody#deals tr#"+updateId+" td")[4]).html($("#city").val());$($("tbody#deals tr#"+updateId+" td")[5]).html(a.join(", "));$("#category").button("refresh")}});$(this).dialog("close")},"\u53d6\u6d88":function(){$(this).dialog("close")}}});$("a.edit").live("click",function(){updatehref=$(this).attr("href");updateId=$(this).parents("tr").attr("id");$.ajax({url:updatehref,dataType:"json",success:function(a){$("#title").val(a.title); $("#price").val(a.price);$("#worth").val(a.worth);$("#city").val(a.city);$("input:checkbox").each(function(){$(this).attr("checked",!1);a.category.indexOf($(this).val())!=-1&&$(this).attr("checked",!0)});$("#category").buttonset().button("refresh");$("#dialog-deals").dialog("open")}});return!1});$("#category").buttonset()});
		</script>
	</head>

	<body>
		<div id="content">
			<table>
				<thead>
					<? foreach($sorts as $sort_name => $sort_display): ?>
					<th <? if ($by == $sort_name) echo "class=\"sort_$order\"" ?>>
						<?=anchor("admin/deals/$sort_name/".(($order == 'asc' && $by == $sort_name) ? 'desc' : 'asc'), $sort_display);?>
					</th>
					<? endforeach; ?>
					<th>管理</th>
				</thead>

				<tbody id="deals">
					<? foreach($query->result() as $deal): ?>
					<tr id="<?=$deal->id;?>">
						<? foreach($sorts as $sort_name => $sort_display): ?>
							<td>
								<?=$deal->$sort_name;?>
							</td>
						<? endforeach ?>
						<td><?=anchor("admin/getid/deals/id/$deal->id", '編輯', 'class="edit"')?></td>
					</tr>
					<? endforeach; ?>
				</tbody>
			</table>

			<div id="dialog-deals" title="更新">
				<?=form_open();?>
					<p>
						<?=form_label('標題', 'title');?>
						<?=form_input('title', '', 'id="title"');?>
					</p>
					<p>
						<?=form_label('特價', 'price');?>
						<?=form_input('price', '', 'id="price"');?>
					</p>
					<p>
						<?=form_label('原價', 'worth');?>
						<?=form_input('worth', '', 'id="worth"');?>
					</p>
					<p>
						<?=form_label('城市', 'city');?>
						<?=form_dropdown('city', $cities, '', 'id="city"');?>
					</p>
					<p id="category">
						<?=form_label('分類', 'category[]');?>
						<? foreach($categories as $key => $category): ?>
							<?=form_checkbox(array('name' => 'category[]', 'id' => "category$key", 'value' => $category[0]))?><?=form_label($category[1], "category$key")?>
						<? endforeach; ?>
					</p>
				<?=form_close();?>
			</div>

			<?=$pagination?>
		</div>
	</body>
</html>