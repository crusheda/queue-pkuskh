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
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
</head>
<body>
    <div class="card">
        <div class="upper">
            <div class="row">
                <div class="col-8 heading">
                    <img class="img-fluid" src="{{ asset('img/landing-logotext.png') }}">
                </div>
            </div>
            <hr>
            <h5 class="text-center" style="margin-top:20px"><b>Antrian Poliklinik</b></h5>
            <form action="{{ route('store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-element"> <span id="input-header">Nomor Rekam Medik</span> <input type="number" name="no_rm" onKeyPress="if(this.value.length==6) return false;" required autofocus> </div>
                @if(session('message'))
                    <div class="row mb-2">
                        <div class="col-lg-12">
                            <div class="alert alert-danger" role="alert">{{ session('message') }}
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="lower">
                    <button type="submit" class="btn btn-dark">Lihat Antrian</button>
                </div>
            </form>
            {{-- <i class="fa fa-exclamation-triangle" aria-hidden="true"></i><span>Support Chrome, etc.</span> --}}
        </div>
        <hr>
    </div>
</body>
</html>
