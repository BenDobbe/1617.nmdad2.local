@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-md-center mt-3">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-block">
                        <h3 class="card-title">Warning</h3>
                        <p class="card-text">You're vote has possibly been tampered with.</p>
                        <a href="{{ route('verify.index') }}" class="btn btn-primary">Try again</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
