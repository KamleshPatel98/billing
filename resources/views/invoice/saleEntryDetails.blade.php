<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sale Entry Details</title>
    <style>
        .container{
            margin:10px;
        }
        table,tr,th,td{
            border:1px solid black;
            border-collapse:collapse;
        }
        th{
            text-align:left;
        }
        th,td{
            padding:10px;
        }
        table{
            width:100%;
        }
        .right{
            text-align:right;
        }
        .spaace_arounnd{
            display:flex; 
            justify-content: space-between;"
        }
        .mt-2{
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <center>
        <h1>Patel Brothers</h1>
        <h4>Address: Raipur</h4>
    </center>
    <div class="container">
        <div class="right">
            Date : {{ \Carbon\Carbon::parse($sale_date)->format('d-m-Y') }}
        </div>
        <div class="right">
            Name: {{ ucfirst($customer_name) }}
        </div>
        <table class="mt-2">
            <thead>
                <tr>
                    <th>SN.</th>
                    <th>Item name</th>
                    <th>Unit Name</th>
                    <th class="right">Qty</th>
                    <th class="right">Price</th>
                    <th class="right">Total Price</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $amount=0;
                @endphp
                @foreach($sale_entries as $row)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $row->item_name }}</td>
                        <td>{{ $row->unit_name }}</td>
                        <td class="right">{{ $row->qty }}</td>
                        <td class="right">{{ $row->price }}</td>
                        <td class="right">{{ $row->totalPrice }}</td>
                    </tr>
                    @php
                        $amount += $row->totalPrice;
                    @endphp
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="6" class="right">Total Price: {{ $amount }}</th>
                </tr>
            </tfoot>
        </table>
    </div>
</body>
</html>