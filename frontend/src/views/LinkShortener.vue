<template>
</template>

<script>
    import axios from 'axios'

    export default {
        data() {
            return {
                slug: this.$route.params.id,
            }
        },
        mounted() {
            this.retrieveLink(this.slug)
        },
        methods: {
            retrieveLink(slug) {
                axios.get(`http://localhost:8000/api/links/${slug}`)
                    .then(response => {
                        window.location.href = response.data.url;
                    })
                    .catch(error => {
                        this.$router.push('/Error/NotFound');
                        console.error(error.response.data.error)
                    });
            },
        },
    }
</script>

<style lang="scss" scoped>

</style>