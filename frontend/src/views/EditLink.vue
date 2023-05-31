<template>
    <div class="container-fluid">
        <div class="row">
            <sideNav></sideNav>
        </div>

        <div class="container mt-6">
            <div class="row" v-for="link in links" :key="link.id">
                <form @submit.prevent="updateLink">
                    <div class="mb-3 mt-3">
                        <label for="destino" class="form-label">URL</label>
                        <input type="text" class="form-control" id="url" placeholder="https://example.com/my-long-url" :value="link.url" @input="itemsSave.url = $event.target.value">
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="titulo" class="form-label">Título <span>(Opcional)</span></label>
                        <input type="text" class="form-control" id="title" :value="link.title" @input="itemsSave.title = $event.target.value">
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="slug" class="form-label">Slug personalizado <span>(Opcional)</span></label>
                        <input type="text" class="form-control" id="slug" :value="link.slug" @input="itemsSave.slug = $event.target.value">
                    </div>
                    
                    <button type="button" class="btn btn-danger me-2">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Alterar link</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    import sideNav from './layout/SideNavHome.vue'
    import axios from 'axios'

    export default {
        data() {
            return {
                links: [],
                id: this.$route.params.id,
                itemsSave: {
                    url: '',
                    title: '',
                    slug: '',
                    status: 1
                }
                
            }
        },
        mounted() {
            this.getLinksById()
        },
        methods: {
            getLinksById() {

                axios.get(`http://localhost:8000/api/link/${this.id}`, {
                    headers: {
                    'Accept': 'application/json',
                    },
                })
                    .then(response => {
                        this.links = response.data
                    })
                    .catch(error => {
                        console.error(error)
                    });
            },
            updateLink() {
                axios.put(`http://localhost:8000/api/links/${this.id}`, this.itemsSave)
                    .then(response => {
                        console.log('Link atualizado com sucesso:', response.data);
                        this.$router.push('/');
                    })
                    .catch(error => {
                        console.error('Erro ao atualizar o link:', error.response.data.error);
                    });
            },
        }
    }
</script>

<style lang="scss" scoped>
 
</style>