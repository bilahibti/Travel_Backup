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
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Role</th> 
        </tr> 
    </thead> 
    <tbody> 
        @foreach ($print as $row) 
        <tr> 
            <td> {{ $loop->iteration }} </td> 
            <td> {{$row->name}} </td> 
            <td> {{$row->email}} </td> 
            <td>{{ $row->hp }}</td>
            <td>
                @if ($row->role)
                    {{ $row->role->name }}
                @else
                    No Role
                @endif
            </td> 
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