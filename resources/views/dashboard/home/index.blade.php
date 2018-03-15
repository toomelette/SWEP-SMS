@extends('layouts.admin-master')

@section('content')

<section class="content-header">
    <h1>Welcome! 

        @if(Auth::check())

            {{ Auth::user()->firstname }}

        @endif

    </h1>
</section>

<section class="content">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Title</h3>
        </div>
        <div class="box-body">
            Body
        </div>
        <div class="box-footer">
            Footer
        </div>
    </div>
</section>

@endsection