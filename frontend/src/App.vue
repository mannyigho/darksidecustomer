<template>
  <Header title="DARKSIDE" />
  <router-view></router-view>
</template>

<script>
import Header from './components/pages/Header.vue'

export default {
  name: 'App',
  components: {
   Header,
  }
}
</script>

<style>

</style>
