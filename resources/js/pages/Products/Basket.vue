
<template>
<div id="basket">

  <h2>Basket:</h2>

  <div v-if="loadingList">
    <div class="loader"> </div>
  </div>

  <div v-else>
    <table>
      <thead>
      <tr>
        <th>Product Name</th>
        <th>Qty</th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="item in basket">
        <td>{{ item.product.title }}</td>
        <td>{{ item.quantity }}</td>
      </tr>
      </tbody>
    </table>
  </div>




</div>
</template>


<script>

export default {
  name: 'Basket',
  data() {
    return {
      basket: [],
      loadingList: true
    }
  },
  mounted() {
    this.getBasket();
  },
  methods: {
    getBasket() {
      axios.get('/api/basket')
        .then(response => {
          this.basket = response.data;
          this.loadingList = false;
        })
        .catch(error => {
          console.log(error.response.data)
        })
    }
  }
}

</script>
