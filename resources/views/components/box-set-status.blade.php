<div class="setSatus"> <h1>Set Status</h1> <form action="/SetStatus" method="POST">
    @csrf
    <div class="itemName">
    <label for="name">Name</label>
    <input type="text" name="name" placeholder="Name" value="{{ old('name') }}"><br>
    </div>
    <div class="itemStatus">
        <label for="status">Status</label>
        <select name="measure">
        <option value="0">Неизбрано</option>
        <option value="1">Чакаме Оферта</option>
        <option value="2">За Поръчка</option>
        </select>
    </div>
    <button type="submit">Set Status</button>
    @if($errors->any())
    <div>
        <ul>
            @foreach($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
    @endif
    </form>


</div>