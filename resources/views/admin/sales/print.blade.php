<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Receipt</title>
    <style>
        body {
            font-size: 24px; /* Adjust font size for A7 paper */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px; /* Add some margin between sections */
        }

        th, td {
            border: 1px solid #000; /* Add borders to table cells */
            padding: 2px;
        }

        tfoot td {
            font-weight: bold;
        }

        h2 {
            margin-top: 10px; /* Add margin to the top of headings */
        }
    </style>
</head>
<body>
    <h2>Tanda Terima Penjualan</h2>
    <p>Kode Transaksi: {{ $sale->transaction_code }}</p>
    <p>Tanggal: {{ $sale->sale_date }}</p>
    <p>Penjual: {{ $sale->user->name }}</p>

    <table>
        <thead>
            <tr>
                <th>Produk</th>
                <th>Jumlah Unit</th>
                <th>Harga Satuan</th>
                <th>Potongan</th>
                <th>Total</th>
                <!-- Include other columns as needed -->
            </tr>
        </thead>
        <tbody>
            @foreach($soldWithProduct as $soldProduct)
                <tr>
                    <td>{{ $soldProduct['product_name'] }}</td>
                    <td>{{ $soldProduct['quantity'] }}</td>
                    <td>{{ $soldProduct['unit_price'] }}</td>
                    <td>{{ $soldProduct['discount'] }}</td>
                    <td>{{ $soldProduct['total_amount'] }}</td>
                    <!-- Include other columns as needed -->
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" style="text-align: right;">Grand Total :</td>
                <td>{{$sale->grand_total}}</td>
            </tr>
            <tr>
                <td colspan="4" style="text-align: right;">Total Uang :</td>
                <td>{{$sale->amount_paid}}</td>
            </tr>
            <tr>
                <td colspan="4" style="text-align: right;">Kembalian :</td>
                <td>{{$sale->change_due}}</td>
            </tr>
        </tfoot>
    </table>

    <!-- Include other sections as needed -->

</body>
</html>
