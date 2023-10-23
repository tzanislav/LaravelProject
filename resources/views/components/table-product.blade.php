@props(['fieldName', 'item'])



@if($item->id%2 == 0)
    <tr class="even table_Product" >
@else
    <tr class="odd table_Product">
@endif
    <style>
        .column11
        {
            display: none;
        }
        .column12
        {
            display: none;
        }
        .column15
        {
            display: none;
        }
        .column16
        {
            display: none;
        }

    </style>


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
    <td class="column11">{{$item->price1}}</td>
    <td class="column12 ">{{$item->price2}}</td>
    <td class="column13">{{$item->proforma}}</td>
    <td class="column14"><x-filter-button fieldName="owner" :item="$item" /></td>
    <td class="column15">{{$item->created_at}}</td>
    <td class="column16">{{$item->updated_at}}</td>
    <td class="column17"><button onClick="ShowEditBox('{{$item}}');" class="editButton">Edit</button></td>
</tr>