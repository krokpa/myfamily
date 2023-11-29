 <!-- Sidebar -->
 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
    </a>

    <hr class="sidebar-divider my-0">

    <li class="nav-item active">
        <a class="nav-link" href="{{ route('index') }}"> <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Tableau de bord</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    @if (session('userdata')->ROLE_Libelle == "admin")

        <li class="nav-item">
            <a class="nav-link" href="{{ route('manage_users') }}"> <i class="fas fa-fw fa-users"></i>
                <span>Gestion des utilisateurs</span>
            </a>
        </li>
        
    @endif

    
    <li class="nav-item">
        <a class="nav-link" href="{{ route('manage_family') }}"> <i class="fas fa-fw fa-users"></i>
            <span>Gestion de la famille</span>
        </a>
    </li>

</ul>
<!-- End of Sidebar -->