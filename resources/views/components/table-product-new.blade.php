@props(['fieldName', 'item'])
<div class="fancy_table_item">
    <div class="table_section">
        <img src ="{{$item->image}}">
    </div>

        <div class="table_section ">
            <h5><x-filter-button fieldName="room" :item="$item" :class="'small'"/></h5>
            <h1>{{$item->itemName}}</h1>
            <br>
            <h5>Category</h5>
            <h1><x-filter-button fieldName="category" :item="$item" :class="'big'" /></h1>
        </div>
        <div class="table_section">
            <h5>Company Name</h5>
            <h1><x-filter-button fieldName="company" :item="$item" :class="'big'" /></h1>
            <br>
            <h5>Provider Name</h5>
            <h1><x-filter-button fieldName="provider" :item="$item" :class="'big'" /></h1>
        </div>
        <div class="table_section">
            <h5>{{$item->measure}}</h5>
            <h1>{{$item->count}}</h1>
        </div>
        <div class="table_section">
            <h5>Description</h5>
            <h2>{{$item->description}}</h2>
        </div>
        <div class="table_section">
            <h5>Status</h5>
            <h1><x-status-button fieldName="status" :item="$item" :class="'status'" /></h1>
            <br>
            <td class="column17"><button onClick="ShowEditBox('{{$item}}');" class="editButton table_buttton_status">Edit</button></td>
        </div>
</div>