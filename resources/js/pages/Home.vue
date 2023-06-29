<template>

  <div id="home">

    <form @submit.prevent="submit">
      <label for="Title">Title:</label><br>
      <input v-model="title" id="Title" name="Title"><br>
      <div v-if = "errors.title"> Please enter a title.</div>
      <label for="Description">Description:</label><br>
      <textarea v-model="description" rows = "4"  id="Description" name="Description"> </textarea><br>
      <div v-if="errors.description"> Please enter a description</div>
      <button type="submit" class= "Submit">Add</button>
    </form>
<div id="todolist">

  <div v-if="loadingList">
    <div class="loader"> </div>
  </div>

  <div v-else>

  <table>
    <thead class="table-head">
      <tr>
        <th>Title</th>
        <th>Description</th>
        <th>Price</th>
        <th>Image</th>
        <th>Delete</th>
        <th>Edit</th>
      </tr>
    </thead>
    <tbody class="table-body">
      <tr v-for="item in todos">
        <td>{{item.title}}</td>
        <td>{{item.description}}</td>
        <td> </td>
        <td> </td>
        <td><button type="button"  @click="Delete(item.id)">Delete</button></td>
        <td><button type="button" @click="Edit(item.id)">Edit</button></td>

      </tr>
    </tbody>

  </table>

  </div>

</div>
    <div v-if="showedit">
    <form @submit.prevent="submitedit">
      <label for="Title">Title:</label><br>
      <input v-model="edititem.title" id="Title" name="Title"><br>
      <div v-if = "editerrors.title"> Please enter a title.</div>
      <label for="Description">Description:</label><br>
      <textarea v-model="edititem.description" rows = "4"  id="Description" name="Description"> </textarea><br>
      <div v-if="editerrors.description"> Please enter a description</div>
      <button type="submit" class= "Edit" >Edit</button>
    </form>

  </div>
</div>

</template>

<script>
export default {
  name:'home',
  data() {
    return {
      title: '',
      description: '',
      todos:[],
      errors:{},
      editerrors:{},
      edititem:{},
      showedit:false,
      loadingList:true
    }
  },
  mounted(){
    this.getTodos();


  },

  methods: {
    submit() {
      this.errors={};

      axios.post('/api/todo', {
        title: this.title,
        description: this.description,
      })





      .then(response => {
        this.getTodos();
        console.log(response.data);
      })
      .catch(error => {
        this.errors=error.response.data;
        console.log(error.response.data)
      })

      this.title = null
      this.description = null
    },
    Edit(id){

      axios.get('/api/todo/'+id)
        .then(response=>{
          this.edititem=response.data;
          console.log(response.data);


        })
      this.showedit = true;


    },
    submitedit(){
      axios.put('/api/todo/'+this.edititem.id,this.edititem)
        .then(response=>{
          this.getTodos();
          console.log(response.data);
          this.showedit = false;
        })
        .catch(error=>{
          this.editerrors=error.response.data;
          console.log(error.response.data)
        })


    },

    Delete(id){
      axios.delete('/api/todo/'+id)
        .then(response => {
          this.getTodos();
          console.log(response.data);
        })
        .catch(error => {
          console.log(error.response.data)
        })

    },



    getTodos(){
      this.loadingList = true;
      axios.get('/api/todo')
      .then(response => {
        this.todos = response.data;
        console.log(response.data);

       setTimeout(() => {
         this.loadingList=false;
       }, 1000);



      })
      .catch(error => {
        console.log(error.response.data);
        this.loadingList=false;
      })
    },

  }

}
</script>
