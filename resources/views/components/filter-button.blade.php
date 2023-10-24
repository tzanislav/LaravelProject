@props(['fieldName', 'item' , "class"])

<?php
$class = $class ?? "tableButton";
?>

<form action="/AddFilter" method="get" >
    <input type="hidden" name="filter" value='{{ $fieldName }}:{{ $item[$fieldName] }}'>
    <button type="submit" class="table_buttton_{{$class}}">{{ $item[$fieldName] }}</button>
</form>

