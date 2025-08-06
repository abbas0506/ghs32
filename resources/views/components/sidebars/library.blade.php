<aside aria-label="Sidebar" id='sidebar'>
    <div class="flex justify-center items-center h-24 mt-6">
        <img src="{{asset('images/logo/app_logo_transparent.png')}}" alt="logo" class="w-20">
    </div>
    <div class="mt-8 font-bold text-center text-orange-300 uppercase tracking-wider">Teacher Panel</div>
    <label class="text-xs text-center text-teal-600">GHSS Chak Bedi, Pakpattan</label>

    @if(Auth::user()->roles->count()>1)
    <div class="grid gap-2 mt-4 text">
        @foreach(Auth::user()->roles as $role)
        @if($role->name!='librarian')
        <a href="{{ url('switch/as',$role->name) }}" class="btn-teal text-xs font-normal text-center rounded">Switch to {{ $role->name }} </a>
        @endif
        @endforeach
    </div>
    @endif

    <div class="mt-12">
        <ul class="grid gap-y-4">
            <li>
                <a href="{{url('library')}}" class="flex items-center">
                    <i class="bi-house"></i>
                    <span class="ml-3">Home</span>
                </a>
            </li>
            <li>
                <a href="{{route('library.book-issuance.scan')}}" class="flex items-center">
                    <i class="bi-upc"></i>
                    <span class="ml-3">Issue Book</span>
                </a>
            </li>
            <li>
                <a href="{{route('library.book-return.scan')}}" class="flex items-center">
                    <i class="bi bi-hdd-rack"></i>
                    <span class="ml-3">Return Book</span>
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center">
                    <i class="bi bi-person-slash"></i>
                    <span class="ml-3">Block Defaulters</span>
                </a>
            </li>
            <li>
                <a href="{{ url('library/print') }}" class="flex items-center">
                    <i class="bi bi-printer"></i>
                    <span class="ml-3">Print / Download</span>
                </a>
            </li>
            <li>
                <a href="{{url('signout')}}" class="flex items-center">
                    <i class="bi bi-power"></i>
                    <span class="ml-3">Log Off</span>
                </a>
            </li>
        </ul>
    </div>
</aside>