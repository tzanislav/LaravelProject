<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <link rel="stylesheet" href="/css/VueListStyle.css">
    <link rel="stylesheet" href="/css/fanctList.css">
    <title>Learning Vue</title>
    <!--
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
    -->
</head>
<body>
    <x-header data="List"/>

    <div id="app">
        <div>   
            <button @click="toggleFilters" class="showFilters">Toggle Filters</button>
        </div>
        <div class="filters" v-if="showFilters">
            
            <div>
                <button @click="clearFilters" id="clearFilters">Clear</button>
            </div>
            <div id="filtersRooms" class="dropdown">
                <div class="filterHeader">Rooms</div>
                <button class="filterButton "v-for="room in rooms" :key="room" @click="addFilter('room',room)" :class="{activeButton: filterPresent('room',room)}">@{{room}}</button><br>
            </div>
            <div id="filtersCategories" class="dropdown">
                <div class="filterHeader">Categories</div>
                <button class="filterButton "v-for="category in categories" :key="category" @click="addFilter('category',category)" :class="{activeButton: filterPresent('category',category)}">@{{category}}</button><br>
            </div>
            <div id="filtersCompanies" class="dropdown"> 
                <div class="filterHeader">Companies</div>
                <button class="filterButton "v-for="company in companies" :key="company" @click="addFilter('company',company)" :class="{activeButton: filterPresent('company',company)}">@{{company}}</button><br>
            </div>
            <div id="filtersCompanies" class="dropdown"> 
                <div class="filterHeader">Provider</div>
                <button class="filterButton "v-for="provider in providers" :key="provider" @click="addFilter('provider',provider)" :class="{activeButton: filterPresent('provider',provider)}">@{{provider}}</button><br>
            </div>
            <div id="filtersStatuses" class="dropdown">   
                <div class="filterHeader">Statuses</div>
                <button class="filterButton "v-for="status in statuses" :key="status" @click="addFilter('status',status)" :class="{activeButton: filterPresent('status',status)}">@{{status}}</button><br>
            </div>

        </div>



        <p> Showing @{{filteredData.length}} items</p>
        <!-- Table of items -->
        <div class="table" v-if="filteredData.length">
            <div  v-for="item in filteredData" :key="item.id" class="tableItem">
                <div class="fancy_table_item">

                    <div class="table_section" id="itemImage">
                        <img :src =item.image>
                    </div>

                    <div class="table_section ">
                        <h1>@{{item.itemName}}</h1>
                        <br>
                        <h5>Room</h5>
                        <button class="filterButton"@click="addFilter('room',item.room)">@{{item.room}}</button>
                        <br>
                        <h5>Category</h5>
                        <button class="filterButton"@click="addFilter('category',item.category)">@{{item.category}}</button>
                    </div>
                    <div class="table_section">
                        <h5>Company Name</h5>
                        <button class="filterButton"@click="addFilter('company',item.company)">@{{item.company}}</button>
                        <br><br>
                        <h5>Provider Name</h5>
                        <button class="filterButton"@click="addFilter('provider',item.provider)">@{{item.provider}}</button>
                    </div>
                    <div class="table_section">
                        <h5>@{{item.measure}}</h5>
                        <h1>@{{item.count}}</h1>
                    </div>
                    <div class="table_section">
                        <h5>Description</h5>
                        <h2>@{{item.description}}</h2>
                    </div>
                    <div class="table_section"  id='statusBar'>
                        <h5>Status</h5>
                        <button class="filterButton"@click="addFilter('status',item.status)">@{{item.status}}</button>
                        <br>
                    </div>

                </div>
            </div>

            <p>End of items</p>
        </div>
        <!-- End of items -->
        <div v-else>
            <div v-if="loading">Loading...</div>
            <div v-else><p>No items found</p></div>
        </div>
    </div>

    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <script type="module" src="/js/controller.js" name="tzani"></script>
</body>
</html>