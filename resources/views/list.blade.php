<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item list</title>
    <script src="/js/popup_box.js"></script>
    <link rel="stylesheet" href="/css/style.css">
    <?php
    // Get the number of columns in the table
    $columns = DB::select("SHOW COLUMNS FROM products");
    $numColumns = count($columns);
    ?>
</head>
<body>
    <x-header data="Product list Page for _ project" />
    
    <x-search-bar />

    @if(isset($filter))
    <h1>Filter: {{ $filter }}</h1>
    <form action="/filter" method="get">
        <button type="submit">Clear Filter</button>
    </form>
    @endif
    @if(isset($search))
    <h1>Searching: {{ $search }}</h1>
    <form action="/filter" method="get">
        <button type="submit">Clear Filter</button>
    </form>
    @endif

    <table>
        <tr>
            <?php
            // Generate <th> elements based on the number of columns
            for ($i = 0; $i < $numColumns; $i++) {
                $column = $columns[$i];
                echo "<th class=column{$i}>" . $column->Field . "</th>";
            }
            ?>
            <th class="column13">Delete</th>
        </tr>

        @foreach($products as $item)
        <tr>
            <x-table-product fieldName="name" :item="$item" />
        </tr>
        @endforeach
    </table>


    <ul class="pagination">
        {{$products->links()}}
    </ul>

    <x-box-delete />

    <div class="delete">
        <div class="itemName">
            <p>Are You Sure You Want To Delete This Item?</p>
            <label for="Id" id="item_Id">Name</label>
            <br>
            <label for="name" id="delete_name">Name</label>

            <br><br><br><br>
        </div>
        <form id="delete_form" method="POST">
            @csrf
            <button type="submit">Delete</button>
        </form>
        <button onClick="HideDeleteBox()">Cancel</button>
    </div>
</body>
</html>
