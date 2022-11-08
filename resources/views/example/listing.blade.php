<p style="text-align: center">
    HELLO WORLD
</p>

<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>MILL CODE</th>
        <th>Report No.</th>
    </tr>
    </thead>
    @foreach($weeklyReports as $weeklyReport)
        <tr>
            <td>{{$weeklyReport->id}}</td>
            <td>{{$weeklyReport->mill_code}}</td>
            <td>{{$weeklyReport->report_no}}</td>
        </tr>
    @endforeach
</table>