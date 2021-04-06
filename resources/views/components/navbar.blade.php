        <nav class="navbar navbar-expand-md navbar-light bg-transparent  shadow-sm">
            <div class=" container">
                <div class="navbar-brand">
                    <span class="brand">Re_Mebel</span>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item">
                            <a href="/" class="nav-link {{ request()->is('/') ? 'active' : '' }}">Home</a>
                        </li>
                        <li class=" nav-item">
                            <a href="{{ route('shop.index') }}"
                                class="nav-link {{ request()->is('shop') ? 'active' : '' }}">Shop</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('shop.index') }}"
                                class="nav-link {{ request()->is('about') ? 'active' : '' }}">About</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('shop.index') }}"
                                class="nav-link {{ request()->is('contact') ? 'active' : '' }}">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('shop.index') }}"
                                class="nav-link {{ request()->is('help') ? 'active' : '' }}">Help</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        </li>
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">
                                        <div class="log">Login</div>
                                    </a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">

                                    <a class="nav-link" href="{{ route('register') }}">
                                        <div class="out">Register</div>
                                    </a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <?php
                                $pesanan_utama = App\Models\Pesanan::where('user_id', Auth::user()->id)
                                ->where('status', 0)
                                ->first();
                                if (!empty($pesanan_utama)) {
                                $notif = App\Models\Pesanandetail::where('pesanan_id', $pesanan_utama->id)->count();
                                }
                                ?>
                                <a class="nav-link" href="{{ route('cart') }}">
                                    <i class="fa fa-shopping-cart"></i>
                                    @if (!empty($notif))
                                        <span class="badge badge-info">{{ $notif }}</span>
                                    @endif
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ url('profile') }}">
                                        Profile
                                    </a>

                                    <a class="dropdown-item" href="{{ url('history') }}">
                                        Riwayat Pemesanan
                                    </a>


                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                                                                                                                                                                                                                                                                                                                                                                                                                        document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
