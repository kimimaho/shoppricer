@extends('layouts.admin_template')

@section('title','Gestion des produits')
@section('content')

<div class="container">

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"> Nouveau produit</h3>
                    {{-- <div class="card-tools">
                        <a href="{{ route('produits.create') }}" type="button" class="btn btn-info btn-sm btn-square mr-1 mb-2"  >  <i class="la la-plus"></i> Ajouter  </a>
                            <i class="fa fa-minus">Ajouter</i>
                        </button>

                    </div> --}}
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form  method="post" action="{{ route('produits.store') }}" >
                    {{ csrf_field() }}

                             <div class="form-group row d-flex align-items-center mb-5">
                                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end"> Nom du produit</label>
                                <div class="col-lg-5">
                                    <input type="text" name='nom' class="form-control" value="{{ old('nom') }}" placeholder="Nom du produit" required="required">
                                    @if ($errors->has('nom'))
                                    <span class="help-block">
                                        <strong style='color:red'>{{ $errors->first('nom') }}</strong>
                                    </span>
                                    @endif
                                    <small class="help-block"></small>
                                </div>
                            </div>

                            <div class="form-group row d-flex align-items-center mb-5">
                                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Prix du produit</label>
                                <div class="col-lg-5">
                                    <input type="number"  name='prix' class="form-control" value="{{ old('prix') }}" placeholder="Prix du produit" required="required">
                                    @if ($errors->has('prix'))
                                    <span class="help-block">
                                        <strong style='color:red'>{{ $errors->first('prix') }}</strong>
                                    </span>
                                    @endif
                                    <small class="help-block"></small>
                                </div>
                            </div>
                            {{-- <div class="form-group row d-flex align-items-center mb-5">
                                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end"> Selectionnez l'utilisateur</label>
                                <div class="col-lg-5">
                                    <select name='user_id' id="user" class="form-control custom-select" required>
                                        <option selected value="" disabled> Selectionnez l'utilisateur</option>
                                        @if(!empty($users))
                                            @foreach($users as $user)
                                            <option value="{{$user->id}}"> {{ $user->name }} </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <small class="help-block"></small>
                                </div>
                            </div> --}}

                            <div class="text-right">
                             <button class="btn btn-square btn-gradient-01" type="submit">Enregistrer</button>
                             <button onclick="history.go(-1);" class="btn btn-square btn-shadow" type="reset">Annuler</button>
                        </div>
                    </form>
                </div>
                <!-- /.card-body -->
            </div> <!-- /.card -->
        </div> <!-- col-md -->
    </div> <!-- row -->
</div>

@endsection

