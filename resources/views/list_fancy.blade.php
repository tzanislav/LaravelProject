<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item list</title>
    <script src="/js/popup_box.js"></script>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/fanctList.css">
    <?php
    // Get the number of columns in the table
    $columns = DB::select("SHOW COLUMNS FROM products");
    $numColumns = count($columns);
    ?>
</head>
<body>
    
    <x-header data="Product list Page for _ project" />
    <br>
    <button class="addButton" onclick="ShowAddBox()">Add Item</button>
    <br>

     <x-search-bar />
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if (isset($filterList) && $filterList != null)
    <div class="filterList">
        <h3>Filters:</h3>
        @foreach($filterList as $filter)
        <form action="/RemoveFilter" method="get">
            <input type="hidden" name="filter" value='{{ $filter }}'>
            <button type="submit" class="tableButton">{{ $filter }}</button>
        </form>
        @endforeach

        <form action="/ClearFilter" method="get">
        <button type="submit">Clear</button>
    </form>
    </div>
    @endif


    
    @if(isset($search))
    <h1>Searching: {{ $search }}</h1>
    <a href="/list"><button type="button" class="btn btn-default">Clear search</button>
    </a>  
    @endif

    <div class="main_content">
        <?php
        $roomName = ''; // Initialize the roomName variable
        ?>

        <img src = "https://laravel-tzani.s3.eu-west-1.amazonaws.com/img/Logo+Black.png" class="adimariLogoMid" style="margin: 0 auto">  

        <div style="display:none"> 
        {{$shownItems = 0}}
        </div>
        @foreach($products as $item)
        <div style="display:none"> 
        {{$shownItems += 1}}
        </div>
        @if($roomName != $item->room)

            <x-filter-button fieldName="room" :item="$item" :class="'room'" />    

            <?php
            $roomName = $item->room; // Update the roomName variable
            ?>

        @endif
            <x-table-product-new fieldName="name" :item="$item" />
            <br>
        @endforeach
    </div>





    <ul class="pagination">
        {{$products->links()}}
    </ul>

    <x-pop-up-box-edit/>
    <x-pop-up-box-add/>


</body>
</html>