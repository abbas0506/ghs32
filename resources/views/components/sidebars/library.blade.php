<aside aria-label="Sidebar" id='sidebar'>
    <div class="mt-8 font-bold text-center text-orange-300 uppercase tracking-wider">GHSS</div>
    <div class="text-xs text-center">{{date('M d, Y')}}</div>
    <div class="mt-12">
        <ul class="space-y-2">
            <li>
                <a href="{{url('library')}}" class="flex items-center p-2">
                    <i class="bi-house"></i>
                    <span class="ml-3">Home</span>
                </a>
            </li>
            <li>
                <a href="{{route('library.book-issuance.scan')}}" class="flex items-center p-2">
                    <i class="bi-upc"></i>
                    <span class="ml-3">Issue Book</span>
                </a>
            </li>
            <li>
                <a href="{{route('library.book-return.scan')}}" class="flex items-center p-2">
                    <i class="bi bi-hdd-rack"></i>
                    <span class="ml-3">Return Book</span>
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center p-2">
                    <i class="bi bi-person-slash"></i>
                    <span class="ml-3">Block Defaulters</span>
                </a>
            </li>
            <li>
                <a href="{{ url('library/print') }}" class="flex items-center p-2">
                    <i class="bi bi-printer"></i>
                    <span class="ml-3">Print / Download</span>
                </a>
            </li>

        </ul>
    </div>
</aside>