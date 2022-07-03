<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <div class="brand-link text-center">
    <span class="brand-text font-weight-light">PERPUSTAKAAN</span>
  </div>

  <!-- Sidebar -->
  <div class="sidebar">

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
            with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="{{ route('admin-dashboard') }}" class="nav-link {{ (request()->is('admin')) ? 'active' : '' }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-header">MASTER DATA</li>
        <li class="nav-item">
          <a href="{{ route('buku.index') }}" class="nav-link {{ (request()->is('admin/buku*')) ? 'active' : '' }}">
            <i class="nav-icon fas fa-solid fa-book"></i>
            <p>
              Buku
            </p>
          </a>
        </li>
        {{-- <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon far fa-envelope"></i>
            <p>
              Mailbox
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="pages/mailbox/mailbox.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Inbox</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="pages/mailbox/compose.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Compose</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="pages/mailbox/read-mail.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Read</p>
              </a>
            </li>
          </ul>
        </li> --}}
        <li class="nav-item">
          <a href="{{ route('petugas.index') }}" class="nav-link {{ (request()->is('admin/petugas*')) ? 'active' : '' }}">
            <i class="nav-icon fas fa-solid fa-user"></i>
            <p>
              Petugas
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('anggota.index') }}" class="nav-link {{ (request()->is('admin/anggota*')) ? 'active' : '' }}">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Anggota
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('peminjaman') }}" class="nav-link {{ (request()->is('admin/peminjaman')) ? 'active' : '' }}">
            <i class="nav-icon fas fa-solid fa-arrow-right"></i>
            <p>
              Peminjaman
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('pengembalian') }}" class="nav-link {{ (request()->is('admin/pengembalian')) ? 'active' : '' }}">
            <i class="nav-icon fas fa-solid fa-arrow-left"></i>
            <p>
              Pengembalian
            </p>
          </a>
        </li>
        <li class="nav-header">Settings</li>
        <li class="nav-item">
          <a href="{{ route('logout') }}"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();" class="nav-link">
              <i class="nav-icon fas fa-solid fa-arrow-right-from-bracket"></i>
              <p>Keluar</p>
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
          </form>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>