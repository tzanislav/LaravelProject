@props(['item'])
@if($errors->any() && session('form') == 'addItem')
<div class="addBox" style="display:block" > 
@else
<div class="addBox" > 
@endif
    <h1>Add New Item</h1>
    <br>


<link rel="stylesheet" href="/css/pop-up-add.css">
<form id="update_form" method="POST" action="/addItem/" class="settings">  
    @csrf   
    <label for="itemName" id="editLabel_itemName"> Name </label>
    <input type="text" name="itemName" id="editItem_itemName" placeholder="e.g. Висяща Лампа" value="{{ old('itemName') }}">
    
    <label for="room" id="editLabel_room"> Room </label>
    <input type="text" name="room" id="editItem_room" placeholder="e.g. Дневна" value="{{ old('room') }}">
    
    <label for="category" id="editLabel_category"> Category </label>
    <input type="text" name="category" id="editItem_category" placeholder="e.g. Мебели" value="{{ old('category') }}">

    <label for="count" id="editLabel_count"> Count </label>
    <input type="number" name="count" id="editItem_count" min="0" max="10000" placeholder="e.g. 1" value="{{ old('count') }}">

    <label for="measure" id="editLabel_measure"> Measure</label>
    <select name="measure" id="editItem_measure">
        <option value="м2" {{ old('measure') == 'м2' ? 'selected' : '' }}>m2</option>
        <option value="бр" {{ old('measure') == 'бр' ? 'selected' : '' }}>бр.</option>
        <option value="м" {{ old('measure') == 'м' ? 'selected' : '' }}>м</option>
    </select>

    <label for="company" id="editLabel_company"> Company</label>
    <input type="text" name="company" id="editItem_company" placeholder="e.g. Minotti" value="{{ old('company') }}">

    <label for="provider" id="editLabel_provider"> Provider</label>
    <input type="text" name="provider" id="editItem_provider" placeholder="e.g. SDD" value="{{ old('provider') }}">

    <label for="description" id="editLabel_description"> Comment</label>
    <textarea name="description" id="editItem_description" cols="30" rows="5">{{ old('description') }}</textarea>

    <label for="status" id="editLabel_status"> Status</label>
    <select name="status" id="editItem_status">
        <option value="неизбрано" {{ old('status') == 'неизбрано' ? 'selected' : '' }}>неизбрано</option>
        <option value="чакаме оферта" {{ old('status') == 'чакаме оферта' ? 'selected' : '' }}>чакаме оферта</option>
        <option value="потвърдено Adimari" {{ old('status') == 'потвърдено Adimari' ? 'selected' : '' }}>потвърдено Adimari</option>
        <option value="потвърдено клиент" {{ old('status') == 'потвърдено клиент' ? 'selected' : '' }}>потвърдено клиент</option>
        <option value="за поръчка" {{ old('status') == 'за поръчка' ? 'selected' : '' }}>за поръчка</option>
        <option value="поръчано" {{ old('status') == 'поръчано' ? 'selected' : '' }}>поръчано</option>
        <option value="налично" {{ old('status') == 'налично' ? 'selected' : '' }}>налично</option>
        <option value="доставено" {{ old('status') == 'доставено' ? 'selected' : '' }}>доставено</option>
        <option value="за корекция" {{ old('status') == 'за корекция' ? 'selected' : '' }}>за корекция</option>
    </select>

    <label for="proforma" id="editLabel_proforma"> Proforma No.</label>
    <input type="text" name="proforma" id="editItem_proforma" placeholder="e.g. Minotti" value="{{ old('proforma') }}">

    <button type="submit" id="update_Button">Add</button>
</form>
@if($errors->any())
<div>
    <ul>
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
</div>
@endif

    <br><br>

    <div class="buttons">
        <div>
            <button class="close" onclick="HideAddBox()">Cancel</button>
        </div>
    </div>
 </div>