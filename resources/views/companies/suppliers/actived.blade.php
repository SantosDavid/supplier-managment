@extends('layouts.base')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8 offset-2">
            <div class="card">
                <div class="card-header bg-success">
                    <h1>Ativação efetuada com sucesso!</h1>
                </div>
                <div class="card-body">
                    <p>
                        Seja bem-vindo, {{ $supplier->name }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
