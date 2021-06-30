/**
 * Okno dialogowe dodawaniazamówienia
 */
CKEDITOR.dialog.add( 'orderDialog', function( editor ) {
    return {
        title: 'Dodaj zamówienie',
        minWidth: 300,
        minHeight: 100,

        contents: [
            {
                id: 'tab-adv',
                label: 'ID zamówienia',
                elements: [
                    {
                        // konfiguracja pola ID
                        type    : 'text',
                        id      : 'id',
                        label   : 'ID Zamówienia',
                        validate: CKEDITOR.dialog.validate.notEmpty( "Pole ID nie  może być puste" ),

                        // akcja po kliknięiu OK
                        commit: function ( element ) {
                            var id = this.getValue();

                            $.ajax({
                                url: '/packing-list/get-order/' + id
                            }).done(function (data) {
                                if (data.success === false) {
                                    alert("Nie ma takiego zamówienia");
                                    return true;
                                }

                                element.appendHtml('<h3><strong>Zamówienie ' + data.id + '</strong> ' +
                                    '<i>' + data.company + ' ' + data.name + '</i></h3>');

                                var letter = "";

                                for (var i = 0; i < data.letters.length; i++) {
                                    letter = letter + data.letters[i] + ", ";
                                }

                                element.appendHtml('<p>' + letter + '</p>');

                                for (var i = 0; i < data.details.length; i++) {
                                    element.appendHtml('<div>' + data.details[i].quantity +' szt. ' + data.details[i].index + '</div>');
                                }
                            });
                        }
                    }
                ]
            }
        ],

        /**
         * Uruchomienie okna - stworzenie elementu do edycji
         */
        onShow: function() {
            var selection = editor.getSelection();
            var element = selection.getStartElement();

            if ( element )
                element = element.getAscendant( 'div', true );

            if ( !element || element.getName() != 'div' ) {
                element = editor.document.createElement( 'div' );

                this.insertMode = true;
            }
            else
                this.insertMode = false;

            this.element = element;

            if ( !this.insertMode )
                this.setupContent( this.element );
        },

        /**
         * Kliknięcie OK dodanie elementu do edytora
         */
        onOk: function() {
            this.commitContent( this.element );

            if ( this.insertMode ) {
                editor.insertElement(this.element);
            }
        }
    };
})
