@extends('layouts.admin-master')

@section('content')
    
  <section class="content-header">
      <h1>Employee Matrix</h1>
  </section>

  <section class="content">

    <div class="box">
    
		<div class="box-header with-border">
			<h3 class="box-title">Form</h3>
			<div class="pull-right">
			    <code>Fields with asterisks(*) are required</code>
			</div> 
		</div>

        <form role="form" method="POST" autocomplete="off" action="{{ route('dashboard.employee.matrix_update', $employee->slug) }}">

	    <div class="box-body">
	 
	      	@csrf    
	      	
	      	<div class="col-md-6">

	          	<h4>Education</h4>

	          	<ol>	
	          		<li> Bachelor's Degree Graduate

	          			{!! __form::textbox(
			             	'12', 'educ_bachelors_degree', 'number', '', 'Score', old('educ_bachelors_degree'), $errors->has('educ_bachelors_degree'), $errors->first('educ_bachelors_degree'), 'step="any"'
			         	) !!} 

			        </li>	

	          		<li>College Undergraduate
	          			
	          			<div class="col-md-12">
	          			
		          			{!! __form::textbox(
				            	'6', 'educ_undergrad_bachelor_units_earned', 'number', '', 'Units Earned', old('educ_undergrad_bachelor_units_earned'), $errors->has('educ_undergrad_bachelor_units_earned'), $errors->first('educ_undergrad_bachelor_units_earned'), 'step="any"'
				         	) !!} 

		          			{!! __form::textbox(
				            	'6', 'educ_undergrad_bachelor', 'number', '', 'Score', old('educ_undergrad_bachelor'), $errors->has('educ_undergrad_bachelor'), $errors->first('educ_undergrad_bachelor'), 'step="any"'
				         	) !!} 
	          					
	          			</div>

			        </li>	

	          		<li>Master's Degree Graduate

	          			{!! __form::textbox(
			             	'12', 'educ_masters_degree', 'number', '', 'Score', old('educ_masters_degree'), $errors->has('educ_masters_degree'), $errors->first('educ_masters_degree'), 'step="any"'
			         	) !!} 

	          		</li>

	          		<li>Doctoral Degree Graduate

	          			{!! __form::textbox(
			             	'12', 'educ_doctoral_degree', 'number', '', 'Score', old('educ_doctoral_degree'), $errors->has('educ_doctoral_degree'), $errors->first('educ_doctoral_degree'), 'step="any"'
			         	) !!} 

	          		</li>

	          		<li>Undergraduate Masteral/Doctoral
	          			
	          			<div class="col-md-12">
	          			
		          			{!! __form::textbox(
				            	'6', 'educ_undergrad_masteral_units_earned', 'number', '', 'Units Earned', old('educ_undergrad_masteral_units_earned'), $errors->has('educ_undergrad_masteral_units_earned'), $errors->first('educ_undergrad_masteral_units_earned'), 'step="any"'
				         	) !!} 

		          			{!! __form::textbox(
				            	'6', 'educ_undergrad_masteral', 'number', '', 'Score', old('educ_undergrad_masteral'), $errors->has('educ_undergrad_masteral'), $errors->first('educ_undergrad_masteral'), 'step="any"'
				         	) !!} 
	          					
	          			</div>

	          		</li>

	          		<li>Graduate Certificate Course

	          			{!! __form::textbox(
			             	'12', 'educ_grad_certificate_course', 'number', '', 'Score', old('educ_grad_certificate_course'), $errors->has('educ_grad_certificate_course'), $errors->first('educ_grad_certificate_course'), 'step="any"'
			         	) !!} 

	          		</li>

	          		<li>Honors / Awards Recieved / Distinctions:
	          			<ul>	
	          				<li>Summa Cum Laude

			          			{!! __form::textbox(
					             	'12', 'educ_distinctions_summa_cum_laude', 'number', '', 'Score', old('educ_distinctions_summa_cum_laude'), $errors->has('educ_distinctions_summa_cum_laude'), $errors->first('educ_distinctions_summa_cum_laude'), 'step="any"'
					         	) !!} 

	          				</li>

	          				<li>Magna Cum Laude

			          			{!! __form::textbox(
					             	'12', 'educ_distinctions_magna_cum_laude', 'number', '', 'Score', old('educ_distinctions_magna_cum_laude'), $errors->has('educ_distinctions_magna_cum_laude'), $errors->first('educ_distinctions_magna_cum_laude'), 'step="any"'
					         	) !!} 

	          				</li>

	          				<li>Cum Laude / With Honors

			          			{!! __form::textbox(
					             	'12', 'educ_distinctions_cum_laude', 'number', '', 'Score', old('educ_distinctions_cum_laude'), $errors->has('educ_distinctions_cum_laude'), $errors->first('educ_distinctions_cum_laude'), 'step="any"'
					         	) !!} 

	          				</li>

	          				<li>Presidential Awardee

			          			{!! __form::textbox(
					             	'12', 'educ_distinctions_pres_awardee', 'number', '', 'Score', old('educ_distinctions_pres_awardee'), $errors->has('educ_distinctions_pres_awardee'), $errors->first('educ_distinctions_pres_awardee'), 'step="any"'
					         	) !!} 

	          				</li>

	          				<li>CSC / SRA / DA Awardee

			          			{!! __form::textbox(
					             	'12', 'educ_distinctions_csc_sra_da_awardee', 'number', '', 'Score', old('educ_distinctions_csc_sra_da_awardee'), $errors->has('educ_distinctions_csc_sra_da_awardee'), $errors->first('educ_distinctions_csc_sra_da_awardee'), 'step="any"'
					         	) !!} 

	          				</li>

	          				<li>Top 10 government licensure administered exams

			          			{!! __form::textbox(
					             	'12', 'educ_distinctions_top_gov_exam', 'number', '', 'Score', old('educ_distinctions_top_gov_exam'), $errors->has('educ_distinctions_top_gov_exam'), $errors->first('educ_distinctions_top_gov_exam'), 'step="any"'
					         	) !!} 

	          				</li>

	          			</ul>
	          		</li>
	          	</ol>  		

	          	<h4>Experience</h4>

	  			{!! __form::textbox(
	             	'12', 'experience', 'number', '', 'Score', old('experience'), $errors->has('experience'), $errors->first('experience'), 'step="any"'
	         	) !!} 

	          	<h4>Training</h4>

	  			{!! __form::textbox(
	             	'12', 'training', 'number', '', 'Score', old('training'), $errors->has('training'), $errors->first('training'), 'step="any"'
	         	) !!} 

	          	<h4>Eligibility</h4>

	  			{!! __form::textbox(
	             	'12', 'eligibility', 'number', '', 'Score', old('eligibility'), $errors->has('eligibility'), $errors->first('eligibility'), 'step="any"'
	         	) !!} 

	          	<h4>Performance</h4>

	  			{!! __form::textbox(
	             	'12', 'performance', 'number', '', 'Score', old('performance'), $errors->has('performance'), $errors->first('performance'), 'step="any"'
	         	) !!} 

	          	<h4>Behavioral Events, Interview, Assesment (BEIA), Work Attitude</h4>
	          			
	  			<div class="col-md-12">
	  			
	      			{!! __form::textbox(
		            	'6', 'behavior_point_score', 'number', '', 'Point Score', old('behavior_point_score'), $errors->has('behavior_point_score'), $errors->first('behavior_point_score'), 'step="any"'
		         	) !!} 

	      			{!! __form::textbox(
		            	'6', 'behavior', 'number', '', 'Score', old('behavior'), $errors->has('behavior'), $errors->first('behavior'), 'step="any"'
		         	) !!} 
	  					
	  			</div>

	          	<h4>Psychological and Mental Aptitude Tests</h4>
	          			
	  			<div class="col-md-12">
	  			
	      			{!! __form::textbox(
		            	'6', 'psycho_test_point_score', 'number', '', 'Point Score', old('psycho_test_point_score'), $errors->has('psycho_test_point_score'), $errors->first('psycho_test_point_score'), 'step="any"'
		         	) !!} 

	      			{!! __form::textbox(
		            	'6', 'psycho_test', 'number', '', 'Score', old('psycho_test'), $errors->has('psycho_test'), $errors->first('psycho_test'), 'step="any"'
		         	) !!} 
	  					
	  			</div>

  			</div>


	    </div>

        <div class="box-footer">
          <button type="submit" class="btn btn-default">Save <i class="fa fa-fw fa-save"></i></button>
        </div>

      </div>

      </form>

    </div>

  </section>

