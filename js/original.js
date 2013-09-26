function textReplacement(input){
	var subscribetip = input.val();
	input.focus( function(){
		if( $.trim(input.val()) == subscribetip ){ input.val(''); }
	});
	input.blur( function(){
		if( $.trim(input.val()) == '' ){ input.val(subscribetip); }
	});
}

$(function() {
	textReplacement($('#autocomplete'));
	$('#autocomplete').autocomplete({
		source: function(request, response) {
			$.ajax({
				url: 'http://127.0.0.1/dobuy/home/autocomplete',
				data: {term: $('#autocomplete').val()},
				dataType: 'json',
				type: 'POST',
				success: function(data){
					response(data);
				}
			});
		},
		focus: function(event, ui) {
			$("#autocomplete").val(ui.item.label);
			return false;
		},
		select: function(event, ui) {
			$.ajax({
				url: 'http://127.0.0.1/dobuy/home/search',
				data: {search: ui.item.label, action: 'ajax'},
				dataType: 'html',
				type: 'POST',
				success: function(data) {
					$('#content').html(data);
				}
			})
		},
		minLength: 1,
		autoFocus: true
	});
	$('#search').submit(function() {
		$.ajax({
			url: 'http://127.0.0.1/dobuy/home/search',
			data: {action: 'ajax', search: $("#autocomplete").val()},
			dataType: 'html',
			type: 'POST',
			success: function(data) {
				$('#content').html(data);
				$('html, body').animate({scrollTop: $('#content').offset().top}, 'slow');
			}
		});
		return false;
	});
	$('.pagebar a, .sort a').live('click', function(e) {
		e.preventDefault();
		var page = {
			content: $('#content'),
			target: $(this).attr('href')
		};
		$.ajax({
			url: page.target,
			data: {action: 'ajax'},
			dataType: 'html',
			type: 'POST',
			beforeSend: function() {
				$('.pagebar').html('<img src="http://127.0.0.1/dobuy/image/loading.gif"> Loading…');
			},
			success: function(data) {
				page.content.html(data);
				$('html, body').animate({scrollTop: page.content.offset().top}, 'slow');
			}
		});
		return false;
	});
	$('#category').change(function() {
		$.ajax({
			url: 'http://127.0.0.1/dobuy/home/category/'+$("#category").val(),
			data: {action: 'ajax'},
			dataType: 'html',
			type: 'POST',
			success: function(data) {
				$("#category").val("category");
				$('#content').html(data);
				$('html, body').animate({scrollTop: $('#content').offset().top}, 'slow');
			}
		});
		return false;
	});
	$('#city').change(function() {
		$.ajax({
			url: 'http://127.0.0.1/dobuy/home/city/'+$("#city").val(),
			data: {action: 'ajax'},
			dataType: 'html',
			type: 'POST',
			success: function(data) {
				$("#city").val("city");
				$('#content').html(data);
				$('html, body').animate({scrollTop: $('#content').offset().top}, 'slow');
			}
		});
		return false;
	});
	$('#dialog-users').dialog({
		autoOpen: false,
		height: 200,
		width: 400,
		modal: true,
		buttons: {
			'更新': function() {
				$.ajax({
					url: updatehref,
					type: 'POST',
					data: {
						like: $('#like input:radio:checked').val(),
						sub: $('#sub input:radio:checked').val()
					},
					success: function(response) {
						$('#like, #sub').buttonset().button('refresh');
					}
				});
				$(this).dialog('close');
			},
			'取消': function() {
				$(this).dialog('close');
			}
		}
	});
	$('a.uedit').live('click', function() {
		updatehref = $(this).attr('href');
		updateId = $(this).parents('tr').attr("id");
		$.ajax({
			url: updatehref,
			dataType: 'json',
			success: function(response){
				$('#like input:radio').each(function() {
					if(response.like.indexOf($(this).val()) != -1) $(this).attr('checked', true);
				});
				$('#sub input:radio').each(function() {
					if(response.sub.indexOf($(this).val()) != -1) $(this).attr('checked', true);
				});
				$('#like, #sub').buttonset().button('refresh');
				$('#dialog-users').dialog('open');
			}
		});
		return false;
	});
	$('#like, #sub').buttonset();
});