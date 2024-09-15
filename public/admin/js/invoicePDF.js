$(document).ready(function () {
    var table = $("#invoice").DataTable({
        dom: "Bfrtip",
        buttons: [
            {
                extend: "collection",
                text: "Ekspor",
                buttons: [
                    { extend: "csv", text: "Ekspor ke CSV" },
                    { extend: "excel", text: "Ekspor ke Excel" },
                    { extend: "pdf", text: "Ekspor ke PDF" },
                ],
            },
        ],
    });

    $('#filterForm').on('submit', function (e) {
        e.preventDefault();
        var tahunPeriode = $('#tahunPeriode').val();
        $.ajax({
            url: '{{ url(' / ') }}',
            method: 'GET',
            data: { tahun_periode: tahunPeriode },
            success: function (response) {
                $('#surveyResults').html(response);
                table.draw();
            }
        });
    });
});
