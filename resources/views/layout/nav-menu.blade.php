<ul class="nav navbar-nav navbar-right">

    <li>
        <a href="{{ url('/') }}"> Beranda </a>
    </li>
    <li>
        <a href="{{ route('tentang') }}"> Tentang Kami </a>
    </li>
    <li>
        <a href="{{ route('caraPembelian') }}"> Cara Pemesanan </a>
    </li>
    <li>
        <a href="{{ route('kontak') }}"> Kontak </a>
    </li>
    @if (!Auth::check())
        <li>
            <a href="{{ route('register') }}"> Daftar </a>
        </li>
        <li class="dropdown">
            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button"
                aria-haspopup="true" aria-expanded="false">
                Login
            </a>
            <ul style="padding:30px 20px 10px 20px;min-width:350px" class="dropdown-menu">
                <li>
                    <form class="" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control" name="email_or_username"
                                placeholder="Email / Username" autocomplete="off" required>
                        </div>

                        <div class="form-group">
                            <input type="password" class="form-control" name="password" placeholder="Password"
                                autocomplete="off" required>
                        </div>
                        <div style="margin-bottom:25px"></div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary btn-block" name="login" value="Login">
                        </div>
                    </form>
                </li>
            </ul>
        </li>
    @else
        <li class="dropdown">
            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button"
                aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-shopping-cart"></i> Pembelian <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a href="{{ route('user.pembelian.keranjang') }}"><i class="fa fa-caret-right"></i> Keranjang
                        Belanja</a>
                </li>

                <li role="separator" class="divider"></li>

                <li>
                    <a href="{{ route('user.pembelian.riwayat') }}"><i class="fa fa-caret-right"></i> Riwayat
                        Pembelian</a>
                </li>

                <li role="separator" class="divider"></li>
            </ul>
        </li>

        <li class="dropdown">
            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button"
                aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-user"></i> {{ Auth::user()->name }} <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a href="{{ route('user.profile') }}"><i class="fa fa-caret-right"></i> Profil</a>
                </li>

                <li role="separator" class="divider"></li>

                <li>
                    <a href="{{ route('logout') }}"><i class="fa fa-caret-right"></i> Logout</a>
                </li>
            </ul>
        </li>
    @endif


</ul>
