@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Contacto</div>
                <div class="card-body">
                    @include('contact.error')
                    <form enctype="multipart/form-data" method="POST" action="{{!empty($data->user)?route($data->route,$data->user->id):route($data->route)}}" >
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Nombre</label>
                                <div class="col-md-6">
                                <input id="name" value="{{!empty($data->user->name)?$data->user->name:""}}"  type="text" class="form-control  @error('name') is-invalid @enderror" name="name" value="">
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" style="display:block!important;">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Email</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" value="{{!empty($data->user->email)?$data->user->email:""}}"class="form-control" name="email" value="">
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" style="display:block!important;">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Fecha de Nacimiento</label>
                                <div class="col-md-6">
                                    <input id="date" type="date" class="form-control" name="date" value="{{!empty($data->user->birthday)?$data->user->birthday:""}}" value="">
                                    @if ($errors->has('date'))
                                        <span class="invalid-feedback" style="display:block!important;">
                                            <strong>{{ $errors->first('date') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Foto</label>
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <div class="custom-file">
                                            <input value="{{!empty($data->user->image)?$data->user->image:""}}" type="file" class="custom-file-input" id="file" aria-describedby="file" name="picture">
                                            <label class="custom-file-label" for="file">Choose file</label>
                                        </div>
                                    </div>
                                    {{-- @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror --}}
                                </div>
                         </div>
                         <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <a href="/home" class="btn btn-danger" >Atras</a>
                                @if(!empty($data->user))
                                    @can('update',$data->user)
                                        <button type="submit" class="btn btn-primary">
                                            Modificar
                                        </button>
                                    @endcan
                                @else
                                    <button type="submit" class="btn btn-success">Guardar</button>
                                @endif            
                            </div>
                        </div>
                        @csrf
                        @if(!empty($data->user))
                            <input type="hidden" name="_method" value="PUT">
                        @endif
                    </form>
                </div> 
            </div>
        </div>
    </div>
</div>
@endsection
