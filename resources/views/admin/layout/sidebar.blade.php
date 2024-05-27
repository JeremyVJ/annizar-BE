<div class="sidebar sidebar-style-2">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}" alt="..."
                        class="avatar-img rounded-circle">
                </div>
                <div class="info">
                    <a data-toggle="collapse" aria-expanded="true">
                        <span>
                            {{ Auth::user()->name }}
                            <span class="user-level">{{ Auth::user()->role }}</span>
                        </span>
                    </a>
                    <div class="clearfix"></div>
                </div>
            </div>
            <ul class="nav nav-primary">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard.index') }}" class="collapsed" aria-expanded="false">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Menu</h4>
                </li>
                {{-- <li class="nav-item">
                    <a data-toggle="collapse" href="#informasi" class="collapsed" aria-expanded="false">
                        <i class="fas fa-info"></i>
                        <p>Informasi</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="informasi">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('admin.tentang.index') }}">
                                    <span class="sub-item">Tentang Kami</span>
                                </a>
                            <li>
                                <a href="{{ route('admin.cara.index') }}">
                                    <span class="sub-item">Cara Pemesanan</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li> --}}
                <li class="nav-item">
                    <a data-toggle="collapse" href="#dashboard" class="collapsed" aria-expanded="false">
                        <i class="icon-folder"></i>
                        <p>Produk</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="dashboard">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('admin.barang.index') }}">
                                    <span class="sub-item">Data Produk</span>
                                </a>
                            <li>
                                <a href="{{ route('admin.kategori.index') }}">
                                    <span class="sub-item">Kategori Produk</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.konsumen.index') }}" class="collapsed" aria-expanded="false">
                        <i class="fa fa-user"></i>
                        <p>Pelanggan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.biaya.index') }}" class="collapsed" aria-expanded="false">
                        <i class="fa fa-truck"></i>
                        <p>Biaya Pengiriman</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.pesanan') }}" class="collapsed" aria-expanded="false">
                        <i class="icon-folder"></i>
                        <span class="sub-item">Pesanan</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</div>
