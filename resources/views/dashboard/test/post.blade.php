<form id="form">
    Name:
    <input name="name">
    <button type="submit">GO</button>
</form>

@include('layouts.js-plugins')
<script>
    $(document).ready(function () {
        $("#form").submit(function (e) {
            e.preventDefault();
            let form = $(this);
            const data= new FormData(this);
            $.ajax({
                url : 'http://10.36.1.17:8001/display',
                data : data,
                type: 'POST',
                headers: {
                    {!! __html::token_header() !!}
                },
                success: function (res) {
                    console.log(res);
                },
                error: function (res) {
                    console.log(res);
                }
            })
        })
    })
</script>