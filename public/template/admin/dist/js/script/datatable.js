$(function(){

    /**
    * Datatable  - repertoire
    */
    $('#repertoire_list').DataTable({
        "lengthMenu": [
            [15, 30, 60,100,150, -1],
            [15, 30, 60,100,150, "All"]
        ],
        "order": [
            [1, "desc"]
        ],
        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"

        }
        });
        
    /**
    * Datatable  - religion
    */
    $('#list_religion').DataTable({
        "lengthMenu": [
            [15, 30, 60,100,150, -1],
            [15, 30, 60,100,150, "All"]
        ],
        "order": [
            [1, "desc"]
        ],
        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
        }
        
        });
    /**
    * Datatable  - religion
    */
    $('#liste').DataTable({
        "lengthMenu": [
            [15, 30, 60,100,150, -1],
            [15, 30, 60,100,150, "All"]
        ],
        "order": [
            [1, "desc"]
        ],
        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
        }
        
        });

});