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
    <a href="/list" class=" mt-2 ml-2">
                <button type="button" class="btn btn-default">
                    Clear search
                </button>
    </a>  
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
            <th class="column17">Delete</th>
        </tr>

        
<?php
$roomName = ''; // Initialize the roomName variable
?>

<div style="display:none"> 
{{$shownItems = 0}}
</div>
@foreach($products as $item)
<div style="display:none"> 
{{$shownItems += 1}}
</div>
@if($roomName != $item->room)
    <tr>
        <td colspan="{{$numColumns}}" class="roomSplit"><x-filter-button fieldName="room" :item="$item" /></td>
        
    </tr>
    
    <?php
    $roomName = $item->room; // Update the roomName variable
    ?>
@endif
        
        <tr>
            <x-table-product fieldName="name" :item="$item" />
        </tr>

@endforeach
@if($shownItems == 0)
    <?php
    header("Location: /list");
    exit;
    ?>
@endif
    </table>


    <ul class="pagination">
        {{$products->links()}}
    </ul>

    <x-pop-up-box-edit/>
    <x-pop-up-box-add/>


</body>
</html>