@extends('layouts.modal-content')

@section('modal-header')
{{$pp->position}}
@endsection

@section('modal-body')

    {!! \App\Swep\ViewHelpers\__html::line('Previous employee(s) occupying this item') !!}
    @if(!empty($pp->occupants))
        <table class="table table-bordered table-condensed table-striped">
            <thead>
                <tr>
                    <th>Emp. No.</th>
                    <th>Employee No.</th>
                    <th>Appt. Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pp->occupants as $occupant)
                    <tr>
                        <td>{{$occupant->employee_no}}</td>
                        <td>{{(!empty($occupant->employee) ? $occupant->employee->lastname.', '.$occupant->employee->firstname.' '.$occupant->employee->middlename[0].'.' : "N/A")}}</td>
                        <td>{{(!empty($occupant->employee) ? \Illuminate\Support\Carbon::parse($occupant->appointment_date)->format('F d, Y') : "N/A")}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    @endif


@endsection

@section('modal-footer')

@endsection

@section('scripts')

@endsection

