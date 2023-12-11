<div class="row my-3">
    <nav aria-label="Page navigation example" class="d-flex align-items-center justify-content-center">
        <ul class="pagination">
            <!--Previous-->
            @if ($berita->onFirstPage())
                <li class="page-item disabled">
                    <a class="page-link" href="#" aria-label="@lang('berita.previous')">
                    <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{$berita->previousPageUrl()}}" aria-label="@lang('berita.previous')">
                    <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>    
            @endif

            <!-- Pagination Elements -->
            @foreach (range(1, $berita->lastPage()) as $i)
                @if ($i >= $berita->currentPage() - 2 && $i <= $berita->currentPage() + 2)
                    @if ($i == $berita->currentPage())
                        <li class="page-item aktip" style="background-color : #879fff;">
                            <span class="page-link">{{ $i }}</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $berita->url($i) }}">{{ $i }}</a>
                        </li>
                    @endif
                @endif
            @endforeach

            <!--Tombol next & next disabled-->
            @if ($berita->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $berita->nextPageUrl() }}" rel="next" aria-label="@lang('berita.next')">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            @else
                <li class="page-item disabled">
                    <a class="page-link" href="#" aria-label="@lang('berita.previous')">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            @endif
        </ul>
    </nav>
</div>