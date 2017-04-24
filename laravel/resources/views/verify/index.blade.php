@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-md-center mt-3">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Verify vote</div>
                    <div class="card-block">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('verify.check') }}">
                            {{ csrf_field() }}

                            <div class="form-group row{{ $errors->has('uuid') ? ' has-danger' : '' }}">
                                <label for="uuid" class="col-form-label col-md-3">Vote <abbr title="Universally Unique Identifier">UUID</abbr></label>

                                <div class="col-md-9">
                                    <input id="uuid" type="text" placeholder="00000000-0000-0000-0000-000000000000" pattern="[a-z0-9]{8}-[a-z0-9]{4}-[a-z0-9]{4}-[a-z0-9]{4}-[a-z0-9]{12}" class="form-control" name="uuid" value="{{ old('uuid') }}" required autofocus autocomplete="off">
                                    @if ($errors->has('uuid'))
                                        <small class="form-text text-danger">
                                            <strong>{{ $errors->first('uuid') }}</strong>
                                        </small>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row{{ $errors->has('password') ? ' has-danger' : '' }}">
                                <label for="password" class="col-md-3 col-form-label">Password</label>

                                <div class="col-md-9">
                                    <input id="password" type="password" class="form-control" name="password" required autocomplete="off">

                                    @if ($errors->has('password'))
                                        <small class="form-text text-danger">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </small>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-9 offset-md-3">
                                    <button type="submit" class="btn btn-primary">
                                        Verify
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
