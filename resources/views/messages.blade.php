@extends('layouts.admin')

@section('content')
<script>
    let a_tok = document.querySelector('meta[name="csrf-token"]').content;

    //suscribing to pusher channel
    Pusher.logToConsole = true;
    var pusher = new Pusher('b9d75e318c96e51439eb', {
        cluster: 'mt1',
        authEndpoint:'/broadcasting/auth',
        auth:{
            headers:{
                'X-CSRF-TOKEN':a_tok
            }
        }
    });
</script>
<div class="container">
    <div class="row">
        <div class="col-md">
            <div id="chat_panel_container"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-md">
            <div id="chat_submit_container"></div>
        </div>
    </div>
</div>


@endsection
