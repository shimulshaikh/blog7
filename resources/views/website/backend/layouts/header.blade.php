<header class="main-header">

                <!-- START LOGO PART -->
                <a href="{{route('backend.index')}}" class="logo">
                    <!-- START MINI LOGO FOR SIDEBAR PART -->
                    <span class="logo-mini"><b>U</b></span>

                    <!-- MINI LOGO FOR SIDEBAR PART END-->
                    <span class="logo-lg">
                        <img class="img-responsive main-logo" src="{{asset('backend/dist/img/uttaraLogo.png')}}">
                    </span>
                </a><!-- LOGO PART END -->


                <!-- START HEADER NAVBAR SECTION -->
                <nav class="navbar navbar-static-top">
                    <!-- START SIDEBAR TOGGLE BUTTON PART -->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a><!-- SIDEBAR TOGGLE BUTTON PART END -->


                    <!-- START NAVBAR CUSTOM MENU PART -->
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle fa fa-power-off" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                    
                                        @can('manage-users') 
                                        <a class="dropdown-item" href="{{route('user.index')}}">
                                          User Management
                                        </a>
                                        @endcan
                                </div>
                            </li>
                        </ul>
                    </div><!-- NAVBAR CUSTOM MENU PART END -->
                    <div class="navbar-custom-menu-curve"></div>
                </nav><!-- HEADER NAVBAR SECTION END -->
            </header><!-- MAIN-HEADER SECTION END-->