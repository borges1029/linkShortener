<script setup>
  import { RouterLink, RouterView } from 'vue-router'
</script>

<template>
  <RouterLink to="/"></RouterLink>
  <RouterLink to="/:id"></RouterLink>
  <RouterLink to="/edit/link/:id"></RouterLink>

  <RouterView />
</template>

<style scoped>
  
</style>
