<aside aria-label="Sidebar" id='sidebar'>
    <div class="mt-24 font-bold text-center text-orange-300 uppercase tracking-wider">Admin Panel</div>
    <label class="text-xs text-center">GHSS Chak Bedi, Pakpattan</label>

    @if(Auth::user()->roles->count()>1)
    <div class="grid gap-2 mt-4 text">
        @foreach(Auth::user()->roles as $role)
        @if($role->name!='admin')
        <a href="{{ url('switch/as',$role->name) }}" class="btn-teal text-xs font-normal text-center rounded">Switch to {{ $role->name }} </a>
        @endif
        @endforeach
    </div>
    @endif

    <div class="mt-12">

        <ul class="space-y-2">
            <li>
                <a href="{{url('admin')}}" class="flex items-center p-2">
                    <i class="bi-house"></i>
                    <span class="ml-3">Home</span>
                </a>
            </li>
            <li>
                <a href="{{route('admin.grades.index')}}" class="flex items-center p-2">
                    <i class="bi-activity"></i>
                    <span class="ml-3">Classes</span>
                </a>
            </li>
            <li>
                <a href="{{route('admin.subjects.index')}}" class="flex items-center p-2">
                    <i class="bi-activity"></i>
                    <span class="ml-3">Subjects</span>
                </a>
            </li>

            <!-- <li>
                <a href="{{route('admin.sections.index')}}" class="flex items-center p-2">
                    <i class="bi-people"></i>
                    <span class="ml-3">Sections</span>
                </a>
            </li> -->
            <li>
                <a href="{{route('admin.teachers.index')}}" class="flex items-center p-2">
                    <i class="bi-person"></i>
                    <span class="ml-3">Teachers</span>
                </a>
            </li>
            <li>
                <a href="{{route('admin.section.lecture.allocations.index',[0,0])}}" class="flex items-center p-2">
                    <i class="bi-person"></i>
                    <span class="ml-3">Allocations</span>
                </a>
            </li>
            <li>
                <a href="{{route('admin.users.index')}}" class="flex items-center p-2">
                    <i class="bi bi-person-gear"></i>
                    <span class="ml-3">Users</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.tests.index') }}" class="flex items-center p-2">
                    <i class="bi bi-person-gear"></i>
                    <span class="ml-3">Tests</span>
                </a>
            </li>

        </ul>
    </div>
</aside>