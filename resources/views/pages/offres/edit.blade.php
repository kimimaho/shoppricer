@extends('layouts.admin_template')

@section('title','Gestion des offres')
@section('content')

<div class="container">

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"> Mise à jour de l'offre </h3>
                    {{-- <div class="card-tools">
                        <a href="{{ route('offres.create') }}" type="button" class="btn btn-info btn-sm btn-square mr-1 mb-2"  >  <i class="la la-plus"></i> Ajouter  </a>
                            <i class="fa fa-minus">Ajouter</i>
                        </button>

                    </div> --}}
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form class="needs-validation" method="post" action="{{ route('offres.update', $offre->id) }}" accept-charset='UTF-8'>
                        @csrf
                        @method('PUT')


                             <div class="form-group row d-flex align-items-center mb-5">
                                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end"> Nom du offre</label>
                                <div class="col-lg-5">
                                    <input type="text" name='nom' class="form-control" value="{{$offre->nomOffre }}"  required="required">
                                    @if ($errors->has('nom'))
                                    <span class="help-block">
                                        <strong style='color:red'>{{ $errors->first('nom') }}</strong>
                                    </span>
                                    @endif
                                    <small class="help-block"></small>
                                </div>
                            </div>
                            <div class="form-group row d-flex align-items-center mb-5">
                                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end"> Url de l'offre</label>
                                <div class="col-lg-5">
                                    <input type="text" name='url' class="form-control" value="{{$offre->urlOffre }}"  required="required">
                                    @if ($errors->has('url'))
                                    <span class="help-block">
                                        <strong style='color:red'>{{ $errors->first('url') }}</strong>
                                    </span>
                                    @endif
                                    <small class="help-block"></small>
                                </div>
                            </div>

                            <div class="form-group row d-flex align-items-center mb-5">
                                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Prix du offre</label>
                                <div class="col-lg-5">
                                    <input type="number"  name='prix' class="form-control" value="{{ $offre->prixOffre }}">
                                    @if ($errors->has('prix'))
                                    <span class="help-block">
                                        <strong style='color:red'>{{ $errors->first('prix') }}</strong>
                                    </span>
                                    @endif
                                    <small class="help-block"></small>
                                </div>
                            </div>
                            <div class="form-group row d-flex align-items-center mb-5">
                                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end"> Selectionnez le produit</label>
                                <div class="col-lg-5">
                                    <select name='produit_id' id="produit" class="form-control custom-select" required>
                                        <option selected value="" disabled> Selectionnez le produit</option>
                                        @if(!empty($produits))

                                            @foreach($produits as $produit)
                                             {{-- <option value="{{$produit->id}}"  >{{$produit->nomProduit }} </option> --}}
                                             <option value="{{$produit->id}}" {{ $offre->produit_id == $produit->id ? 'selected' : '' }} >{{$produit->nomProduit }} </option>

                                            @endforeach
                                        @endif
                                    </select>

                                    <small class="help-block"></small>
                                </div>
                            </div>

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

