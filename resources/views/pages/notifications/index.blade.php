
@extends('layouts.admin_template')

@section('title','Gestion des notifications')

@section('content')
<div class="container">
  <div class="container-fluid">
    <div class="row">
     <div class="col-md-12">
        <div class="card">
          <div class="card-header">
                <h3 class="card-title">Liste des notifications </h3>
                <div class="card-tools">
                    <!-- {{-- <a href="#" type="button" class="btn btn-success btn-sm btn-square mr-1 mb-2"  >  <i class="la la-plus"></i> Importer  </a> --}} -->
                    <!-- <a href="{{ route('notifications.create') }}" type="button" class="btn btn-info btn-sm btn-square mr-1 mb-2"  >  <i class="la la-plus"></i> Ajouter  </a> -->
                </div>
            </div>
                        <!-- /.card-header -->
            <div class="card-body">
                <div class="table-responsive">
                   <table id="example2" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="width: 5%;">#</th>
                                <th style="width: 30%;"> Message </th>
                                <th style="width: 10%;"> Date  </th>
                                <th style="width: 10%;"> Produit </th>

                               <th style="width: 15%;"></th>
                            </tr>
                        </thead>
                         <tbody>
                           @if(!empty($notifications))
                                    <?php $i =1; ?>
                                    @foreach($notifications as $notification)
                                    <tr>
                                        <td> <?= $i++ ?> </td>
                                        <td> {{ $notification->message }} </td>
                                        <td> {{ $notification->dateNotification }} </td>
                                       
                                        <td > {{ $notification->produit->nomProduit }} </td>


                                        <td class="td-actions">

                                            <a class="mr-1 mb-2" href="{{route('repositionnement',$notification->id )}} "  title="modifier"> Appliquer </a>
                                            <a href="{{route('notifications.destroy', $notification->id)}} " data-method="delete"  data-token="{{csrf_token()}}" data-confirm="Vraiment supprimer cette notification ? <br/> Cette action est irreversible"><span style="color:red">Ignorer</span> </a>

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
     </div>
   </div>
</div>


@endsection

