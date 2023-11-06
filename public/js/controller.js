const app = Vue.createApp({
    data() {
        return {
        data: [],
        filters : [],
        filters2 : [],
        showAll: false,
        loading: true,
        rooms: [],
        categories: [],
        companies: [],
        providers: [],
        statuses: [],
        staticStatuses: [],
        showFilters: false,
        search: '',
        }
    },
    methods: {
      toggleFilters() {
            this.showFilters = !this.showFilters;
        },
        removeFilter(filterFunc) {
            this.filters = this.filters.filter(func => func.toString() !== filterFunc.toString());
          }
        ,          
        clearFilters() {
            this.filters2 = [];
        },
        removeItem(item) {
            this.data = this.data.filter(f => f !== item);
        },

        addFilter(filterType, filterContent)
        {
            const filterExists = this.filters2.some(f => f.type === filterType && f.content === filterContent);
            if(filterExists)
            {
                this.filters2 = this.filters2.filter(f => f.type !== filterType || f.content !== filterContent);
                return;
            }

            this.filters2.push({"type":filterType, "content": filterContent});

        },
        removeFilter(filterType, filterContent)
        {
            this.filters2 = filters2.filter(f => f.type !== filterType && f.content !== filterContent);
        },
        generateFilter() {
          this.data.forEach(item => {
              if(item.room != null && !this.rooms.some(room => room.toLowerCase() === item.room.toLowerCase())){
                if(item.room.length > 1)
                {   
                  this.rooms.push(item.room);
                  console.log("Added room: " + item.room);
                }
              }
              if(item.category != null && !this.categories.some(category => category.toLowerCase() === item.category.toLowerCase())){
                if(item.room.length > 1)
                {  
                  this.categories.push(item.category);

                  console.log("Added category: " + item.category);
                }
              }
              if(item.company != null && !this.companies.some(company => company.toLowerCase() === item.company.toLowerCase())){
                if(item.company.length > 1)
                {       
                  this.companies.push(item.company);
                  console.log("Added company: " + item.company);
                }
              }
              if(item.provider != null && !this.providers.some(provider => provider.toLowerCase() === item.provider.toLowerCase())){
                if(item.room.length > 1)
                {  
                  this.providers.push(item.provider);
                  console.log("Added provider: " + item.provider);
                }
              }
              if(item.status != null && !this.statuses.some(status => status.toLowerCase() === item.status.toLowerCase())){
                if(item.room.length > 1)
                {  
                  this.statuses.push(item.status);
                  console.log("Added status: " + item.status);
                }
              }
          });
      }
      ,
      filterPresent(filterType, filterContent) {
        return this.filters2.some(f => f.type === filterType && f.content === filterContent);
      },
      activeColor (item) {
        if(item == null)
        {
          return "white";
        }
        let status = this.staticStatuses.find(s => s.name.toLowerCase() === item.toLowerCase());
        if(status == null)
        {
          return "gray";
        }
        return status.image;
      }
        
    }
    ,computed: {
      filteredData() {
        let filteredData = [];
        if(this.filters2.length == 0 && this.search.length == 0) {
          return this.data;
        }
        let foundItems  = [];
        //Search
        if(this.search.length > 0) {
          let types = ["itemName", "room", "category", "company", "provider", "status"];
          
          types.forEach(type => {
            this.data.forEach(item => {
              if(item[type] && item[type].toLowerCase().includes(this.search.toLowerCase())) {
                if(!foundItems.some(f => f === item)) {
                  foundItems.push(item);
                  console.log("Found item: " + item.itemName);  
                }
              }
            });  
          })
        }
        else {
          foundItems = this.data;
        }

        this.data.forEach(item => {
          //For each filter
          this.filters2.forEach(filter => {
            if(item[filter.type] && filter.content && item[filter.type].toLowerCase() == filter.content.toLowerCase()) {
              if(!foundItems.some(f => f === item)) {
                filteredData.push(item);
              }              
            }
          });
          //End for each filter      
        });
        //End for each item
        return foundItems ;
      },

    },
    mounted() {
      // Fetch items from API
      axios.get('/api/data')
        .then(response => {
          this.data = response.data;
          console.log("Got data");
          this.generateFilter();
          //this.applyAllFilters();
        })
        .catch(error => {
          console.error('Error fetching data:', error);
        });

        axios.get('/api/statues')
        .then(response => {
          this.staticStatuses = response.data;
          console.log("Got statuses");

          console.log(this.staticStatuses);
        })
        .catch(error => {
          console.error('Error fetching data:', error);
        });
    
      this.loading = false;
    },
   // template: '<h1>Hello {{name}}</h1>',
});

app.mount('#app');
