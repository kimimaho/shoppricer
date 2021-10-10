
@extends('layouts.admin_template')

@section('title','Gestion des offres')

@section('content')
<div class="container">
  <div class="container-fluid">
    <div class="row">
     <div class="col-md-12">
        <div class="card">
          <div class="card-header">
                <h3 class="card-title">Liste des offres </h3>
                <div class="card-tools">
                    {{-- <a href="#" type="button" class="btn btn-success btn-sm btn-square mr-1 mb-2"  >  <i class="la la-plus"></i> Importer  </a> --}}
                    <a type="button" class="btn btn-info btn-sm btn-square mr-1 mb-2" data-toggle="modal" data-target="#importer">  <i class="la la-plus"></i> Importer  </a>
                    <a href="{{ route('offres.create') }}" type="button" class="btn btn-info btn-sm btn-square mr-1 mb-2"  >  <i class="la la-plus"></i> Ajouter  </a>
                
                  </div>
            </div>
                        <!-- /.card-header -->
            <div class="card-body">
                <div class="table-responsive">
                   <table id="example2" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th> Nom  </th>
                                <th> Url  </th>
                                <th> Prix  </th>
                                <th> Produit </th>
                               <th ></th>
                            </tr>
                        </thead>
                         <tbody>
                           @if(!empty($produits))
                                    <?php $i =1; ?>
                                    @foreach($produits as $produit)
                                    @foreach($produit->offres as $offre)
                                    <tr>
                                        <td> <?= $i++ ?> </td>
                                        <td> {{ $offre->nomOffre }} </td>
                                        <td> {{ $offre->urlOffre }} </td>
                                         <td> {{ $offre->prixOffre }} </td>
                                         <td> {{ $offre->produit->nomProduit }} </td>

                                        <td class="td-actions">

                                            <a class="mr-1 mb-2" href="{{route('offres.edit',$offre->id )}} "  title="modifier"> <i class="fa fa-pencil"></i> </a>
                                            <a href="{{route('offres.destroy', $offre->id)}} " data-method="delete" data-token="{{csrf_token()}}" data-confirm="Vraiment supprimer ce offre ? <br/> Cette action est irreversible"><i class="fa fa-remove" style="color:red"> </i></a>

                                        </td>
                                    </tr>
                                    @endforeach
                                    @endforeach
                                    @endif
                        </tbody>
                    </table>
                </div>
            </div>
          </div>
        </div>
        <div id="importer" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-lg">
              <div class="modal-content">
                  <div class="modal-header">
                      <h4 class="modal-title" style="text-align: center;"> Importation des offres </h4>
                      <button type="button" class="close" data-dismiss="modal">
                          <span aria-hidden="true">×</span>
                          <span class="sr-only">close</span>
                      </button>
                  </div>
                  <div class="modal-body">
                  <form class="needs-validation" method="post"  action="{{ route('importation-offres') }}" accept-charset='UTF-8' enctype="multipart/form-data">
                       {{-- {{ csrf_field() }} --}}
                       @csrf

                                   <div class="form-group row d-flex align-items-center mb-5">
                                      <label class="col-lg-4 form-control-label d-flex justify-content-lg-end"> Fichier</label>
                                      <div class="col-lg-5">
                                          <input type="file" name='fichier' class="form-control" value="{{ old('fichier') }}" placeholder="le fichier" required="required">
                                          @if ($errors->has('fichier'))
                                          <span class="help-block">
                                              <strong style='color:red'>{{ $errors->first('fichier') }}</strong>
                                          </span>
                                          @endif
                                          <small class="help-block"></small>
                                      </div>
                                  </div>
                                  <div class="text-right">
                                   <button class="btn btn-square btn-gradient-01" type="submit">Enregistrer</button>
                                  <button class="btn btn-square btn-shadow" type="reset">Réinitialiser</button>
                              </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
     </div>
   </div>
</div>


@endsection

