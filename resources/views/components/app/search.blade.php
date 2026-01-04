@props(['books' => [], 'book_id' => 0, 'search' => ''])

<div class="row g-2 justify-content-center">
    <div class="col-12 col-md-auto">
        <select class="form-select rounded-0 border-1 shadow-sm w-100" id="selectedBook"
            style="height: 42px; border-color: var(--clr-gold);">
            @foreach ($books as $item)
                <option value="{{ $item->id }}" @selected($book_id == $item->id)>
                    {{ $item->translation?->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-12 col-md-6 col-lg-4">
        <div class="input-group">
            <input type="search" class="form-control rounded-0 shadow-sm border-end-0" placeholder="Search by hadith number..."
                id="search" data-book="{{ $book_id }}" style="height: 42px; border-color: var(--clr-gold);"
                value="{{ $search }}">
            <button class="btn rounded-0 rounded-end shadow-sm text-white px-3" type="button"
                onclick="searchHadithByNumber()" style="background-color: var(--clr-gold); border: 1px solid var(--clr-gold);">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>
</div>
