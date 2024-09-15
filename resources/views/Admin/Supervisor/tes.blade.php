<!DOCTYPE html>
<html>

<head>
    <title>Midtrans Payment</title>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.clientKey') }}"></script>
</head>

<body>
    <h1>Midtrans Payment</h1>
    <button id="pay-button">Pay Now</button>

    <script type="text/javascript">
        document.getElementById('pay-button').addEventListener('click', function() {
            snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    console.log('Payment success:', result);
                    // Handle success
                },
                onPending: function(result) {
                    console.log('Payment pending:', result);
                    // Handle pending
                },
                onError: function(result) {
                    console.log('Payment error:', result);
                    // Handle error
                },
                onClose: function() {
                    console.log('Payment popup closed');
                }
            });
        });
    </script>
</body>

</html>

$(document).ready(function () {
var table = $("#hasil_survey").DataTable({
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

$('#filterForm').on('submit', function(e) {
e.preventDefault();
var tahunPeriode = $('#tahunPeriode').val();
$.ajax({
url: '{{ url('/') }}',
method: 'GET',
data: { tahun_periode: tahunPeriode },
success: function(response) {
$('#surveyResults').html(response);
table.draw();
}
});
});
});
--------------------
<table id="hasil_survey" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>Id Jawaban</th>
            <th>Id Pertanyaan</th>
            <th>Id Alumni</th>
            <th>jawaban</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($jawaban as $jawaban)
        <tr>
            <td>{{ $jawaban->id_jawaban }}</td>
            <td>{{ $jawaban->id_pertanyaan }}</td>
            <td>{{ $jawaban->id_alumni }}</td>
            <td>{{ $jawaban->teks_jawaban }}</td>
        </tr>
        @endforeach
    </tbody>
            
</table>