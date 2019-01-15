@extends('layouts.base')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8 offset-2">
            <div class="card">
                <div class="card-header bg-danger">
                    <h1>Houve um erro ao processar sua solicitação :(</h1>
                </div>
                <div class="card-body">
                    <p>
                        {{ $error }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection