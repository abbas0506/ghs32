<aside aria-label="Sidebar" id='sidebar'>
    <div class="mt-24 font-bold text-center text-orange-300 uppercase tracking-wider">Teacher Panel</div>
    <label class="text-xs text-center">GHSS Chak Bedi, Pakpattan</label>

    @if(Auth::user()->roles->count()>1)
    <div class="grid gap-2 mt-4 text">
        @foreach(Auth::user()->roles as $role)
        @if($role->name!='teacher')
        <a href="{{ url('switch/as',$role->name) }}" class="btn-teal text-xs font-normal text-center rounded">Switch to {{ $role->name }} </a>
        @endif
        @endforeach
    </div>
    @endif

    <div class="mt-12">

        <ul class="space-y-2">
            <li>
                <a href="{{url('/')}}" class="flex items-center p-2">
                    <i class="bi-house"></i>
                    <span class="ml-3">Home</span>
                </a>
            </li>
            <li>
                <a href="" class="flex items-center p-2">
                    <i class="bi bi-person-gear"></i>
                    <span class="ml-3">Create Test</span>
                </a>
            </li>
        </ul>
    </div>
</aside>