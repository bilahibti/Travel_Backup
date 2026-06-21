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
            <th>Package Name</th>
            <th>Destination</th>
            <th>Type</th>
            <th>Price</th>
            <th>Quota</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($cetak as $row)
        <tr>
            <td> {{ $loop->iteration }} </td>
            <td> {{ $row->packages_name }} </td>
            <td>
                @if ($row->destination)
                    {{ $row->destination->destination_name }}
                @else
                    -
                @endif
            </td>
            <td> {{ $row->package_type }} </td>
            <td> Rp {{ number_format($row->price_packages, 0, ',', '.') }} </td>
            <td> {{ $row->quota }} </td>
            <td> {{ $row->status }} </td>
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
