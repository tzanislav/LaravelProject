<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <title>Learning Vue</title>
    <style>
        #app {
            margin: 0 auto;
            width: 800px;
            text-align: center;
        }
        li
        {
            list-style: none;
            margin: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            width: 200px;
            cursor: pointer;

        }

        #filterButton
        {
            margin: 0 auto;
            width: 800px;
            text-align: center;
            padding: 10px;
            border: 1px solid #ccc;
            cursor: pointer;
        }

        li.fav {
            color: white;
            background-color: #f3be4a;

        }
    </style>
</head>
<body>
    <x-header data="List"/>

    <div id="app">
        <div class="filters">

            <button class="filterButton "v-for="category in categories" :key="category" @click="addFilter((f) => f.category.includes(category.name))">@{{category.name}}</button><br>
            <button class="filterButton "v-for="company in copmanies" :key="company" @click="addFilter((f) => f.company.includes(company.name))">@{{company.name}}</button><br>
            <button class="filterButton "v-for="status in statuses" :key="status" @click="addFilter((f) => f.status.includes(status.name))">@{{status.name}}</button><br>
        </div>

        <div>
            <button @click="clearFilters">Clear</button>
        </div>
        
        <div v-if="filteredData.length" v-for="item in filteredData" :key="item.id" @click="removeItem(item)">
             @{{item.id}} <b>@{{item.itemName}} </b> in  @{{item.room}}
        </div>
        <div v-else>
            <div v-if="loading">Loading...</div>
            <div v-else><p>No items found</p></div>
        </div>
    </div>

    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <script type="module" src="/js/controller.js" name="tzani"></script>
</body>
</html>