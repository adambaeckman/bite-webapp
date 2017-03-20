/**
 * Functions for template-projects.php
 *
 */

( function( $ ) {

	$( document ).ready( function() {

        // Set up DataTable
        $('#vacancies-table').DataTable({
            dom: '<"top-bar main-content clear"if>rt<"clear">',
            autoWidth: false,
            iDisplayLength: -1,
            aaSorting: [[1,'asc']],
            aoColumns: [
            { "bSortable": false },
            null,
            null,
            null,
            { "bSortable": false }
            ],
            language: {
                sEmptyTable: "Det finns inga jobb att söka nu tyvärr, men kom gärna tillbaka senare.",
                sInfo: "Det finns _TOTAL_ jobb just nu",
                sInfoEmpty: "Inga jobb just nu",
                sInfoFiltered: "som matchar din sökning",
                sInfoPostFix: "",
                sInfoThousands: " ",
                sLengthMenu: "Visa _MENU_ rader",
                sLoadingRecords: "Laddar...",
                sProcessing: "Bearbetar...",
                sSearch: "_INPUT_",
                sSearchPlaceholder: "Sök",
                sZeroRecords: "Inga jobb matchar din sökning.",
                oPaginate: {
                sFirst: "Första",
                sLast: "Sista",
                sNext: "Nästa",
                sPrevious: "Föregående"
            },
                oAria: {
                    sSortAscending: ": aktivera för att sortera kolumnen i stigande ordning",
                    sSortDescending: ": aktivera för att sortera kolumnen i fallande ordning"
                }
            }
        });

        // Make row clickable and redirect
        $(".has-link").click(function() {
            window.document.location = $(this).data("href");
        });

	});

} )( jQuery );
