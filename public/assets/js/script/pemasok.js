$(document).ready(function() {

	// search
	$('#search').on('keyup', function() {

		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    var value = $('#search').val();
		$('.loader').show();

		if (value != '') {
			$.ajax({
				url: '/pemasok/search',
				type: 'post',
				data: {
					_token:CSRF_TOKEN,
					value:value,
				},
				success:function(data) {
					$('#tabel').html(data);
					$('#paginate').hide();
					$('.loader').hide();
				}
			})
		} else {
			$.ajax({
				url: '/pemasok/search',
				type: 'post',
				data: {
					_token:CSRF_TOKEN,
					value:value,
				},
				success:function(data) {
					$('#tabel').html(data);
					$('#paginate').show();
					$('.loader').hide();
				}
			})
		}
	});

  // pagination
	$(document).on('click', '.pagination a', function (e) {
		e.preventDefault();
		var page = $(this).attr('href').split('page=')[1];
		getPage(page);
		$('.loader').show();
	});

	function getPage(page) {
		$.ajax({
			url : '/pemasok?page=' + page,
			dataType: 'json',
			success:function(data) {
				$('#tabel').html(data);
				$('.loader').hide();
			}
		});
	};

	$('#main_form').on('submit', function(e){
		e.preventDefault();

		$.ajax({
			url : $(this).attr('action'),
			method : $(this).attr('method'),
			data : new FormData(this),
			processData : false,
			dataType : 'json',
			contentType : false,
			beforeSend : function(){
				$(document).find('span.error-text').text('');
			},
			success:function(data){
				if(data.status == 0){
					$.each(data.error, function(prefix, val){
						$('span.'+prefix+'_error').text(val[0]);
					});
				}else{
					window.location.href = "/pemasok";
					alert(data.msg);
				}
			}
		});
	});

});

