(function( $ ) {

	'use strict';

	$(function() {

		var data = {};
		data.onepageily_plugins_list = 'yes';
		$.ajax({
			url: document.URL,
			cache: false,
			type: "get",
			data: data,
			success: function(response) {

				if( $( response ).find('.onepageily-addons-list').length > 0 ) {

					$('.onepageily-addons-list').replaceWith( $( response ).find('.onepageily-addons-list') );
				}
			}
		});
	});

})( jQuery );
