@props(['fieldName', 'item'])

<form action="/filter" method="get" >
    <input type="hidden" name="filter" value='{{ $fieldName }}:{{ $item[$fieldName] }}'>
    <button type="submit" class="tableButton">{{ $item[$fieldName] }}</button>
</form>

