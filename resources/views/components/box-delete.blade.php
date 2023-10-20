
<div class="delete">
    <style>
        .delete {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            border: 1px solid black;
            padding: 20px;
            background-color: white;
            z-index: 1;
        }
        .delete #item_Id
        {
            font-size: 8px;
            color: rgb(185, 185, 185);
        }
        .delete #delete_name
        {
            font-size: 20px;
            font-weight: bold;
        }

        .delete button {
            margin: 10px;
            width: 100%;
        }
        .delete #buttonDel
        {
            background-color: red;
            color: white;
        }

        .delete .itemName {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .delete .itemName label {
            font-weight: bold;
        }

        .delete .itemName p {
            font-weight: bold;
            font-size: 20px;
        }
    </style>
    <div class="itemName">
        <p>Are You Sure You Want To Delete This Item?</p>
        <label for="Id" id="item_Id">ID</label>
        <br>
        <label for="name" id="delete_name">Name</label>

        <br><br><br><br>
    </div>
    <form id="delete_form" method="POST">
        @csrf

        <button type="submit" id="buttonDel">Delete</button>

    </form>
    <button onClick="HideDeleteBox()">Cancel</button>
</div>