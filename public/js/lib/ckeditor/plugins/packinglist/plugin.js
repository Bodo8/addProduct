/**
 * Plugin dla list pakowania
 */
CKEDITOR.plugins.add( 'packinglist', {
	init: function( editor ) {

        editor.addCommand( 'selectOrder', new CKEDITOR.dialogCommand( 'orderDialog' ) );

		editor.ui.addButton( 'Timestamp', {
			label: 'Dodaj zamówienie',
			command: 'selectOrder',
			toolbar: 'insert',
            icon: this.path + '/icons/plus.png'
		});

        CKEDITOR.dialog.add( 'orderDialog', this.path + 'dialogs/order.js' );
	}
});
