@extends('printables.print_layouts.print_layout_main')

@section('wrapper')

{{--    @include('sms.printables.forms.form4a')--}}
    @include('sms.printables.forms.form1')
    <hr class="page-break no-print">

    @include('sms.printables.forms.form2')

    <hr class="page-break no-print">

    @include('sms.printables.forms.form3')
    <hr class="page-break no-print">

    @include('sms.printables.forms.form5')
    <hr class="page-break no-print">

    @include('sms.printables.forms.form5a')
    <hr class="page-break no-print">

    @include('sms.printables.forms.form6a')
@endsection