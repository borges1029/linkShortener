<script setup>
    import { useRoute } from 'vue-router'

    const route = useRoute()

    console.log(route.params.id)
</script>

<template>
    <div>
        <h2>Link</h2>
    </div>
</template>

<style lang="scss" scoped>

</style>