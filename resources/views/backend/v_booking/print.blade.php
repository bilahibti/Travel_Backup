<style>
    table {
        border-collapse: collapse;
        width: 100%;
        border: 1px solid #ccc;
    }

    table tr td {
        padding: 6px;
        font-weight: normal;
        border: 1px solid #ccc;
    }

    table th {
        border: 1px solid #ccc;
    }
</style>
<table>
    <!-- <tr>
        <td align="center">
            <img src="{{ asset('images/header.png') }}" width="50%">
        </td>
    </tr> -->
    <tr>
        <td align="left">
            Subject : {{ $judul }} <br>
            Start Date: {{ $startdate }} s/d End Date: {{ $enddate }}
        </td>
    </tr>
</table>
<p></p>
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Booking Code</th>
            <th>Customer</th>
            <th>Type</th>
            <th>Travel Date</th>
            <th>Return Date</th>
            <th>Persons</th>
            <th>Total Price</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($cetak as $row)
        <tr>
            <td> {{ $loop->iteration }} </td>
            <td> {{ $row->booking_code }} </td>
            <td>
                @if ($row->user)
                    {{ $row->user->name }}
                @else
                    {{ $row->contact_name }}
                @endif
            </td>
            <td> {{ ucfirst($row->type) }} </td>
            <td> {{ $row->travel_date ? \Carbon\Carbon::parse($row->travel_date)->format('d-m-Y') : '-' }} </td>
            <td> {{ $row->return_date ? \Carbon\Carbon::parse($row->return_date)->format('d-m-Y') : '-' }} </td>
            <td> {{ $row->total_persons }} </td>
            <td> Rp {{ number_format($row->total_price, 0, ',', '.') }} </td>
            <td> {{ ucfirst(str_replace('_', ' ', $row->status)) }} </td>
        </tr>
        @endforeach
    </tbody>
</table>

<script>
    window.onload = function() {
        printStruk();
    }

    function printStruk() {
        window.print();
    }
</script>
