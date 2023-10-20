<form action="/search" method="GET" role="search">
    @csrf

    @if(isset($search))
    Search Results for: <b>{{ $search }}</b>
    @endif
    <button type="submit">Clear Search</button>


    <div class="input-group">
        <input type="text" class="form-control" name="search"
            placeholder="Search users"> <span class="input-group-btn">
            <button type="submit" class="btn btn-default">
                Search
            </button>
        </span>
    </div>
</form>