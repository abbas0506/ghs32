<header class="sticky-header" id='header'>
    <div class="flex flex-wrap w-full h-16 items-center justify-between shadow-sm bg-white">

        <div class="flex items-center space-x-2">

            <a href="{{url('/')}}" class="flex justify-center">
                <img alt="logo" src="{{asset('images/logo/app_logo_transparent.png')}}" class="w-10 h-8">
            </a>
            <div class="text-base font-semibold">GHSS-CB</div>
        </div>
        <div id=" current-user-area" class="flex space-x-3 items-center justify-center relative">
            <label for="toggle-current-user-dropdown" class="hidden md:flex items-center">
                <div class="">{{ Auth::user()->profile->name }}</div>
            </label>
            <div id='menu' class="flex md:hidden">
                <i class="bi bi-list"></i>
            </div>
        </div>
    </div>

</header>