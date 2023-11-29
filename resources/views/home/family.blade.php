@extends('layout.app')

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ $title ?? "Bienvenue" }}</h1>
        <a href="#" data-toggle="modal" data-target="#modal-add-user" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-user fa-sm text-white-50"></i> Ajouter un membre
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
                              <th>Nom</th>
                              <th>Prénom</th>
                              <th>Contact </th>
                              <th>Lien de parenté </th>
                              <th>Créer le</th>
                              <th>Modifié le</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>
        
                            @forelse ($members as $member)
                                <tr>
                                    {{-- <td>{{ $member->CMD_ID }}</td> --}}
                                    <td>{{ $member->FAM_NOM }}</td>
                                    <td>{{ $member->FAM_PRENOM }}</td>
                                    <td>{{ $member->FAM_CONTACT }}</td>
                                    <td>{{ $member->FAM_LIEN }}</td>
                                    <td>{{ date("d-m-Y H:i:s", strtotime($member->created_at)) }}</td>
                                    <td>{{ $member->updated_at == null ? "" : date("d-m-Y H:i:s", strtotime($member->updated_at)) }}</td>
                                    <td>
                                        <a data-toggle="modal" data-target="#modal-member-cars-{{ $member->FAM_ID }}" href="#"> <i class="fa fa-car"></i> </a>
                                        <a data-toggle="modal" data-target="#modal-update-user-{{ $member->FAM_ID }}" data-placement="top" data-original-title="Modifier" href=""> <i class="fa fa-edit"></i> </a>
                                        <a data-toggle="tooltip" data-placement="top" data-original-title="Modifier" href="?del=true&userid={{ $member->FAM_ID }}"> <i class="fa fa-trash"></i> </a>
                                    </td>
                                </tr>
                            @empty
                                <div class="alert alert-info inverse alert-dismissible fade show" role="alert"><i class="fa fa-warning"></i>
                                    <p><b>Aucune données !</b> Aucun membre n'a été enregistré pour l'heure.</p>
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

    <div class="modal fade" id="modal-add-user" tabindex="-1" role="dialog" aria-labelledby="modal-add-user" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form action="#" method="post" class="theme-form">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Ajouter un membre</h5>
                        <button class="btn-close" type="button" data-dismiss="modal" aria-label="Close" data-original-title="" title=""></button>
                    </div>
                    <div class="modal-body">
                        
                    <div class="row"> 
  
                        <div class="col-xl-12 col-xl-12 col-lg-12">
                              <div class="card-body">

                                    <div class="form-group row">
                                        <div class="col-xl-6 col-lg-6 col-sm-6">
                                            <input type="text" required name="nom" value="{{ old('nom') }}" class="form-control form-control-user" id="input_nom" placeholder="Nom">
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-sm-6">
                                            <input type="text" required name="prenom" value="{{ old('prenom') }}" class="form-control form-control-user" id="input_prenom" placeholder="Prénom">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-xl-6 col-lg-6 col-sm-6">
                                            <input type="contact" required name="contact" value="{{ old('contact') }}" class="form-control form-control-user" id="input_contact" placeholder="Contact">
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-sm-6">
                                            <label>Lien de parenté</label>
                                            <select name="lien" required class="form-control">
                                                <option value="Frere">Frère</option>
                                                <option value="Soeur">Soeur</option>
                                                <option value="Pere">Pere</option>
                                                <option value="Mere">Mère</option>
                                                <option value="Cousin">Cousin</option>
                                                <option value="Neuveu">Neuveu</option>
                                                <option value="Oncle">Oncle</option>
                                            </select>
                                        </div>
                                    </div>
                                
                              </div>
                        </div>
                    
                    </div>
  
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal" data-original-title="" title="">Annuler</button>
                        <button class="btn btn-primary" name="createMember" value="true" type="submit" data-original-title="Valider" title="">Valider</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @foreach ($members as $member)

        <div class="modal fade" id="modal-member-cars-{{ $member->FAM_ID }}" tabindex="-1" role="dialog" aria-labelledby="modal-member-cars-{{ $member->FAM_ID }}" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <form action="#" method="post" class="theme-form">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Véhicules enregistrés 
                            <button class="btn btn-success" data-toggle="modal" data-target="#modal-add-member-cars-{{ $member->FAM_ID }}" type="button" data-original-title="" title="">Ajouter un véhicule</button></h5>
                            <button class="btn-close" type="button" data-dismiss="modal" aria-label="Close" data-original-title="" title=""></button>
                        </div>
                        <div class="modal-body">
                            
                        <div class="row"> 
      
                            <div class="col-xl-12 col-xl-12 col-lg-12">
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
                        
                                            @forelse ($member->FamilyMemberCars as $FamilyMemberCars)
                                                <tr>
                                                    {{-- <td>{{ $user->CMD_ID }}</td> --}}
                                                    <td>{{ $FamilyMemberCars->car->CAR_Immat  }}</td>
                                                    <td>{{ $FamilyMemberCars->car->CAR_Marque }}</td>
                                                    <td>{{ $FamilyMemberCars->car->CAR_Modele }}</td>
                                                    <td>{{ $FamilyMemberCars->car->CAR_Year }}</td>
                                                    <td>{{ $FamilyMemberCars->car->CAR_TypeMoteur }}</td>
                                                    <td></td>
                                                    <td>
                                                        <a data-toggle="tooltip" data-placement="top" data-original-title="Modifier" href="?delcar=true&carid={{ $FamilyMemberCars->car->CAR_ID }}&famid={{ $FamilyMemberCars->FAM_ID }}"> <i class="fa fa-trash"></i> </a>
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
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal" data-original-title="" title="">Annuler</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
       
       
        <div class="modal fade" id="modal-add-member-cars-{{ $member->FAM_ID }}" tabindex="-1" role="dialog" aria-labelledby="modal-add-member-cars-{{ $member->FAM_ID }}" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <form action="#" method="post" class="theme-form">
                    <input type="hidden" name="member" value="{{  $member->FAM_ID }}">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Attribuer un véhicule </h5>
                            <button class="btn-close" type="button" data-dismiss="modal" aria-label="Close" data-original-title="" title=""></button>
                        </div>
                        <div class="modal-body">
                            
                        <div class="row"> 
      
                            <div class="col-xl-12 col-xl-12 col-lg-12">
                                  <div class="card-body">
                                    
                                    <div class="form-group row">
                                        <div class="col-xl-12 col-lg-6 col-sm-6">

                                            <select name="carid" class="form-control" required>

                                                @foreach ($user->cars as $usercar)
                                                    <option value="{{ $usercar->CAR_ID }}">{{ $usercar->CAR_Immat }} | {{ $usercar->CAR_Marque }} {{ $usercar->CAR_Modele }} </option>
                                                @endforeach

                                            </select>

                                        </div>
                                    </div>
                                  </div>
                            </div>
                        
                        </div>
      
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal" data-original-title="" title="">Annuler</button>
                            <button class="btn btn-primary" name="setCar" value="true" type="submit" data-original-title="Valider" title="">Attribuer</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
            
    @endforeach


</div>

@endsection