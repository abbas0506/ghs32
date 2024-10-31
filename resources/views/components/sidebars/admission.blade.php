<aside aria-label="Sidebar" id='sidebar'>
    <div class="flex justify-center items-center h-24 mt-6">
        <img src="{{asset('images/logo/app_logo_transparent.png')}}" alt="logo" class="w-20">
    </div>
    <div class="mt-8 font-bold text-center text-orange-300 uppercase tracking-wider">Teacher Panel</div>
    <label class="text-xs text-center text-teal-600">GHSS Chak Bedi, Pakpattan</label>

    @if(Auth::user()->roles->count()>1)
    <div class="grid gap-2 mt-4 text">
        @foreach(Auth::user()->roles as $role)
        @if($role->name!='admission')
        <a href="{{ url('switch/as',$role->name) }}" class="btn-teal text-xs font-normal text-center rounded">Switch to {{ $role->name }} </a>
        @endif
        @endforeach
    </div>
    @endif

    <div class="mt-12">
        <ul class="space-y-2">
            <li>
                <a href="{{ url('/') }}" class="flex items-center p-2">
                    <i class="bi-house"></i>
                    <span class="ml-3">Home</span>
                </a>
            </li>

            <li>
                <a href="" class="flex items-center p-2">
                    <i class="bi bi-journal-check"></i>
                    <span class="ml-3">Merit Lists</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admission.sections.index') }}" class="flex items-center p-2">
                    <i class="bi-diagram-3"></i>
                    <span class="ml-3">Sections</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admission.cards.index') }}" class="flex items-center p-2">
                    <i class="bi-person-badge"></i>
                    <span class="ml-3">Student Cards</span>
                </a>
            </li>
        </ul>
    </div>
</aside>