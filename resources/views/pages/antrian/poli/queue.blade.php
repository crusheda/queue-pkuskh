<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Antrian | SIMRSKU</title>
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/pku_ico.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('img/pku_ico.png') }}">
    <link href="{{ asset('css/own.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>
    <link rel="stylesheet" href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
</head>
<body>
    <div class="card">
        <div class="upper">
            <div class="row">
                <div class="col-md-12 heading">
                    <img class="img-fluid" src="{{ asset('img/landing-logotext.png') }}">
                </div>
            </div>
        </div>
        <hr>
        <div class="lower">
            <h4>ANTRIAN ANDA</h4>
            <h1 style="margin-bottom: 40px"><kbd>{{ $list['show']->queue }}</kbd></h1>
            <hr>
            <div class="text-left" style="margin-left:20px">
                <h5>No.Rekam Medik : <b>{{ $list['show']->no_rm }}</b></h5>
                <h5>Nama : {{ $list['show']->nama }}</h5>
                <h5>Poliklinik : {{ $list['show']->nama_queue }}</h5>
            </div>
            <hr>
            <a>Tgl Daftar : <br><b>{{ \Carbon\Carbon::parse($list['show']->tgl_queue)->isoFormat('dddd, D MMMM Y') }}</b></a>
            <hr>
            <div class="row">
                <div class="col-md-12 text-center">
                    <h5>ANTRIAN BERJALAN</h5>
                    <h1><kbd id="queue">{{ $list['queue']->queue }}</kbd></h1>
                    <hr>
                </div>
            </div>
            Update Antrian Terkini : <kbd><a id="date">{{ \Carbon\Carbon::now()->toTimeString() }}</a> WIB</kbd>
            <hr>
            <a type="button" class="btn btn-success" href="{{ Route('index') }}"><i class="fa fa-angle-double-left"></i> Kembali</a>
        </div>
    </div>
</body>
<script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
<script>
$(document).ready( function () {
    setInterval(function () {
        $.ajax({
            url: "http://localhost:8000/api/queue/poli/{{ $list['kode'] }}",
            type: 'GET',
            dataType: 'json', // added data type
            success: function(res) {
                // $("#antrian").empty();
                // console.log(res.id);
                var d = new Date();
                var time = d.getHours() + ":" + d.getMinutes() + ":" + d.getSeconds();
                document.getElementById("date").innerHTML = time;
                // document.getElementById("queue").empty();
                document.getElementById("queue").innerHTML = res.queue;
                // $.each(res, function(index, el) {
                //     $("#queue").append(el.id);
                // });
            }
        });
    },10000);
});
</script>
</html>
