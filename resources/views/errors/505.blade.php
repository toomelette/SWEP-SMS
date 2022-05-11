<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Swep | 404</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    @include('layouts.css-plugins')

</head>

<body class="hold-transition">
<div class="wrapper" style="background-color: #ecf0f5; padding-top:50px ">
    <div class="container">
        <section class="content">
            <h3 class="text-info"><i class="fa fa-comment"></i> No data found!</h3>
            <p style="font-size: 16px">
                {!!  $exception->getMessage() !!}
            </p>
        </section>
    </div>
</div>
</body>
</html>
