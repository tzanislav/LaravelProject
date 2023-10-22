@props(['fieldName', 'item'])



@if($item->id%2 == 0)
    <tr class="even">
@else
    <tr class="odd">
@endif
    <td class="column0">{{$item->id}}</td>
    <td class="column1">{{$item->project}}</td>
    <td class="column2"><x-filter-button fieldName="room" :item="$item" /></td>
    <td class="column3" class="importantItem" >{{$item->itemName}}</td>    
    <td class="column4">{{$item->count}}</td>       
    <td class="column5"><x-filter-button fieldName="category" :item="$item" /></td>
    <td class="column6">{{$item->measure}}</td>
    <td class="column7"><x-filter-button fieldName="company" :item="$item" /></td>
    <td class="column8"><x-filter-button fieldName="provider" :item="$item" /></td>
    <td class="column9">{{$item->description}}</td>
    <td class="column10"><x-status-button fieldName="status" :item="$item" /></td>
    <td class="column11">{{$item->proforma}}</td>
    <td class="column12"><x-filter-button fieldName="owner" :item="$item" /></td>
    <td class="column13"><button onClick="ShowEditBox('{{$item}}');" class="editButton">Edit</button></td>
</tr>