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
        showFilters: false,
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
                console.log("Removed filter: " + filterType + " " + filterContent);
                return;
            }

            this.filters2.push({"type":filterType, "content": filterContent});
            console.log("Added filter: " + filterType + " " + filterContent);
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
      },
      applyAllFilters() {
        this.filters2 = [];
        this.rooms.forEach(room => {
          this.addFilter("room", room);
        });
        this.categories.forEach(category => {
          this.addFilter("category", category);
        });
        this.companies.forEach(company => {
          this.addFilter("company", company);
        });
        this.providers.forEach(provider => {
          this.addFilter("provider", provider);
        });
        this.statuses.forEach(status => {
          this.addFilter("status", status);
        });
      }
      ,
      filterPresent(filterType, filterContent) {
        return this.filters2.some(f => f.type === filterType && f.content === filterContent);
      }
        
    }
    ,computed: {
      filteredData() {
        let filteredData = [];
        if(this.filters2.length == 0) {
          return this.data;
        }

        this.data.forEach(item => {
          //For each filter
          this.filters2.forEach(filter => {
            if(item[filter.type] && filter.content && item[filter.type].toLowerCase() == filter.content.toLowerCase()) {
              if(!filteredData.some(f => f === item)) {
                filteredData.push(item);
              }              
            }
          });
          //End for each filter
        });
        //End for each item
        return filteredData;
      }
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
    
      this.loading = false;
    },
   // template: '<h1>Hello {{name}}</h1>',
});

app.mount('#app');