@endsection




@section('modals')

  @if(Session::has('DEPARTMENT_CREATE_SUCCESS'))

    {!! __html::modal(
      'department_create', '<i class="fa fa-fw fa-check"></i> Saved!', Session::get('DEPARTMENT_CREATE_SUCCESS')
    ) !!}
    
  @endif

@endsection 




@section('scripts')

  <script type="text/javascript">


    @if(Session::has('DEPARTMENT_CREATE_SUCCESS'))
      $('#department_create').modal('show');
    @endif


    // Undergrad Bachelor
    $(document).ready(function(){
	  $("#educ_undergrad_bachelor_units_earned").keyup(function(){
	  	var factored_units = $(this).val() / 160;
	  	var score = factored_units * 5;

	  	if(score > 5){
	  		score = 5;
	  	}

	    $("#educ_undergrad_bachelor").val(score.toFixed(2));
	  });
	});

    $(document).ready(function(){
	  $("#educ_undergrad_bachelor_units_earned").keydown(function(){
	  	var factored_units = $(this).val() / 160;
	  	var score = factored_units * 5;

	  	if(score > 5){
	  		score = 5;
	  	}

	    $("#educ_undergrad_bachelor").val(score.toFixed(2));
	  });
	});




    // Undergrad Masteral
    $(document).ready(function(){
	  $("#educ_undergrad_masteral_units_earned").keyup(function(){
	  	var factored_units = $(this).val() / 42;
	  	var score = factored_units * 1;

	  	if(score > 1){
	  		score = 1;
	  	}

	    $("#educ_undergrad_masteral").val(score.toFixed(2));
	  });
	});

    $(document).ready(function(){
	  $("#educ_undergrad_masteral_units_earned").keydown(function(){
	  	var factored_units = $(this).val() / 42;
	  	var score = factored_units * 1;

	  	if(score > 1){
	  		score = 1;
	  	}

	    $("#educ_undergrad_masteral").val(score.toFixed(2));
	  });
	});




    // Behavior Score
    $(document).ready(function(){
	  $("#behavior_point_score").keyup(function(){
	  	var factored_units = $(this).val() / 5;
	  	var score = factored_units * 13;

	  	if(score > 13){
	  		score = 13;
	  	}

	    $("#behavior").val(score.toFixed(2));
	  });
	});

    $(document).ready(function(){
	  $("#behavior_point_score").keydown(function(){
	  	var factored_units = $(this).val() / 5;
	  	var score = factored_units * 13;

	  	if(score > 13){
	  		score = 13;
	  	}

	    $("#behavior").val(score.toFixed(2));
	  });
	});




    // Psycho Test Score
    $(document).ready(function(){
	  $("#psycho_test_point_score").keyup(function(){
	  	var factored_units = $(this).val() / 100;
	  	var score = factored_units * 5;

	  	if(score > 5){
	  		score = 5;
	  	}

	    $("#psycho_test").val(score.toFixed(2));
	  });
	});

    $(document).ready(function(){
	  $("#psycho_test_point_score").keydown(function(){
	  	var factored_units = $(this).val() / 100;
	  	var score = factored_units * 5;

	  	if(score > 5){
	  		score = 5;
	  	}
	  	
	    $("#psycho_test").val(score.toFixed(2));
	  });
	});


  </script> 
    
@endsection