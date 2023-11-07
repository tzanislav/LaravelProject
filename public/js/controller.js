const app = Vue.createApp({
  data() {
    return {
      data: [],
      activeFilters: [],
      showAll: false,
      loading: true,
      filterTypes: [{ key: 'room', value: [] }, { key: 'category', value: [] }, { key: 'company', value: [] }, { key: 'provider', value: [] }, { key: 'status', value: [] }],
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
      file: null,
      uploadMessage: '',
    }
  },
  methods: {

    //GUI methods
    toggleFilters() {
      this.showFilters = !this.showFilters;
    }
    ,
    clearFilters() {
      this.activeFilters = [];
    },

    addFilter(filterType, filterContent) {
      const filterExists = this.activeFilters.some(f => f.type === filterType && f.content === filterContent);
      if (filterExists) {
        this.activeFilters = this.activeFilters.filter(f => f.type !== filterType || f.content !== filterContent);
        return;

      }
      this.activeFilters.push({ "type": filterType, "content": filterContent });
    },
    removeFilter(filterType, filterContent) {
      this.activeFilters = activeFilters.filter(f => f.type !== filterType && f.content !== filterContent);
    },

    generateFilter() {
      this.data.forEach(item => {
        this.filterTypes.forEach(filter => {
          let filterType = filter.key;
          let filterArray = filter.value;
          if (item[filterType] && !filterArray.some(f => f === item[filterType])) {
            filterArray.push(item[filterType]);
            console.log("Added " + item[filterType] + " to " + filterType);
          }
        });

      });
    }
    ,
    filterPresent(filterType, filterContent) {
      return this.activeFilters.some(f => f.type === filterType && f.content === filterContent);
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
      this.editErrors = [];
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
      this.editErrors = [];

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
          this.editErrors = [];
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
          this.editErrors = [];
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
    
    async upload(event) {
      const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
      console.log(event.target.files[0]);
      try {
        let data = new FormData();
        let file = event.target.files[0];

        data.append('name', 'my-file')
        data.append('file', file)

        let config = {
          header: {
            'Content-Type': 'multipart/form-data'
          }
        }

        const response = await axios.post('/upload', data, {
          headers: {
            'Content-Type': 'multipart/form-data',
            'X-CSRF-TOKEN': csrfToken, // Include the CSRF token in the headers
          }
        });
        if (response.status === 200) {
          console.log("File uploaded " + response.data);
          this.editTarget.image = response.data.url;

        } else {
          // Handle errors if the server request fails.
          console.log("Error uploading file");  
        }
      } catch (error) {

      }
    }

}




  , computed: {
  //Filter data by filters and search
  filteredData() {
    let foundItems = this.data; // Start with a copy of the original data
    const searchLower = this.search.toLowerCase();

    if (searchLower.length > 0) {
      foundItems = foundItems.filter(item => {
        for (let type of ["itemName", "room", "category", "company", "provider", "status"]) {
          if (item[type] && item[type].toLowerCase().includes(searchLower)) {
            return true;
          }
        }
        return false;
      });
    }

    if (this.activeFilters.length == 0) {
      return foundItems;
    }

    let output = foundItems;                      //This all items now

    this.filterTypes.forEach(filter => {          //This are the five types of filters                                      
      let filterType = filter.key;

      let activeFiltersOfType = [];               //Get all active filters that are of that type:
      this.activeFilters.forEach(activeFilter => {
        if (activeFilter.type === filterType) {
          activeFiltersOfType.push(activeFilter);
        }
      });

      if (activeFiltersOfType.length == 0)
        return;

      //We fisrt add all items that match the filters of the same type
      let stepOutput = [];
      activeFiltersOfType.forEach(activeFilter => {

        let acttiveFilterContent = activeFilter.content;
        console.log(acttiveFilterContent)

        //Find the items that match and add them to an array
        console.log("StepOutput length is =======> " + stepOutput.length + " and Output is ==> " + output.length);
        output.forEach(item => {
          if (item[filterType] === acttiveFilterContent) {
            stepOutput.push(item);
          }
        });
        console.log("Output length now is ==============> " + stepOutput.length);


      });
      output = stepOutput; // Put the items that matched in the output so the next step can reduce them further

    });

    console.log("Found items: " + output.length);
    return output;
  }

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
