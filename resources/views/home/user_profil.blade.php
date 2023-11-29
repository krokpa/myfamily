@extends('layout.app')

@section('content')

<div class="container-fluid">        
    <div class="page-title">
      <div class="row">
        <div class="col-12 col-sm-6">
          <h3>{{ $title ?? "Profil" }}</h3>
        </div>
        <div class="col-12 col-sm-6">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"> <a class="home-item" href="/"><i data-feather="home"></i></a></li>
            <li class="breadcrumb-item"> Utilisateur</li>
            <li class="breadcrumb-item active"> Profil</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

<div class="container-fluid">        
    <div class="row">
        <div class="col-md-12">
            <div class="profile-header">
                <div class="row align-items-center">
                    <div class="col-auto profile-image">
                        <a href="#">
                            @if ($user->USR_Photo == "" || $user->USR_Photo == null)
                                <img data-toggle="modal" href="#" data-target="#modalUpdateUser_{{ $user->USR_ID }}" style="width: 120px;height:120px;" class="rounded-circle" src="{{ asset('assets') }}/img/undraw_profile_1.svg" alt="">
                            @else
                                <img data-toggle="modal" href="#" data-target="#modalUpdateUser_{{ $user->USR_ID }}" style="width: 120px;height:120px;" class="rounded-circle" src="{{ asset('storage/images/users/'.$user->USR_Photo) }}" alt="">
                            @endif
                        </a>
                    </div>
                    <div class="col ms-md-n2 profile-user-info">
                        <h4 class="user-name mb-0">{{ $user->USR_Nom }} {{ $user->USR_Prenom }}</h4>
                        <h6 class="text-muted">{{ $user->role->ROLE_Libelle ?? "" }}</h6>
                        {{-- <div class="user-Location"><i class="fas fa-map-marker-alt"></i> {{ $gare->GARE_Libelle ?? "" }}</div> --}}
                        {{-- <div class="about-text">{{ $compagnie->CMP_RaisonSociale ?? "" }}</div> --}}
                    </div>
                    <div class="col-auto profile-btn">
                        <a href="#" class="btn btn-primary">
                            <i class="fa fa-edit me-1"></i> Modifier
                        </a>
                    </div>
                </div>
            </div>
            <div class="profile-menu">
                <ul class="nav nav-tabs nav-tabs-solid">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#per_details_tab">A Propos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#password_tab">Code secret</a>
                    </li>
                </ul>
            </div>
            <div class="tab-content profile-tab-cont">
                <div class="tab-pane fade show active" id="per_details_tab">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title d-flex justify-content-between">
                                        <span>Informations Personnelles</span>
                                        <a class="edit-link" data-toggle="modal" href="#" data-target="#modalUpdateUser_{{ $user->USR_ID }}"><i class="fa fa-edit me-1"></i>Modifier</a>
                                    </h5>
                                    <div class="row">
                                        <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Nom</p>
                                        <p class="col-sm-9">{{ $user->USR_Nom }}</p>
                                    </div>
                                    <div class="row">
                                        <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Prénom</p>
                                        <p class="col-sm-9">{{ $user->USR_Prenom }}</p>
                                    </div>
                                    <div class="row">
                                        <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Email</p>
                                        <p class="col-sm-9"><a href="#">{{ $user->USR_Email  }}</a></p>
                                    </div>
                                {{--  <div class="row">
                                        <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Whatsapp</p>
                                        <p class="col-sm-9"><a href="#">{{ $user->USR_Whatsapp }}</a></p>
                                    </div> --}}
                                    <div class="row">
                                        <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Contact</p>
                                        <p class="col-sm-9">{{ $user->USR_Contact  }}</p>
                                    </div>
                                    <div class="row">
                                        <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Role</p>
                                        <p class="col-sm-9">{{ $user->role->ROLE_Libelle ?? "" }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="password_tab" class="tab-pane fade">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Changer le mot de passes</h5>
                            <div class="row">
                                <div class="col-md-10 col-lg-6">
                                    <form method="post" action="#">
                                        @csrf
                                        <div class="form-group">
                                            <label>Ancien mot de passe</label>
                                            <input type="password" name="OldPassword" value="" required class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label>Nouveau mot de passe</label>
                                            <input type="password" name="NewPassword" value="" required class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label>Confirmer le mot de passe</label>
                                            <input type="password" name="ConfirmPassword" value="" required class="form-control" />
                                        </div>
                                        <button class="btn btn-primary" name="changePassword" type="submit">Modifier</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="modal fade" id="modalUpdateUser_{{ $user->USR_ID }}" data-backdrop="static" data-keyboard="false"  aria-labelledby="modalUpdateUser_{{ $user->USR_ID }}Label" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-info text-white">
                        <h5 class="modal-title text-white" id="modalUpdateUser_{{ $user->USR_ID }}Label">Mise à jour utilisateur : {{ $user->USR_Nom }} {{ $user->USR_Prenom }}</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" action="#" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="USR_ID" value="{{ $user->USR_ID }}">

                        <div class="modal-body">

                            <div class="invoice-item invoice-item-one">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="invosice-logo">
                                            <span class="user-image">
                                                @if ($user->USR_Photo == "" || $user->USR_Photo == null)
                                                    <img id="targetimg" style="width: 130px;height:130px;" class="rounded-circle img-fluid img-thumbnail" src="{{ asset('assets') }}/img/undraw_profile_1.svg" alt="">
                                                @else
                                                    <img id="targetimg" style="width: 130px;height:130px;" class="rounded-circle img-fluid img-thumbnail" src="{{ asset('storage/images/users/'.$user->USR_Photo) }}" alt="">
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                            <div class="row">
                                
                                <div class="col-6 col-sm-6 col-lg-6 col-xl-6">
                                    <div class="form-group local-forms">
                                        <label>Nom<span class="login-danger">*</span></label>
                                        <input type="text" required class="form-control form-control-sm" name="USR_Nom" value="{{ $user->USR_Nom }}">
                                    </div>
                                </div>
                            
                                <div class="col-6 col-sm-6 col-lg-6 col-xl-6">
                                    <div class="form-group local-forms">
                                        <label>Prénom<span class="login-danger"></span></label>
                                        <input type="text" required class="form-control form-control-sm" name="USR_Prenom" value="{{ $user->USR_Prenom }}">
                                    </div>
                                </div>
    
                            </div>
                            
                            <div class="row">
                              
                                <div class="col-6 col-sm-6 col-lg-6">
                                    <div class="form-group local-forms">
                                        <label>Email <span class="login-danger"></span></label>
                                        <input type="text" class="form-control form-control-sm" name="USR_Email" value="{{ $user->USR_Email }}">
                                    </div>
                                </div>
    
                            </div>
                            
                            <div class="row">
                            
                                <div class="col-6 col-sm-6 col-lg-6">
                                    <div class="form-group local-forms">
                                        {{-- <div class="form-group students-up-files"> --}}
                                            <label>Photo utilisateur</label>
                                            <div class="uplod">
                                                <label class="file-upload image-upbtn mb-0"> Sélectionner le fichier <input type="file" id="USR_Photo" name="USR_Photo" accept="image/*" /> </label>
                                            </div>
                                        {{-- </div> --}}
                                    </div>
                                </div>
    
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-ban" aria-hidden="true"></i> Annuler</button>
                            <button type="submit" name="updateUser" class="btn btn-success"><i class="fa fa-check"></i> Valider</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection