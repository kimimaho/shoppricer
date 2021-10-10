@extends('layouts.admin_template')

@section('title','Tableau de bord')

@section('content')
<div class="container">
<div class="container-fluid">

        <!-- /.row -->
         <div class="row">
          <div class="col-12 col-sm-6 col-md-12">
            <div class="info-box">
         <form class="needs-validation" method="post" action="#" accept-charset='UTF-8'>
                {{ csrf_field() }}

              <div class="input-group">
                <div class="col-lg-4">
                  <input type="text" id="datepicker" name='date_debut' class="form-control"  placeholder="date du debut" required="required" autocomplete="off">
                  @if ($errors->has('date_debut'))
                  <span class="help-block">
                      <strong style='color:red'>{{ $errors->first('date_debut') }}</strong>
                  </span>
                  @endif
                  <small class="help-block"></small>
                </div>
                <div class="col-lg-4">
                  <input type="text" id="datepicke" name='date_fin' class="form-control"  placeholder="date de fin" autocomplete="off" required="required">
                  @if ($errors->has('date_fin'))
                  <span class="help-block">
                      <strong style='color:red'>{{ $errors->first('date_fin') }}</strong>
                  </span>
                  @endif
                  <small class="help-block"></small>
                </div>

                <div class="input-group-append">
                  <button class="btn btn-primary" type="submit">Recherche</button>
                </div>
              </div>
          </form>
        </div>



       </div>
       </div>
       </div>


        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Liste des activités</h5>

              </div>
              <!-- /.card-header -->
              <div class="card-body">

                 <div class="card-header">
                  <h3 class="card-title"> </h3>
                  <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-widget="collapse">
                          <i class="fa fa-minus"></i>
                      </button>
                      <div class="btn-group">
                          <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                              <i class="fa fa-wrench"></i>
                          </button>
                          <div class="dropdown-menu dropdown-menu-right" role="menu">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example2" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                  <th>No</th>
                                                    <th> Nom de l'activité </th>
                                                    <th> Date Debut </th>
                                                    <th> Date Fin </th>
                                                     <th> Description</th>
                                                    <th> Nombre de rapports</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                    </tr>


                                    </tr>

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
