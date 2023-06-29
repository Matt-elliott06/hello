<template>
  <main>
    <router-view></router-view>

  </main>
</template>

<script>


export default {
  components: {
  },
  computed: {
    user() {
      return this.$store.getters.user
    }
  },
}
</script>
