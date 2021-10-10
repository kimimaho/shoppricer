
@extends('layouts.admin_template')

@section('title','Gestion des produits')

@section('content')
<div class="container">
  <div class="container-fluid">
    <div class="row">
     <div class="col-md-12">
        <div class="card">
          <div class="card-header" style="padding-top: 40px;">
            
            <div class="card-tools">
                {{-- <h3 class="card-title"  >Liste des produits </h3>  --}}
                <div class="row " >
                <form  method="post" action="{{ route('produits.excecuter') }}" >
                {{ csrf_field() }}
                   <input type="hidden" name="ExecuterVeille" id="ExecuterVeille">
                    <button type="submit"  class="btn btn-success btn-sm btn-square mr-1 mb-2 text-white" onclick="affecter()" disabled> Executer la veille</button>
                 </form>
                    
                    <a type="button" class="btn btn-info btn-sm btn-square mr-1 mb-2" data-toggle="modal" data-target="#importer">  <i class="la la-plus"></i> Importer  </a>
                    <a href="{{ route('produits.create') }}" type="button" class="btn btn-info btn-sm btn-square mr-1 mb-2"  >  <i class="la la-plus"></i> Ajouter  </a>
                </div>
                </div>
            </div>
                        <!-- /.card-header -->
            <div class="card-body">
                <div class="table-responsive">
                   <table id="example2" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="pr-1" style="width: 10%"><input type="checkbox" id="checkAll"></th>
                                <th ># </th>

                                <th>Nom du produit</th>
                                <th> Prix du produit </th>
                               <th ></th>
                            </tr>
                        </thead>
                         <tbody>
                           @if(!empty($produits))
                                    <?php $i =1; ?>
                                    @foreach($produits as $produit)
                                    <tr>
                                        <td class="">
                                            <input name='id[]' type="checkbox" id="checkItem" value="{{ $produit->id }}" class="trans">
                                            
                                        </td>
                                        <td> <?= $i++ ?> </td>
                                        <td> {{ $produit->nomProduit }} </td>

                                         <td> {{ $produit->prixProduit }} </td>

                                        <td class="td-actions">

                                            <a class="mr-1 mb-2" href="{{route('produits.edit',$produit->id )}} "  title="modifier"> <i class="fa fa-pencil"></i> </a>
                                            <a href="{{route('produits.destroy', $produit->id)}} " data-method="delete" data-token="{{csrf_token()}}" data-confirm="Vraiment supprimer ce produit ? <br/> Cette action est irreversible"><i class="fa fa-remove" style="color:red"> </i></a>

                                        </td>
                                    </tr>
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
                        <h4 class="modal-title" style="text-align: center;"> Importation des produits </h4>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">×</span>
                            <span class="sr-only">close</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <form class="needs-validation" method="post"  action="{{ route('importation') }}" accept-charset='UTF-8' enctype="multipart/form-data">
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

<!-- <script src="{{asset('assetadmin/js/jquery-3.4.1.min.js')}}"></script> -->
<script src="{{ URL::asset('template/admin/plugins/jquery/jquery.min.js') }}"></script>

            <script>

                $("#checkAll").click(function() {
                    $('input:checkbox').not(this).prop('checked', this.checked);
                });
                function affecter() {
                    var selected = new Array();
                    $('input:checked').each(function() {
                        selected.push($(this).attr('value'));
                        // console.log($(this).attr('value'))
                    });
                    $('#ExecuterVeille').val(selected)
                }

                var checkboxes = $("input[type='checkbox']"),
                    submitButt = $("button[type='submit']");

                checkboxes.click(function() {
                    submitButt.attr("disabled", !checkboxes.is(":checked"));
                });
            </script>


@endsection

