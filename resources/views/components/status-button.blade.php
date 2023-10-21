@props(['fieldName', 'item'])

<?php
$colors = [
    "неизбрано" => "rgb(204, 204, 204)",
    "чакаме оферта" => "rgb(136, 135, 135)",
    "потвърдено Adimari" => "rgb(245, 94, 24)",
    "потвърдено клиент" => "rgb(241, 154, 113)",
    "за поръчка" => "rgb(218, 0, 0)",
    "поръчано" => "rgb(248, 163, 34)",
    "налично" => "rgb(136, 221, 147)",
    "доставено" => "rgb(37, 104, 46)",
    "за корекция" => "rgb(63, 110, 148)"
];

$backgroundColor = $colors[$item[$fieldName]] ?? 'rgb(255, 255, 255)';
?>

<form action="/filter" method="get">
    <input type="hidden" name="filter" value='{{ $fieldName }}:{{ $item[$fieldName] }}'>
    <button type="submit" class="tableButton" style="background-color: {{ $backgroundColor }}; color:black">{{ $item[$fieldName] }}</button>
</form>