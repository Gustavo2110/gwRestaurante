@extends('layouts.app')

@section('template_title')
    {{ $alimento->name ?? 'Show Alimento' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Alimento</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('alimentos.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Categoria Id:</strong>
                            {{ $alimento->categoria_id }}
                        </div>
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $alimento->nombre }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
