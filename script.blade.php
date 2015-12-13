{!! Html::script('js/jquery-2.1.4.min.js') !!}
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
{!! Html::script('js/bootstrap.min.js')!!}
<script>
    
    $(function(){

    	// delete item
        $('.admin-delete-news').on('submit', function(){
			if (confirm("Are you sure?")){
				return true;
			}else{
				return false;
			}
		});

		// drag n drop post sorting
		$.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
		});

		// url
		var sortNewsHref =  '{{ url('/admin/sortNews') }}',
			// elements to sort
			news = '.news-list';

		// sort function
		sortItems(sortNewsHref, news);


    });


	// sort drag n drop, asynchronous database update
	function sortItems(func, items){

		$(items).sortable({
			// empty box effect on dropping
			placeholder: "ui-state-highlight",
			// element class
			over: function( event, ui ) {
				ui.item.addClass('dropping');
			},
			// set new array order
			update: function( event, ui ) {
				var sorted = $(this).sortable('toArray');
				$.ajax({
					url: func,
					type: 'post',
					data: { newOrder: sorted },
					error: function(){
						console.log('err');
					}
				});
				ui.item.removeClass('dropping');
			},
			// update db
			stop: function( event, ui ) {

			},
		}).disableSelection();

	}


</script>