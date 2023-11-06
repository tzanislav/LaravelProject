const app = Vue.createApp({
  data() {
    return {
      data: [],
      filters: [],
      filters2: [],
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
      editTarget: null,
      targetPrevious: null,
      editTargetFields: [],
      editErrors: [],
      errors: [],
      roomTitle: "",
      action: "Update",
    }
  },
  methods: {

    //GUI methods
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

    addFilter(filterType, filterContent) {
      const filterExists = this.filters2.some(f => f.type === filterType && f.content === filterContent);
      if (filterExists) {
        this.filters2 = this.filters2.filter(f => f.type !== filterType || f.content !== filterContent);
        return;
      }

      this.filters2.push({ "type": filterType, "content": filterContent });
    },
    removeFilter(filterType, filterContent) {
      this.filters2 = filters2.filter(f => f.type !== filterType && f.content !== filterContent);
    },
    generateFilter() {
      this.data.forEach(item => {
        if (item.room != null && !this.rooms.some(room => room.toLowerCase() === item.room.toLowerCase())) {
          if (item.room.length > 1) {
            this.rooms.push(item.room);
            console.log("Added room: " + item.room);
          }
        }
        if (item.category != null && !this.categories.some(category => category.toLowerCase() === item.category.toLowerCase())) {
          if (item.room.length > 1) {
            this.categories.push(item.category);

            console.log("Added category: " + item.category);
          }
        }
        if (item.company != null && !this.companies.some(company => company.toLowerCase() === item.company.toLowerCase())) {
          if (item.company.length > 1) {
            this.companies.push(item.company);
            console.log("Added company: " + item.company);
          }
        }
        if (item.provider != null && !this.providers.some(provider => provider.toLowerCase() === item.provider.toLowerCase())) {
          if (item.room.length > 1) {
            this.providers.push(item.provider);
            console.log("Added provider: " + item.provider);
          }
        }
        if (item.status != null && !this.statuses.some(status => status.toLowerCase() === item.status.toLowerCase())) {
          if (item.room.length > 1) {
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

    //Get status color
    activeColor(item) {
      if (item == null) {
        return ["white", "gray"];
      }
      let status = this.staticStatuses.find(s => s.name.toLowerCase() === item.toLowerCase());
      if (status == null) {
        return ["white", "black"];
      }
      return [status.image, "white"];
    },
    
    //Get room title to separate items
    getRoomTitle(room) {
      if (this.roomTitle != room) {
        console.log("Room changed to: " + room);
        this.roomTitle = room;
        return room;
      }
      return null;
    },


//Edit items

    editItem(item) {
      this.action = "Update";
      this.editTarget = item;
      this.targetPrevious = JSON.parse(JSON.stringify(item));
      console.log("Editing item: " + item.itemName);
    },

    submitEdit() {
      this.submitForm();
    },

    closeEdit() {
      this.editTarget = this.targetPrevious;
      this.editTarget = null;
    },
    addItem() {
      this.action = "Add";

      //Find last index
      let maxId = 0;
      this.data.forEach(item => {
        if (item.id > maxId) {
          maxId = item.id;
        }
      });
      this.editTarget = {
        "itemName": "",
        "room": "No Room",
        "count": "1",
        "measure": "бр.",
        "category": "Category",
        "company": "",
        "provider": "",
        "status": "неизбрано",
        "description": "Description",
        "id": maxId + 1,
      }
      this.data.push(this.editTarget);
    },
    deleteItem() {
      console.log("Deleting item: " + this.editTarget.itemName);
      this.data = this.data.filter(f => f !== this.editTarget);
      this.submitDeleteForm();
    },

//Send edit to server
    async submitForm() {
      try {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const response = await axios.post('/editItem', this.editTarget, {
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken, // Include the CSRF token in the headers
          }
        });
        if (response.status === 200) {
          // Request was successful. You can handle the response here.
          this.editTarget = null;
        } else {
          // Handle errors if the server request fails.
        }
      } catch (error) {
        console.error('An error occurred:', error);
        console.log(error.response.data.message);
        this.editErrors = error.response.data.message;
        if (error.response.status == 401) {
          window.location.href = "/login";
        }
      }
    }
    ,

    async submitDeleteForm() {
      try {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const response = await axios.post('/deleteItem', this.editTarget, {
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken, // Include the CSRF token in the headers
          }
        });
        if (response.status === 200) {
          // Request was successful. You can handle the response here.
          this.editTarget = null;
        } else {
          // Handle errors if the server request fails.
        }
      } catch (error) {
        console.error('An error occurred:', error);
        if (error.response.status == 401) {
          window.location.href = "/login";
        }
      }
    },

  }

  , computed: {
    //Filter data by filters and search
    filteredData() {
      let filteredData = [];
      let foundItems = [];
      if (this.filters2.length == 0 && this.search.length == 0) {
        return this.data;
      }

      //Search
      if (this.search.length > 0) {
        let types = ["itemName", "room", "category", "company", "provider", "status"];

        types.forEach(type => {
          this.data.forEach(item => {
            if (item[type] && item[type].toLowerCase().includes(this.search.toLowerCase())) {
              if (!foundItems.some(f => f === item)) {
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

      if (this.filters2.length == 0) {
        return foundItems;
      }

      foundItems.forEach(item => {
        //For each filter
        this.filters2.forEach(filter => {
          if (item[filter.type] && filter.content && item[filter.type].toLowerCase() == filter.content.toLowerCase()) {
            if (!filteredData.some(f => f === item)) {
              filteredData.push(item);
            }
          }
        });
        //End for each filter      
      });
      //End for each item

      return filteredData;
    },

  },
  mounted() {

    // Fetch items from API
    axios.get('/api/data')
      .then(response => {
        this.data = response.data;
        console.log("Got data");
        //Sort data by room name then by category 
        this.data.sort((a, b) => {
          if (a.room.toLowerCase() > b.room.toLowerCase()) {
            return 1;
          }
          if (a.room.toLowerCase() < b.room.toLowerCase()) {
            return -1;
          }
          if (a.category.toLowerCase() > b.category.toLowerCase()) {
            return 1;
          }
          if (a.category.toLowerCase() < b.category.toLowerCase()) {
            return -1;
          }
          if (a.itemName.toLowerCase() > b.itemName.toLowerCase()) {
            return 1;
          }
          if (a.itemName.toLowerCase() < b.itemName.toLowerCase()) {
            return -1;
          }
          return 0;
        });

        this.generateFilter();
        
      })
      .catch(error => {
        console.error('Error fetching data:', error);
      });

    //Fetch static statuses
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
});

app.mount('#app');
