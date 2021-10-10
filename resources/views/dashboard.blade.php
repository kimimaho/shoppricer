@extends('layouts.admin_template')

@section('title','ShopPricer')

@section('content')
<div class="container">
  <div class="container-fluid">
    <div class="row">
     <div class="col-md-12">
        <div class="card">
             <div class="card-header">
               <h5 class="card-title">Liste des offres</h5>
               <div class="btn-list text-right">
                 <a href="{{ route('produits.create') }}" type="button" class="btn btn-info btn-sm btn-square mr-1 mb-2 text-right" >  <i class="la la-plus"></i> Ajouter  </a>
               </div>
              </div>
                        <!-- /.card-header -->
            <div class="card-body">
                <div class="table-responsive">
                   <table id="example2" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th> Nom  </th>
                                <th> Nom </th>
                                <th> Nom </th>
                                <th> Description</th>
                            </tr>
                        </thead>
                        {{-- <tbody>
                          <tr>
                            <td style="width: 15%;">produits </td>
                            <td style="width: 10%;">produits </td>
                            <td style="width: 30%;">produits </td>
                            <td style="width: 30%;">descriptions </td>
                          </tr>
                          <tr>
                            <td style="width: 15%;">produits </td>
                            <td style="width: 10%;">produits </td>
                            <td style="width: 30%;">produits </td>
                            <td style="width: 30%;">descriptions </td>
                          </tr>
                        </tbody> --}}
                    </table>
                </div>
            </div>
          </div>
        </div>
     </div>
   </div>
</div>


@endsection
