<aside aria-label="Sidebar" id='sidebar'>
    <div class="flex justify-center items-center h-24 mt-6">
        <img src="{{asset('images/logo/app_logo_transparent.png')}}" alt="logo" class="w-20">
    </div>
    <div class="mt-8 font-bold text-center text-orange-300 uppercase tracking-wider">Admin</div>
    <hr class="border-teal-600 border-2 rounded-full mt-3 w-1/2 mx-auto">

    <div class="mt-12">
        <ul class="grid gap-y-4 font-medium">
            <li>
                <a href="{{url('admin')}}" class="flex items-center">
                    <i class="bi-house"></i>
                    <span class="ml-3">Home</span>
                </a>
            </li>
            <li>
                <a href="{{route('admin.users.index')}}" class="flex items-center">
                    <i class="bi bi-person-gear"></i>
                    <span class="ml-3">Users</span>
                </a>
            </li>
            <li>
                <a href="{{route('admin.teachers.index')}}" class="flex items-center">
                    <i class="bi bi-person-gear"></i>
                    <span class="ml-3">Teachers</span>
                </a>
            </li>
            <li>
                <a href="{{route('admin.sections.index')}}" class="flex items-center">
                    <i class="bi bi-person-gear"></i>
                    <span class="ml-3">Sections</span>
                </a>
            </li>
            <li>
                <a href="{{route('admin.events.index')}}" class="flex items-center">
                    <i class="bi bi-person-gear"></i>
                    <span class="ml-3">Events</span>
                </a>
            </li>
            <li>
                <a href="{{route('admin.alumni.index')}}" class="flex items-center">
                    <i class="bi bi-person-gear"></i>
                    <span class="ml-3">Alumni</span>
                </a>
            </li>
            <li>
                <a href="{{route('admin.subjects.index')}}" class="flex items-center">
                    <i class="bi-book"></i>
                    <span class="ml-3">Subjects</span>
                </a>
            </li>
            <li>
                <a href="{{route('admin.section.lecture.allocations.index',[0,0])}}" class="flex items-center">
                    <i class="bi-clock"></i>
                    <span class="ml-3">Schedule</span>
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