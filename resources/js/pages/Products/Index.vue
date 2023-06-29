<template>

<div id = "products">

  <div class="flex">

    <div class="flex-auto">



    </div>


  </div>

  <hr class="Page-Horizon">






  <div class = "grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">


    <div v-for="product in products">
      <div class = "box">
        <div class =  "image">
          <img :src="product.image_url" alt="product.title">
        </div>
        <hr class="Box-Segment">
          <div class = "title">{{product.title}}</div>

          <div class = " price">Price: £{{product.price}}</div>
          <div class="flex justify-centre">
        <div class = "flex-none mx-auto description">{{product.description}}</div>
      </div>
        <div class="View">
          <router-link :to="'/products/' + product.id" class = "button">View</router-link>
        </div>
        <div class="ATC">
          <router-link :to="'/products/basket'" @click="AddToCart(product.id)" class = "button">Add to cart</router-link>
        </div>


      </div>
    </div>



  </div>
  <br>
  <hr class="Page-Horizon">



</div>

</template>





<script >
export default {
  name: 'ProductsIndex',
  data(){
    return{
      products: [],
      loadingList: true
    }
  },
  mounted(){
    this.getProducts();
  },
  methods:{

      AddToCart(id) {
      axios.post('/api/basket', {
          product_id: id,
          qty:1,
        })
        .then(response => {
          this.$router.push('/products/basket');
        })
        .catch(error => {
          console.log(error.response.data)
        })


    },



    getProducts(){
      axios.get('/api/products')
      .then(response => {
        this.products = response.data;
        this.loadingList = false;
      })
      .catch(error => {
        console.log(error.response.data)
      })
    }
  }


}
</script>
