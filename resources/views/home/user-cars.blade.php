@extends('layout.app')

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ $title ?? "Bienvenue" }}</h1>
        <a href="#" data-toggle="modal" data-target="#modal-add-car" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-car fa-sm text-white-50"></i> Ajouter un véhicule
        </a>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-12 col-md-6 mb-4">
            <div class="card shadow h-100 py-2">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="basic-1">
                          <thead>
                            <tr>
                              <th>Immat</th>
                              <th>Marque</th>
                              <th>Modele </th>
                              <th>Année </th>
                              <th>Type Moteur</th>
                              <th>Images</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>
        
                            @forelse ($cars as $car)
                                <tr>
                                    {{-- <td>{{ $user->CMD_ID }}</td> --}}
                                    <td>{{ $car->CAR_Immat  }}</td>
                                    <td>{{ $car->CAR_Marque }}</td>
                                    <td>{{ $car->CAR_Modele }}</td>
                                    <td>{{ $car->CAR_Year }}</td>
                                    <td>{{ $car->CAR_TypeMoteur }}</td>
                                    <td></td>
                                    <td>
                                        <a data-toggle="modal" data-target="#modal-update-car-{{ $car->CAR_ID }}" data-placement="top" data-original-title="Modifier" href=""> <i class="fa fa-edit"></i> </a>
                                        <a data-toggle="tooltip" data-placement="top" data-original-title="Modifier" href="?del=true&carid={{ $car->CAR_ID }}"> <i class="fa fa-trash"></i> </a>
                                    </td>
                                </tr>
                            @empty
                                <div class="alert alert-info inverse alert-dismissible fade show" role="alert"><i class="fa fa-warning"></i>
                                    <p><b>Aucune données !</b> Aucun véhicule n'a été enregistré pour l'heure.</p>
                                    <button class="btn-close" type="button" data-dismiss="alert" aria-label="Close" data-original-title="" title=""></button>
                                </div>
                            @endforelse
                            
                          </tbody>
                        </table>
                      </div>
                </div>
            </div>
        </div>

    </div>

    <div class="modal fade" id="modal-add-car" tabindex="-1" role="dialog" aria-labelledby="modal-add-car" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form action="#" method="post" class="theme-form">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Ajouter un véhicule</h5>
                        <button class="btn-close" type="button" data-dismiss="modal" aria-label="Close" data-original-title="" title=""></button>
                    </div>
                    <div class="modal-body">
                        
                    <div class="row"> 
  
                        <div class="col-xl-12 col-xl-12 col-lg-12">
                              <div class="card-body">

                                    <div class="form-group row">
                                        <div class="col-xl-6 col-lg-6 col-sm-6">
                                            <input type="text" required name="immat" value="{{ old('immat') }}" class="form-control form-control-user" placeholder="N° Immatriculation">
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-sm-6">
                                            <input type="text" required name="marque" value="{{ old('marque') }}" class="form-control form-control-user" placeholder="marque">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-xl-6 col-lg-6 col-sm-6">
                                            <input type="text" required name="modele" value="{{ old('modele') }}" class="form-control form-control-user" placeholder="Modèle">
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-sm-6">
                                            <input type="text" required name="couleur" value="{{ old('couleur') }}" class="form-control form-control-user" id="input_prenom" placeholder="Couleur">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <div class="col-xl-6 col-lg-6 col-sm-6">
                                            <input type="number" required name="annee" value="{{ old('annee') }}" class="form-control form-control-user" placeholder="Année">
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-sm-6">
                                            <input type="text" required name="typemoteur" value="{{ old('typemoteur') }}" class="form-control form-control-user" id="input_prenom" placeholder="Type Moteur">
                                        </div>
                                    </div>
                                
                              </div>
                        </div>
                    
                    </div>
  
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal" data-original-title="" title="">Annuler</button>
                        <button class="btn btn-primary" name="createCar" value="true" type="submit" data-original-title="Valider" title="">Valider</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    @foreach ($cars as $car)

    <div class="modal fade" id="modal-update-car-{{ $car->CAR_ID }}" tabindex="-1" role="dialog" aria-labelledby="modal-update-car-{{ $car->CAR_ID }}" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form action="#" method="post" class="theme-form">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modifier un véhicule</h5>
                        <button class="btn-close" type="button" data-dismiss="modal" aria-label="Close" data-original-title="" title=""></button>
                    </div>
                    <div class="modal-body">
                        
                    <div class="row"> 
  
                        <div class="col-xl-12 col-xl-12 col-lg-12">
                              <div class="card-body">

                                    <input type="hidden" name="carid" value="{{ $car->CAR_ID }}">

                                    <div class="form-group row">
                                        <div class="col-xl-6 col-lg-6 col-sm-6">
                                            <label>Immatriculation</label>
                                            <input type="text" required name="immat" value="{{ $car->CAR_Immat  }}" class="form-control form-control-user" placeholder="N° Immatriculation">
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-sm-6">
                                            <label>Marque</label>
                                            <input type="text" required name="marque" value="{{ $car->CAR_Marque }}" class="form-control form-control-user" placeholder="marque">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-xl-6 col-lg-6 col-sm-6">
                                            <label>Modèle</label>
                                            <input type="text" required name="modele" value="{{ $car->CAR_Modele }}" class="form-control form-control-user" placeholder="Modèle">
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-sm-6">
                                            <label>Couleur</label>
                                            <input type="text" required name="couleur" value="{{ $car->CAR_Color }}" class="form-control form-control-user" id="input_prenom" placeholder="Couleur">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <div class="col-xl-6 col-lg-6 col-sm-6">
                                            <label>Année</label>
                                            <input type="number" required name="annee" value="{{ $car->CAR_Year }}" class="form-control form-control-user" placeholder="Année">
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-sm-6">
                                            <label>Type Moteur</label>
                                            <input type="text" required name="typemoteur" value="{{ $car->CAR_TypeMoteur }}" class="form-control form-control-user" id="input_prenom" placeholder="Type Moteur">
                                        </div>
                                    </div>
                                
                              </div>
                        </div>
                    
                    </div>
  
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal" data-original-title="" title="">Annuler</button>
                        <button class="btn btn-primary" name="updateCar" value="true" type="submit" data-original-title="Valider" title="">Valider</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @endforeach
   


</div>

@endsection