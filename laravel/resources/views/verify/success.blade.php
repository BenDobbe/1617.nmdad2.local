@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-md-center mt-3">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-block">
                        <h3 class="card-title">Success</h3>
                        <p class="card-text">You're vote has not been tampered with.</p>
                        <a href="{{ route('home') }}" class="btn btn-primary">Continue</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
