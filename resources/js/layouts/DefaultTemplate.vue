<template>
  <main>
    <pageheader></pageheader>
    <router-view></router-view>
<pagefooter></pagefooter>
  </main>
</template>

<script>
import pagefooter from '../components/pagefooter.vue'
import pageheader from '../components/pageheader.vue'

export default {
  components: {
    pageheader,
    pagefooter
  },
  computed: {
    user() {
      return this.$store.getters.user
    }
  },
}
</script>
