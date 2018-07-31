( function( api ) {

	// Extends our custom "one-pageily" section.
	api.sectionConstructor['one-pageily'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );
