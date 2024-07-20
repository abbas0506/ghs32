<aside aria-label="Sidebar" id='sidebar'>
    <div class="mt-8 font-bold text-center text-orange-300 uppercase tracking-wider">GHSS</div>
    <div class="text-xs text-center">Chak Bedi, Pakpattan</div>
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
                <a href="{{route('library.books.create')}}" class="flex items-center p-2">
                    <i class="bi bi-book"></i>
                    <span class="ml-3">Add Book</span>
                </a>
            </li>
            <li>
                <a href="{{route('library.qrcodes.index')}}" class="flex items-center p-2">
                    <i class="bi bi-qr-code"></i>
                    <span class="ml-3">QR Codes</span>
                </a>
            </li>
        </ul>
    </div>
</aside>