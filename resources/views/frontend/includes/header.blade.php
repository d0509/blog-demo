<header class="header-section">
    <div class="container">
        <div class="logo">
            <a href="{{ route('home') }}">
                <img src="{{ asset('user_assets/img/logo.png') }}" alt="">
            </a>
        </div>

        <div class="nav-menu">
            <nav class="mainmenu mobile-menu">
                <ul>
                    <li>


                    </li>

                    @auth
                        <li><a href="#">Contact Us</a></li>

                    @endauth
                    {{-- <strong> Select language </strong>
                            <select class="mr-2 changeLang">
                                <option value="en" {{ session()->get('locale') == 'en' ? 'selected' : '' }}>
                                    English
                                </option>
                                <option value="gu" {{ session()->get('locale') == 'gu' ? 'selected' : '' }}>
                                   Gujarati
                                </option>
                            </select> --}}

                    @auth

                        <li> <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->first_name }}</span>

                                <img class="img-profile rounded-circle" width="40px" style="border-radius: 50%"
                                    height="40px"
                                    src="https://img.freepik.com/free-photo/portrait-white-man-isolated_53876-40306.jpg?w=900&t=st=1702385591~exp=1702386191~hmac=9eb10824b463de3fa9306878a2fb7ea23e26f8bca0b96cd7c24abe7cb1a54761">

                            </a>

                            <ul class="dropdown">
                                <li><a href="#">My Profile</a>
                                </li>
                                <li><a href="#">Change Password</a>
                                </li>

                                <li><a data-toggle="modal" data-target="#logoutModal"> Logout </a>
                                </li>

                            </ul>
                        </li>
                    @endauth
                    @guest
                        <a style="padding: 12px" href="{{ route('login') }}" class="primary-btn top-btn"><i
                                class="fa fa-ticket"></i> Login </a>
                    @endguest
                </ul>

        </div>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"> Logout
                        </h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body"> Are you sure you want to logout?
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">
                            Cancel </button>
                        <a class="btn btn-primary" href="{{ route('logout') }}">
                            Logout</a>
                    </div>
                </div>
            </div>
        </div>
        <div id="mobile-menu-wrap"></div>
    </div>
    </nav>

    {{-- <script type="text/javascript">
        var url = "{{ route('changeLang') }}";
        $(".changeLang").change(function() {
            window.location.href = url + "?lang=" + $(this).val();
        });
    </script> --}}
</header>
