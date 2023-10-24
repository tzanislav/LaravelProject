@props(['item'])
@if($errors->any() && session('form') == 'editItem')
<div class="editBox" style="display:block" > 
@else
<div class="editBox" > 
@endif

    <h1>Edit Item</h1>
    <br>


<link rel="stylesheet" href="/css/pop-up-box.css">
    <form id="update_form" method="POST" class="settings">  
    @csrf   
        <label for="itemName" id="editLabel_itemName"> Name </label>
        <input type="text" name="itemName" id="editItem_itemName" placeholder = "e.g. Висяща Лампа">
        <label for="image" id="editLabel_image"> Image URL </label>
        <input type="text" name="image" id="editLabel_image" placeholder = "e.g. somthing.png">
        <label for="room" id="editLabel_room"> Room </label>
        <input type="text" name="room" id="editItem_room" placeholder = "e.g. Дневна">
        <label for="category" id="editLabel_category"> Category </label>
        <input type="text" name="category" id="editItem_category" placeholder = "e.g. Мебели">


        <!--A number input with a min value of 0 and a max value of 10000 -->
        <label for="count" id="editLabel_count"> Count </label>
        <input type="number" name="count" id="editItem_count" min="0" max="10000" placeholder = "e.g. 1">


        <!-- A dropdown with 3 options: "Lighting", "Furniture", "Other" -->
        <label for="measure" id="editLabel_measure">Measure</label>
        <select name="measure" id="editItem_measure">
            <option value="м2">m2</option>
            <option value="бр.">бр.</option>
            <option value="м">м</option>
        </select>

        <label for="company" id="editLabel_company">Company</label>
        <input type="text" name="company" id="editItem_company" placeholder = "e.g. Minotti">
        <label for="provider" id="editLabel_provider">Provider</label>
        <input type="text" name="provider" id="editItem_provider" placeholder = "e.g. SDD">

        <label for="description" id="editLabel_description">Comment</label>
        <textarea name="description" id="editItem_description" cols="30" rows="5">"Placeholder"</textarea>

        <!-- A dropdown with 8 options: "Lighting", "Furniture", "Other" -->
        <label for="status" id="editLabel_status">Status</label>
        <select name="status" id="editItem_status">
            <option value="неизбрано">неизбрано</option>
            <option value="чакаме оферта">чакаме оферта</option>
            <option value="потвърдено Adimari">потвърдено Adimari</option>
            <option value="потвърдено клиент">потвърдено клиент</option>
            <option value="за поръчка">за поръчка</option>
            <option value="поръчано">поръчано</option>
            <option value="налично">налично</option>
            <option value="доставено">доставено</option>
            <option value="за корекция">за корекция</option>
        </select>
        <label for="proforma" id="editLabel_proforma">Proforma No.</label>
        <input type="text" name="proforma" id="editItem_proforma" placeholder = "e.g. Minotti">


        <br>
        <button type="submit" id="update_Button">Update</button>
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
        <form id="delete_form" method="POST">
                @csrf
                <button type="submit">Delete</button>
        </form> 
        <br>
        <br>
        <div>
            <button class="close" onclick="HideBox()">Cancel</button>
        </div>
    </div>
 </div>