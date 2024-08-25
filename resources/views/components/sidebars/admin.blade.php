<aside aria-label="Sidebar" id='sidebar'>
    <div class="mt-8 font-bold text-center text-orange-300 uppercase tracking-wider">GHSS</div>
    <div class="text-xs text-center">Chak Bedi, Pakpattan</div>
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
                    <span class="ml-3">Grades</span>
                </a>
            </li>

            <li>
                <a href="{{route('admin.sections.index')}}" class="flex items-center p-2">
                    <i class="bi-people"></i>
                    <span class="ml-3">Sections</span>
                </a>
            </li>
            <li>
                <a href="{{route('admin.teachers.index')}}" class="flex items-center p-2">
                    <i class="bi-person"></i>
                    <span class="ml-3">Teachers</span>
                </a>
            </li>
            <li>
                <a href="{{route('admin.users.index')}}" class="flex items-center p-2">
                    <i class="bi bi-person-gear"></i>
                    <span class="ml-3">Users</span>
                </a>
            </li>

        </ul>
    </div>
</aside>