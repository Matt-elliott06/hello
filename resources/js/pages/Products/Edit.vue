

<template>


  <div id="Edit">


    <div v-if="loadingList">
      <div class="loader"> </div>
    </div>
    <div v-else>


    <form @submit.prevent="EditProduct">





      <label for="Title">Title:</label><br>
      <input v-model="editproduct.title" id="Title" name="Title"><br>


      <label for="Description">Description:</label><br>
      <textarea v-model="editproduct.description" rows = "4"  id="Description" name="Description"> </textarea><br>


      <label for="Price">Price:</label><br>
      <input v-model="editproduct.price" id="Price" name="Price"><br>


      <label for="Image">Image:</label><br>
      <input @change="HandelImage"  type="file" ref="Image" id="Image" name="Image"><br>

<div class="flex gap-4">
      <button type="submit" class= "button  flex-none">Edit</button>
      <button type="button" @click="DeleteProduct" class= "button  flex-none">Delete</button>
</div>
    </form>
  </div>
  </div>

</template>


<script>




export default {
  name: 'Edit',
  data() {
    return {
      title: '',
      description: '',
      price: '',
      image: '',
      loadingList:false,
      errors: {
        title: false,
        description: false,
        price: false,
        image: false
      },
      editproduct: {}
    }
  },
  mounted() {
    this.loadProduct();
  },



  methods: {
    loadProduct(){
      axios.get('/api/products/' + this.$route.params.id)
        .then(response => {
          this.editproduct = response.data;
          console.log(response.data);
        })

    },
    HandelImage() {
      this.editproduct.image = this.$refs.Image.files[0];

    },



    EditProduct() {
      this.loadingList = true;
      let formData = new FormData();
      formData.append('id', this.editproduct.id);
      formData.append('title', this.editproduct.title);
      formData.append('description', this.editproduct.description);
      formData.append('price', this.editproduct.price);
      formData.append('image',this.editproduct.image);



      axios.post('/api/products/' + this.editproduct.id, formData, { headers: {'Content-Type': 'multipart/form-data'}})


      .then(response => {
        setTimeout(() => {
          this.loadingList = false;
          this.$router.push({name: 'ProductsIndex'});
        }, 1000);
      })


       .catch(error => {
         this.errors = error.response.data.errors;
         console.log(error.response.data.errors);
          this.loadingList = false;

       })

  },

    DeleteProduct() {
      this.loadingList = true;
     axios.delete('/api/products/'+this.$route.params.id)
       .then(response =>{
         setTimeout(() => {
           this.loadingList = false;
           this.$router.push({name: 'ProductsIndex'});
         }, 1000);


          console.log(response.data);
       })
        .catch(error =>{
        console.log(error.response.data);
        })

       }
    },





}
</script>
