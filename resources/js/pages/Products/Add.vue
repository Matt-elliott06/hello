<template>
  <div id="addpage">


  <div v-if="loadingList">
    <div class="loader"> </div>
  </div>
    <div v-else>


  <form @submit.prevent="add">





    <label for="Title">Title:</label><br>
    <input v-model="title" id="Title" name="Title"><br>
    <div v-if = "errors.title"> Please enter a title.</div>

    <label for="Description">Description:</label><br>
    <textarea v-model="description" rows = "4"  id="Description" name="Description"> </textarea><br>
    <div v-if="errors.description"> Please enter a description</div>

    <label for="Price">Price:</label><br>
    <input v-model="price" id="Price" name="Price"><br>
    <div v-if="errors.price"> Please enter a price</div>

    <label for="Image">Image:</label><br>
    <input @change ="HandleImage" type="file" ref = "Image" id="Image" name="Image"><br>
    <div v-if="errors.image"> Please enter a image</div>

    <button type="submit" class= "button Submit">Add</button>
  </form>
    </div>
  </div>


</template>
<script>

export default {
  name: 'Add',
  data(){
    return{
      title: '',
      description: '',
      price: '',
      image: '',

      errors: {
        title: false,
        description: false,
        price: false,
        image: false,
      },
      loadingList:false,
    }
  },


  methods:{

    HandleImage(){
      this.image = this.$refs.Image.files[0];
    },


    add(){

    this.loadingList= true;


      this.errors={};
      let formData = new FormData();


      formData.append('title', this.title);
      formData.append('description', this.description);
      formData.append('price', this.price);
      formData.append('image',this.image);




      axios.post('/api/products', formData,{ headers: {'Content-Type': 'multipart/form-data'}})


        .then(response => {

          setTimeout(() => {
            this.loadingList = false;
            this.$router.push({name: 'ProductsIndex'});
          }, 1000);


        })



        .catch(error =>{
          this.errors=error.response.data;
          console.log(error.response.data);
          this.loadingList = false;

        })






    }


  },







}




</script>
