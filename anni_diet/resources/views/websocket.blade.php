@extends('layouts.app')

@section('content')
    <web-socket-emitter></web-socket-emitter>
    <web-socket-receiver
        pusher-app-key="{{ env('PUSHER_APP_KEY') }}"
        pusher-app-cluster="{{ env('PUSHER_APP_CLUSTER') }}"
        pusher-auth-endpoint="{{ route('pusher-api-auth') }}"
    ></web-socket-receiver>
@endsection
