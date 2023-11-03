const app = Vue.createApp({
    data() {
        return {
        data: [],
        filters : [],
        showAll: false,
        loading: true,
        categories: [],
        copmanies: [],
        statuses: [],
        }
    },
    methods: {
        addFilter(filterFunc) {
            if (this.filters.some(func => func.toString() === filterFunc.toString())) 
            {
                console.log("Already in filters");
                this.removeFilter(filterFunc);
                return;
            };

            this.filters.push(filterFunc);
            console.log(filterFunc.toString());
        },
        removeFilter(filterFunc) {
            this.filters = this.filters.filter(func => func.toString() !== filterFunc.toString());
          }
        ,          
        clearFilters() {
            this.filters = [];
        },
        removeItem(item) {
            this.data = this.data.filter(f => f !== item);
        },
        
    }
    ,computed: {
        filteredData() {
            // Apply each filter in the array to the books array
            return this.filters.reduce((filtered, filterFunc) => {
                return filtered.filter(filterFunc);
            }, this.data);     
        }
        

    }
    ,
    mounted() {
        //Fetch items from API
        axios.get('/api/data') 
        .then(response => {
          this.data = response.data;
          console.log("Got data");
        })
        .catch(error => {
          console.error('Error fetching data:', error);
        });

        //Fetch categories from API
        axios.get('/api/categories') 
        .then(response => {
          this.categories = response.data;
          console.log("Got categories");
        })
        .catch(error => {
          console.error('Error fetching categories:', error);
        });

        //Fetch companies from API
        axios.get('/api/companies')
        .then(response => {
          this.companies = response.data;
          console.log("Got companies");
        })
        .catch(error => {
          console.error('Error fetching companies:', error);
        });

        //Fetch statuses from API
        axios.get('/api/statues')
        .then(response => {
          this.statuses = response.data;
          console.log("Got statuses");
        })
        .catch(error => {
          console.error('Error fetching statuses:', error);
        });

        this.loading = false;
    },
   // template: '<h1>Hello {{name}}</h1>',
});

app.mount('#app');
