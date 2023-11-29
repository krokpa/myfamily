@extends('layout.app')

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ $title ?? "Bienvenue" }}</h1>
        <a href="#" data-toggle="modal" data-target="#modal-add-user" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-user fa-sm text-white-50"></i> Ajouter un utilisateur
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
                              <th>Email </th>
                              <th>Role </th>
                              <th>Créer le</th>
                              <th>Modifié le</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>
        
                            @forelse ($users as $user)
                                <tr>
                                    {{-- <td>{{ $user->CMD_ID }}</td> --}}
                                    <td>{{ $user->USR_Nom }}</td>
                                    <td>{{ $user->USR_Prenom }}</td>
                                    <td>{{ $user->USR_Email }}</td>
                                    <td>{{ $user->Role->ROLE_Libelle }}</td>
                                    <td>{{ date("d-m-Y H:i:s", strtotime($user->created_at)) }}</td>
                                    <td>{{ $user->updated_at == null ? "" : date("d-m-Y H:i:s", strtotime($user->updated_at)) }}</td>
                                    <td>
                                        <a data-toggle="tooltip" data-placement="top" data-original-title="Gérer" href="/user/car/{{ $user->USR_ID }}"> <i class="fa fa-car"></i> </a>
                                        <a data-toggle="modal" data-target="#modal-update-user-{{ $user->USR_ID }}" data-placement="top" data-original-title="Modifier" href=""> <i class="fa fa-edit"></i> </a>
                                        <a data-toggle="tooltip" data-placement="top" data-original-title="Modifier" href="?del=true&userid={{ $user->USR_ID }}"> <i class="fa fa-trash"></i> </a>
                                    </td>
                                </tr>
                            @empty
                                <div class="alert alert-info inverse alert-dismissible fade show" role="alert"><i class="fa fa-warning"></i>
                                    <p><b>Aucune données !</b> Aucun utilisateur n'a été enregistré pour l'heure.</p>
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
                        <h5 class="modal-title">Ajouter un utilisateur</h5>
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
                                            <input type="email" required name="email" value="{{ old('email') }}" class="form-control form-control-user" id="input_email" placeholder="Addresse Email">
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-sm-6">
                                            <label>Rôle</label>
                                            <select name="role" class="form-control">
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->ROLE_ID }}">{{ $role->ROLE_Libelle }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="password" required name="password" value="{{ old('password') }}" minlength="8" class="form-control form-control-user" id="input_password" placeholder="Mot de passe">
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="password" required name="password_confirm" value="{{ old('password_confirm') }}" minlength="8" class="form-control form-control-user" id="input_password_repeat" placeholder="Confirmer le mot de passe">
                                        </div>
                                    </div>
                                
                              </div>
                        </div>
                    
                    </div>
  
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal" data-original-title="" title="">Annuler</button>
                        <button class="btn btn-primary" name="createUser" value="true" type="submit" data-original-title="Valider" title="">Valider</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @foreach ($users as $user)

    <div class="modal fade" id="modal-update-user-{{ $user->USR_ID }}" tabindex="-1" role="dialog" aria-labelledby="modal-update-user-{{ $user->USR_ID }}" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form action="#" method="post" class="theme-form">
                <input type="hidden" name="userid" value="{{ $user->USR_ID }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Ajouter un utilisateur</h5>
                        <button class="btn-close" type="button" data-dismiss="modal" aria-label="Close" data-original-title="" title=""></button>
                    </div>
                    <div class="modal-body">
                        
                    <div class="row"> 
  
                        <div class="col-xl-12 col-xl-12 col-lg-12">
                              <div class="card-body">

                                    <div class="form-group row">
                                        <div class="col-xl-6 col-lg-6 col-sm-6">
                                            <input type="text" required name="nom" value="{{ $user->USR_Nom }}" class="form-control form-control-user" id="input_nom" placeholder="Nom">
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-sm-6">
                                            <input type="text" required name="prenom" value="{{ $user->USR_Prenom }}" class="form-control form-control-user" id="input_prenom" placeholder="Prénom">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-xl-6 col-lg-6 col-sm-6">
                                            <input type="email" required name="email" value="{{ $user->USR_Email }}" class="form-control form-control-user" id="input_email" placeholder="Addresse Email">
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-sm-6">
                                            <label>Rôle</label>
                                            <select name="role" class="form-control">
                                                @foreach ($roles as $role)
                                                    @if ($role->ROLE_ID == $user->ROLE_ID)
                                                        <option selected value="{{ $role->ROLE_ID }}">{{ $role->ROLE_Libelle }}</option>
                                                    @else
                                                        <option value="{{ $role->ROLE_ID }}">{{ $role->ROLE_Libelle }}</option>
                                                    @endif
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
                        <button class="btn btn-primary" name="updateUser" value="true" type="submit" data-original-title="Valider" title="">Valider</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
        
    @endforeach


</div>

@endsection