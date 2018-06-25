jQuery(document).ready(function($) {
    $("#tabela1").DataTable( {
        "lengthMenu": [ [ 20, 50, 75, 100, -1 ], [ 20, 50, 75, 100, "All" ] ],
        "order": [ 0, 'desc' ],
        "language": {
            "emptyTable":     "Brak danych w tabeli",
            "info":           "Widok _START_ do _END_ z _TOTAL_ pozycji",
            "infoEmpty":      "Widok 0 do 0 z 0 pozycji",
            "infoFiltered":   "(filtrowane z _MAX_ pozycji)",
            "infoPostFix":    "",
            "lengthMenu":     "Pokaż _MENU_ pozycji",
            "loadingRecords": "Ładowanie...",
            "processing":     "Processing...",
            "search":         "Szukaj:",
            "zeroRecords":    "Nie znaleziono pasujących wpisów",
            "paginate": {
                "first":      "Pierwszy",
                "last":       "Ostatni",
                "next":       "Następny",
                "previous":   "Poprzedni"
            },
        }
    }); 
});

