    <form action="/search" method="GET" role="search">
        @csrf
        <div class="input-group">
            <input type="text" class="form-control" name="search"
                placeholder="Search items"> <span class="input-group-btn">
                <button type="submit" class="btn btn-default">
                    Search
                </button>
            </span>


        </div>
    </form>