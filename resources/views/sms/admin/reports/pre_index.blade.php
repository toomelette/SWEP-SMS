@extends('layouts.admin-master')

@section('content')

    <section class="content-header">

    </section>
@endsection
@section('content2')

    <section class="content">
        <div class="login-box">
            <div class="login-logo">
                Select Report No. & Crop Year
            </div>

            <div class="login-box-body">
                <form id="" method="GET" action="{{route('dashboard.reports.index')}}">
                    @csrf
                    <div class="row">
                        {!! \App\Swep\ViewHelpers\__form2::select('crop_year',[
                            'label' => 'Crop Year:*',
                            'cols' => 12,
                            'options' => \App\Swep\Helpers\Arrays::cropYears(),
                            'required' => 'required',
                        ]) !!}
                        {!! \App\Swep\ViewHelpers\__form2::textbox('report_no',[
                            'label' => 'Report No.:*',
                            'cols' => 12,
                            'type' => 'number',
                            'step' => 1,
                            'required' => 'required',
                        ]) !!}
                    </div>
                    <button type="submit" class="btn btn-primary btn-block btn-flat">
                        <i class="fa fa-search"> </i> FIND
                    </button>
                </form>

            </div>

        </div>

    </section>


@endsection


@section('modals')

@endsection

@section('scripts')
    <script type="text/javascript">

    </script>
@endsection