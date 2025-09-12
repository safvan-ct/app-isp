@props([
    'title' => 'വിഷയങ്ങൾ',
    'desc' => '📖 അറിവ് തേടൂ, വിശ്വാസം വളർത്തൂ ✨',
    'search' => true,
    'author' => '',
    'review' => '',
])

<div class="card text-center bg-emerald mb-3">
    <h2 class="m-0 mb-1 fw-bold text-accent">{{ $title }}</h2>
    <p class="m-0">{{ $desc }}</p>

    @if ($author || $review)
        <div class="small mt-2 text-accent">
            ✍️ Author: {{ $author ? $author : 'Author Name' }} • {{ $review ? 'Reviewed • ' : '' }} Verified <br>
            {{ $review ? '⏱️ Last review: ' . $review : '' }}
        </div>
    @endif

    @if ($search)
        <div class="search-bar input-group mt-3">
            <input type="search" class="form-control" placeholder="Search topics..." aria-label="Search">
            <button class="btn bg-warning" type="button"><i class="fas fa-search"></i></button>
        </div>
    @endif
</div>
