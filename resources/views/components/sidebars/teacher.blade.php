<aside aria-label="Sidebar" id='sidebar'>
    <div class="flex justify-center items-center h-24 mt-6">
        <img src="{{ asset('images/logo/dark_green.png') }}" alt="logo" class="w-20">
    </div>
    <div class="mt-8 font-bold text-center text-orange-300 uppercase tracking-wider">Teacher</div>
    <div class="text-center text-xs text-slate-500">{{ Auth::user()->teacher?->short_name }}</div>
    <hr class="border-teal-600 border-2 rounded-full mt-3 w-1/2 mx-auto">

    <div class="mt-12">
        <ul class="grid gap-y-4">
            <li>
                <a href="{{ url('/') }}" class="flex items-center">
                    <i class="bi-house"></i>
                    <span class="ml-3">Home</span>
                </a>
            </li>
            <li>
                <a href="" class="flex items-center">
                    <i class="bi-clock"></i>
                    <span class="ml-3">Schedule</span>
                </a>
            </li>
            @if (Auth::user()->teacher?->isIncharge())
                <li>
                    <a href="{{ route('teacher.students.index') }}" class="flex items-center">
                        <i class="bi bi-person-gear"></i>
                        <span class="ml-3">My Class</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('teacher.section.attendance.index', Auth::user()->teacher?->sectionAsIncharge()) }}"
                        class="flex items-center">
                        <i class="bi bi-person-gear"></i>
                        <span class="ml-3">Attendance</span>
                    </a>
                </li>
            @endif
            <li>
                <a href="" class="flex items-center">
                    <i class="bi bi-person-gear"></i>
                    <span class="ml-3">Create Test</span>
                </a>
            </li>
            <li>
                <a href="{{ url('signout') }}" class="flex items-center">
                    <i class="bi bi-power"></i>
                    <span class="ml-3">Log Off</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
