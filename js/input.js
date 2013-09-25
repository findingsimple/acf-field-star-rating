(function($){
	
	
	/*
	*  acf/setup_fields
	*
	*  This event is triggered when ACF adds any new elements to the DOM. 
	*
	*  @type	function
	*  @since	1.0.0
	*  @date	01/01/12
	*
	*  @param	event		e: an event object. This can be ignored
	*  @param	Element		postbox: An element which contains the new HTML
	*
	*  @return	N/A
	*/
	
	$(document).live('acf/setup_fields', function(e, postbox){
			
		$(postbox).find('.star_rating').each(function(){
			
			var field_path = $(this).attr('data-path');
			var field_target = $(this).attr('data-target');
			var field = $(this).attr('data-field');
						
			$( field ).raty({
				score: function() {
					return $(this).attr('data-score');
				},
				number: function() {
					return $(this).attr('data-number');
				},
				target: field_target,
				targetType: 'score',
				targetKeep: true,
				half: true,
				path: field_path,
				click: function( score, evt ) {
					update_rating_average( score, $(this).closest('.inside') );
    			}
			});
						
		});

		$(postbox).find('.star_rating_average').each(function(){
			
			var field_path = $(this).attr('data-path');
			var field_target = $(this).attr('data-target');
			var field = $(this).attr('data-field');
						
			$( field ).raty({
				score: function() {
					return $(this).attr('data-score');
				},
				number: function() {
					return $(this).attr('data-number');
				},
				target: field_target,
				targetType: 'score',
				targetKeep: true,
				half: true,
				path: field_path,
				readOnly: true
			});
						
		});
		
		function update_rating_average( score, box ) {
			
						
			if ( $(box).find( '.star_rating_average' ).length >= 1 ) {
			
				var count = 0;
				
				var overall_score = 0;
								
				$(box).find('.star_input').each(function(){
				
					var grab_score = $(this).val();

					overall_score = overall_score + parseFloat( grab_score );
					
					count++;
									
				});
				
				overall_score = overall_score / count;

				$(box).find('.star_rating_average').find('.stars').raty('set', { score: overall_score });
			
			}
			
		}
	
	});

})(jQuery);
