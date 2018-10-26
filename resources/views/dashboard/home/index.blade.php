@extends('layouts.admin-master')

@section('content')

<section class="content-header">
    <h1>Dashboard</h1>
</section>

<section class="content">


  <div class="row">

    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3>{{ $count_active_emp }}</h3>

          <p>Total Active Employees</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
      </div>
    </div>

    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-green">
        <div class="inner">
          <h3>{{ $count_online_users }}</h3>

          <p>Online User/s</p>
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>
      </div>
    </div>

    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3>&nbsp;</h3>

          <p>&nbsp;</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
      </div>
    </div>

    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-red">
        <div class="inner">
          <h3>&nbsp;</h3>

          <p>&nbsp;</p>
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>
      </div>
    </div>

  </div>



  <div class="row">
    {!! __chart::div_flot_bar('6', 'emp_by_dept_bar' ,'Employee by Department') !!}
    {!! __chart::div_flot_donut('6', 'emp_by_gender_donut' , 'Employee by Gender') !!}
  </div>


</section>

@endsection





@section('scripts')

<script>

    $(function () {


      {!! 
          __chart::js_flot_bar('emp_by_dept_bar',
           '["AFD", '. $get_emp_by_dept['AFD'] .'],
            ["IAD", '. $get_emp_by_dept['IAD'] .'],
            ["PPD", '. $get_emp_by_dept['PPD'] .'],
            ["RDE", '. $get_emp_by_dept['RDE'] .'],
            ["RD", '. $get_emp_by_dept['RD'] .'],
            ["LEGAL", '. $get_emp_by_dept['LEGAL'] .']'
        ) 
      !!}



      {!! 
          __chart::js_flot_donut('emp_by_gender_donut',
              '[
                { label: "Female", data: '. $count_female_emp  .' , color: "#BF3F3F" },
                { label: "Male", data: '. $count_male_emp  .', color: "#3F7FBF" },
              ]
          ') 
      !!}
      


      // Chart label Formatter
      function labelFormatter(label, series) {
          return '<div style="font-size:13px; text-align:center; padding:2px; color: #fff; font-weight: 600;">'
            + label
            + '<br>'
            + Math.round(series.percent) + '%</div>'
      }


    });

</script>

@endsection