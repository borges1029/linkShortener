<template>
    <div class="container-fluid">
        <div class="row">
            <SideNav></SideNav>
        </div>

        <div class="container mt-6">
            <div class="row row-form" v-for="link in links" :key="link.id">
                
                <form @submit.prevent="updateLink">
                    <h2>Edit Link</h2>
                    <div class="mb-3 mt-3">
                        <label for="destino" class="form-label">URL</label>
                        <input type="text" class="form-control" id="url" placeholder="https://example.com/my-long-url" v-model="itemsSave.url">
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="titulo" class="form-label">Título <span>(Opcional)</span></label>
                        <input type="text" class="form-control" id="title" v-model="itemsSave.title">
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="slug" class="form-label">Slug personalizado <span>(Opcional)</span></label>
                        <input type="text" class="form-control" id="slug" v-model="itemsSave.slug">
                    </div>
                    
                    <a href="/" class="btn btn-danger me-2">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Alterar link</button>
                </form>
            </div>
        </div>

        <!-- Alerta -->
        <div class="alert alert-dismissible alert-controller" :class="statusAlert" v-if="showAlert">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            {{ descriptionAlert }}
        </div>
    </div>
</template>

<script>
    import SideNav from './layout/SideNavHome.vue'
    import axios from 'axios'

    export default {
        components: {
            SideNav
        },
        data() {
            return {
                links: [],
                id: this.$route.params.id,
                descriptionAlert: '',
                statusAlert: '',
                showAlert: false,
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
                        this.links.forEach(item => {
                            this.itemsSave.url = item.url;
                            this.itemsSave.title = item.title;
                            this.itemsSave.slug = item.slug;
                            this.itemsSave.status = item.status;
                        });
                    })
                    .catch(error => {
                        console.error(error)
                    });
            },
            updateLink() {
                axios.put(`http://localhost:8000/api/links/${this.id}`, this.itemsSave)
                    .then(response => {
                        this.descriptionAlert = 'Link encurtado com sucesso.'
                        this.statusAlert = 'alert-success'
                        this.showAlert = true
                        console.log('Link atualizado com sucesso:', response.data);
                        this.getLinksById()
                    })
                    .catch(error => {
                        this.descriptionAlert = error.response.data.error
                        this.statusAlert = 'alert-danger'
                        this.showAlert = true
                        console.error('Erro ao atualizar o link:', error.response.data.error);
                    });
            },
        }
    }
</script>

<style lang="scss" scoped>
 
</style>