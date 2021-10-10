@extends('layouts.admin_template')

@section('title','Gestion de la strategie')
@section('content')

<div class="container">

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"> Definition de la stratégie</h3>

                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form  method="post" action="{{route('strategie.update')}}" >
                   @csrf
                   <!-- @method('PUT') -->


                            <div class="form-group row d-flex align-items-center mb-5">
                                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end"> Selectionnez la strategie</label>
                                <div class="col-lg-5">
                                    <select name='strategie' id="strategie" class="form-control custom-select" required>
                                        <option selected value="" disabled> Selectionnez la strategie</option>
                                            <option value="prix minimun" @if($strategie == "prix minimun") selected @endif>prix minimun</option>
                                            <option value="prix moyen"  @if($strategie == "prix moyen") selected @endif>prix moyen</option>
                                            <option value="prix maximun" @if($strategie == "prix maximun") selected @endif>prix maximun</option>

                                    </select>
                                    <small class="help-block"></small>
                                </div>
                            </div>

                            <div class="text-right">
                             <button class="btn btn-square btn-gradient-01" type="submit">Enregistrer</button>
                            
                        </div>
                    </form>
                </div>
                <!-- /.card-body -->
            </div> <!-- /.card -->
        </div> <!-- col-md -->
    </div> <!-- row -->
</div>

@endsection

