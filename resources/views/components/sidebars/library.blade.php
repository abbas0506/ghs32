<aside aria-label="Sidebar" id='sidebar'>
    <div class="mt-8 font-bold text-center text-orange-300 uppercase tracking-wider">GHSS</div>
    <div class="text-xs text-center">{{date('M d, Y')}}</div>
    <div class="mt-12">
        <ul class="space-y-2">
            <li>
                <a href="{{url('librarian')}}" class="flex items-center p-2">
                    <i class="bi-house"></i>
                    <span class="ml-3">Home</span>
                </a>
            </li>
            <li>
                <a href="{{route('library.books.index')}}" class="flex items-center p-2">
                    <i class="bi bi-book"></i>
                    <span class="ml-3">Books</span>
                </a>
            </li>
            <li>
                <a href="{{route('library.book-domains.index')}}" class="flex items-center p-2">
                    <i class="bi-diagram-3"></i>
                    <span class="ml-3">Domains</span>
                </a>
            </li>
            <li>
                <a href="{{route('library.book-racks.index')}}" class="flex items-center p-2">
                    <i class="bi bi-hdd-rack"></i>
                    <span class="ml-3">Racks</span>
                </a>
            </li>
            <li>
                <a href="{{route('library.library-rules.index')}}" class="flex items-center p-2">
                    <i class="bi bi-bookmark-check"></i>
                    <span class="ml-3">Library Rules</span>
                </a>
            </li>

            <li>
                <a href="#" class="flex items-center p-2">
                    <i class="bi bi-person-slash"></i>
                    <span class="ml-3">Block Readers</span>
                </a>
            </li>

            <li>
                <a href="{{route('library.qrcodes.index')}}" class="flex items-center p-2">
                    <i class="bi bi-qr-code"></i>
                    <span class="ml-3">Specific QR</span>
                </a>
            </li>

        </ul>
    </div>
</aside>