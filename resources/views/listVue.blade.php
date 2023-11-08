<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <link rel="stylesheet" href="/css/VueListStyle.css">
    <link rel="stylesheet" href="/css/fanctList.css">
    <title>Project Vue</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <x-header data="List"/>

    <div id="app">
        <div class="addItemButtons" @click="addItem">   
            <p>Add item</p>
            <img src="https://laravel-tzani.s3.eu-west-1.amazonaws.com/img/add.png">
        </div>
        <div class="search">
            <input type="text" v-model="search" placeholder="Search">
            <button v-if="search.length" @click="() => {search = ''}"  class="clearSearch">X</button>
        </div>
        <div class="filterSticky"  v-if="activeFilters.length">
            <div class="activeFilterPill" v-for="activefilter in activeFilters" :key="activefilter" @click="addFilter(activefilter.type,activefilter.content)"> @{{activefilter.content}}</div>
            <button @click="clearFilters" id="clearFilters">Clear</button>
        </div>


        <div class="filters" v-if="showFilters">      
            <div id="filtersRooms" class="dropdown" v-for="filterType in filterTypes" :key="filterType">
                <div class="filterHeader">@{{filterType.key}}</div>
                <button class="filterButton "v-for="filter in filterType.value" :key="filter" @click="addFilter(filterType.key,filter)" :class="{activeButton: filterPresent(filterType.key,filter)}">@{{filter}}</button><br>
            </div>
            <div>
                <button @click="clearFilters" id="clearFilters">Clear Filters</button>
            </div>
        </div>
        <div>   
            <button @click="toggleFilters" class="showFilters">@{{showFilters ? "▲ Hide Filters ▲" : "▼ Show Filters ▼"}}  </button>
        </div>








        <p> Showing @{{filteredData.length}} items</p>
        <!-- Table of items -->
        <div class="table" v-if="filteredData.length">
            <div v-for="(item, index) in filteredData" :key="item.id" class="tableItem" >
                <!-- Check if the current room is different from the previous room -->
                <div class="roomTitle" v-if="index === 0 || item.room !== filteredData[index - 1].room">
                    <h1>@{{ item.room }}</h1>
                    <hr/>
                </div>

                <div class="fancy_table_item">

                    <div class="table_section" id="itemImage">
                        <img :src =item.image @click = "editItem(item)">
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
                    @if (Auth::check())
                    @if (auth()->user()->clearance > 1)
                    <div class="table_section">
                        <h5>Price</h5>
                        <h1>@{{item.price1}} лв.</h1>
                        <h5>Price 2</h5>
                        <h1>@{{item.price2}} лв.</h1>
                    </div>
                    @endif
                    @endif
                    <div class="table_section" id="statusBar" :style="{ 'background-color': activeColor(item.status)[0]}" @click = "editItem(item)">
                        <h5>Status</h5>
                        <h2 :style= "{color :  activeColor(item.status)[1]}">@{{item.status}}</h2>
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


        <div class="editModal" v-if="editTarget" @click.self = "closeEdit">
            <div class="edit_table_item">
                    <h1>Edit Item</h1>  
                    <h5>Click "Update" to save changes</h5>
                        <div class="editSection">
                            <img :src = "editTarget.image">
                            <form id="fileUploadForm" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="file">Select File</label>
                                <input type="file"  @change="upload($event)" id="file-input">
                            </div>
                            </form>
                            <div v-if="uploadMessages.length">
                                <div v-for="message in uploadMessages" :key="message"  :style="{color : (message.type == 'error' ? 'red' : 'green') }">
                                    <h3>@{{message.message}}</h3>
                                </div>
                            </div>
                            <label for="image" id="editLabel_image"> Image URL </label>
                            <input type="text" name="image" id="editLabel_image" placeholder = "e.g. somthing.png" v-model = "editTarget.image" v-model = "editTargetFields" >
                        </div>



                        <div class="editSection">
                            <label for="itemName" id="editLabel_itemName"> Name </label>
                            <input type="text" name="itemName" id="editItem_itemName" placeholder = "e.g. Висяща Лампа" v-model = "editTarget.itemName"  v-model = "editTargetFields">
                            <label for="room" id="editLabel_room"> Room </label>
                            <input type="text" name="room" id="editItem_room" placeholder = "e.g. Дневна" v-model = "editTarget.room" >
                            <label for="category" id="editLabel_category"> Category </label>
                            <input type="text" name="category" id="editItem_category" placeholder = "e.g. Мебели" v-model = "editTarget.category"  v-model = "editTargetFields">
                        </div>

                        <div class="editSection">
                            <!--A number input with a min value of 0 and a max value of 10000 -->
                            <label for="count" id="editLabel_count"> Count </label>
                            <input type="number" name="count" id="editItem_count" min="0" max="10000" placeholder = "e.g. 1" v-model = "editTarget.count"  v-model = "editTargetFields">


                            <!-- A dropdown with 3 options: "Lighting", "Furniture", "Other" -->
                            <label for="measure" id="editLabel_measure">Measure</label>
                            <select name="measure" id="editItem_measure" v-model = "editTarget.measure"  v-model = "editTargetFields">
                                <option value="м2">m2</option>
                                <option value="бр.">бр.</option>
                                <option value="м">м</option>
                            </select>

                            <label for="company" id="editLabel_company">Company</label>
                            <input type="text" name="company" id="editItem_company" placeholder = "e.g. Minotti" v-model = "editTarget.company"  v-model = "editTargetFields">
                            <label for="provider" id="editLabel_provider">Provider</label>
                            <input type="text" name="provider" id="editItem_provider" placeholder = "e.g. SDD" v-model = "editTarget.provider"  v-model = "editTargetFields">
                        </div>


                        <div class="editSection">
                            <label for="description" id="editLabel_description">Comment</label>
                            <textarea name="description" id="editItem_description" cols="30" rows="5"  v-model = "editTarget.description"  v-model = "editTargetFields">"Placeholder"</textarea>

                            <!-- A dropdown with 8 options: "Lighting", "Furniture", "Other" -->
                            <label for="status" id="editLabel_status" >Status</label>
                            <select name="status" id="editItem_status" v-model = "editTarget.status"  v-model = "editTargetFields">
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
                            <input type="text" name="proforma" id="editItem_proforma" placeholder = "e.g. 1707" v-model = "editTarget.proforma"  v-model = "editTargetFields">
                        </div>
                        @if (Auth::check())
                        @if (auth()->user()->clearance > 1)
                        <div class="editSection">   
                            <label for="price1" id="editLabel_price1">Price 1</label>
                            <input type="number" name="price1" id="editItem_price1" min="0" max="100000" placeholder = "e.g. 1000" v-model = "editTarget.price1"  v-model = "editTargetFields">
                            <label for="price2" id="editLabel_price2">Price 2</label>
                            <input type="number" name="price2" id="editItem_price2" min="0" max="100000" placeholder = "e.g. 880" v-model = "editTarget.price2"  v-model = "editTargetFields">
                        </div>
                        @endif
                        @endif

                        <div class="editSection">   
                            <div v-if="editErrors.length" class="error">
                                <h2 v-for="message in editErrors" :key="message" :style="{color : (message.type == 'error' ? 'red' : 'green') }">@{{message.message}}</h2>
                            </div>
                        </div>


                        <button @click="submitForm">@{{action}}</button>
                        <button @click="deleteItem" v-if="action == 'Update'">Delete Item</button>
                        <button @click="() => { editTarget = null }">Cancel</button>

                
            </div>
        </div>

    </div>

    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <script type="module" src="/js/controller.js" name="tzani"></script>
</body>
</html>