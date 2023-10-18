<!DOCTYPE html>
<html>
<head>
    <title>Four Images with Captions</title>
</head>
<body>

<style>
    body {
        background-color: #FFF;
        margin: 0;
    }
    .main {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-family: sans-serif;
        padding: 20px;
        text-align: center;
    }
    .back-button {
        top: 20px;
        left: 20px;
        background-color: #fff;
        color: #333;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
    }
</style>

    <x-Header data="Restricted" style />
    <div class="main">
        <h1>You are in!</h1>
        <button class="back-button" onclick="window.history.back()">Go Back</button>
    </div>
    
</body>
</html>

