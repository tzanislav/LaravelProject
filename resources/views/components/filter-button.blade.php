@props(['fieldName', 'item'])

<form action="/AddFilter" method="get" >
    <input type="hidden" name="filter" value='{{ $fieldName }}:{{ $item[$fieldName] }}'>
    <button type="submit" class="tableButton">{{ $item[$fieldName] }}</button>
</form>

