<aside aria-label="Sidebar" id='sidebar'>
    <div class="mt-8 font-bold text-center text-orange-300 uppercase tracking-wider">GHSS</div>
    <div class="text-xs text-center">{{date('M d, Y')}}</div>
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
                <a href="" class="flex items-center p-2">
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