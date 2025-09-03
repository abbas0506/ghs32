<header class="sticky-header no-auth">
    <div class="flex flex-wrap w-full h-16 items-center justify-between px-5">
        <div>
            <a href="{{url('/')}}" class="flex text-xl font-bold items-center">
                <img src="{{asset('images/logo/app_logo_transparent.png')}}" alt="" class="w-8 md:w-12">
                <div class="px-2">
                    <div class="app-title text-lg font-medium">GHSSCB</div>
                    <div class="app-subtitle text-xs font-thin hidden md:block">Govt Higher Secondary School Chak Bedi</div>
                </div>
            </a>
            <select id="roleSwitcher" class="px-3 py-2 rounded-lg bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                @if(Auth::user()->roles->count()>1)
                @foreach(Auth::user()->roles as $role)
                @if($role->name!='admin')
                <option value="{{ $role->name }}" class="btn-teal text-xs font-normal text-center rounded">{{ $role->name }} </option>
                @endif
                @endforeach
                @endif
            </select>

            <div class="grid gap-2 mt-4 text">

            </div>
            @endif
        </div>


        <nav id='navbar' class="navbar">
            <ul>
                <li class="float-right md:hidden" onclick="toggleNavbarMobile()">
                    <i class="bi-x-lg text-xl text-orange-300 hover:-rotate-90 transition duration-500 ease-in-out"></i>
                </li>
                <li><a href="{{ url('/') }}" class="nav-item">Home</a></li>
                <li><a href="{{ url('about') }}" class="nav-item">About</a></li>
                <li><a href="#" class="nav-item">Faculty</a></li>
                <li><a href="{{ url('gallary') }}" class="nav-item">Gallary</a></li>
                <li><a href="{{ route('alumni.index') }}" class="nav-item">Alumni</a></li>
                <li><a href="{{ url('contact') }}" class="nav-item">Contact Us</a></li>
                <li><a href="{{ url('login') }}" class="nav-item">Login</a></li>
            </ul>
        </nav>

        <button class="md:hidden" onclick="toggleNavbarMobile()" id='menu'>
            <!-- menu -->
            <i class="bi-list text-lg"></i>
        </button>
    </div>
</header>
<script>
    var header = document.getElementById("header");
    window.onscroll = function() {
        if (window.pageYOffset > 5) {
            header.classList.add("scrolled-down");
        } else {
            header.classList.remove("scrolled-down");
        }
    };

    function toggleNavbarMobile() {
        $('#navbar').toggleClass('mobile');
    }

    function showLoginModal() {
        $('#loginModal').addClass('shown')
    }
</script>