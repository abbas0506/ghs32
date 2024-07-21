<header class="sticky-header" id='header'>
    <div class="flex justify-between items-center w-full">
        <a href="{{url('/')}}" class="flex text-xl font-bold items-center">
            <img src="{{asset('images/logo/app_logo_transparent.png')}}" alt="" class="w-8 md:w-12">
            <div class="px-2">
                <div class="app-title text-lg font-medium">GHSSCB</div>
                <div class="app-subtitle text-xs font-thin hidden md:block">Govt Higher Secondary School Chak Bedi</div>
            </div>
        </a>
        <nav id='navbar' class="navbar">
            <ul>
                <li class="float-right md:hidden" onclick="toggleNavbarMobile()">
                    <i class="bi-x-lg text-xl text-orange-300 hover:-rotate-90 transition duration-500 ease-in-out"></i>
                </li>
                <li><a href="{{ url('about') }}" class="nav-item">About</a></li>
                <li><a href="" class="nav-item">Faculty</a></li>
                <li><a href="#" class="nav-item">Alumni</a></li>
                <li><a href="{{ url('gallary') }}" class="nav-item">Gallary</a></li>
                <li><a href="{{ url('contact') }}" class="nav-item">Contact Us</a></li>
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