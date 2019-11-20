@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Result') }}</div>
                <div class="card-body">
                    @if (isset($message))
                        <div class="alert alert-{{ $message['type'] }} text-center">
                            {!! $message['text'] !!}
                        </div>
                    @endif

                    @if (isset($data))
                        <div class="text-default" style="font-size: 14px;">
                            {{ json_encode($data) }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
