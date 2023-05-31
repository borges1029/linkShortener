<template>
    <div class="container-fluid">
        <div class="row">
            <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
                <div class="container">
                    <a class="navbar-brand" href="/">
                        LinkShortener
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                        <ul class="navbar-nav"></ul>
                        <form class="d-flex" onsubmit="return false;">
                            <div class="input-group">
                                <span class="input-group-text rad-l-25"><i class="fas fa-search"></i></span>
                                <input class="form-control rad-r-25" type="search" placeholder="Pesquisar" aria-label="Search" v-model="termoBusca" @input="realizarBusca">
                            </div>
                        </form>
                        <div class="dropdown">
                            <a class="dropdown" type="button" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="https://icostantini.com.br/admnew/img/user.jpg" alt="Avatar Logo" style="width:40px;" class="rounded-pill me-2">
                                <i class="fas fa-angle-down text-dark"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUser">
                                <li><a class="dropdown-item" href="#">Configuração</a></li>
                                <li><a class="dropdown-item" href="#">Sair</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        
        <div class="container mt-6">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-auto icon-card">
                                    <i class="fas fa-link"></i>
                                </div>
                                <div class="col content-card">
                                    <h2 class="card-title">{{ totalItems }}</h2>
                                    <p class="card-text">Links</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-auto icon-card">
                                    <i class="fas fa-eye"></i>
                                </div>
                                <div class="col content-card">
                                    <h2 class="card-title">{{ totalViews }}</h2>
                                    <p class="card-text">Visualizações</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-auto icon-card">
                                    <i class="fas fa-check"></i>
                                </div>
                                <div class="col content-card">
                                    <h2 class="card-title">{{countStatus(1)}}</h2>
                                    <p class="card-text">Ativos</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-auto icon-card">
                                    <i class="fas fa-xmark"></i>
                                </div>
                                <div class="col content-card">
                                    <h2 class="card-title">{{countStatus(0)}}</h2>
                                    <p class="card-text">Inativos</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mt-5">
            <div class="row">
                <div class="col-12">
                    <div class="shortener">
                        <button class="btn rad-25" data-bs-toggle="modal" data-bs-target="#modalLinkShortener">
                            <i class="fas fa-plus"></i>
                            Encurtar link
                        </button>
                    </div>
                    <div class="dropdown filters">
                        <button type="button" class="btn dropdown" data-bs-toggle="dropdown">
                            <i class="fas fa-sort"></i>
                            Ordenar
                        </button>
                        <ul class="dropdown-menu">
                            <li><button class="dropdown-item" @click="sortByField('title', 'asc')">Título crescente</button></li>
                            <li><button class="dropdown-item" @click="sortByField('title', 'desc')">Título decrescente</button></li>
                            <li><button class="dropdown-item" @click="sortByField('views', 'desc')">Mais views</button></li>
                            <li><button class="dropdown-item" @click="sortByField('views', 'asc')">Menos views</button></li>
                        </ul>
                    </div>
                </div>

                <div class="col-12 mt-3">

                    <div class="card links-shortener" v-for="item in resultadosBusca" :key="item.id">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title">{{ item.title }}</h5>
                                    <p class="card-text"><a href="#" @click="retrieveLink(item.slug)">{{ urlBase + item.slug }}</a></p>
                                </div>
                                <div class="col-auto button-card">
                                    <span class="me-4">{{ item.clicks }} <i class="fas fa-chart-column"></i></span>
                                    <a :href="'/edit/link/' + item.id" class="me-2"><i class="fas fa-edit"></i></a>
                                    <button class="btn" @click="deleteLink(item.id)"><i class="fas fa-trash"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        
        <!-- Alerta -->
        <div class="alert alert-dismissible alert-controller" :class="statusAlert" v-if="showAlert">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            {{ descriptionAlert }}
        </div>

        <!-- Modal Gerar Link-->
        <div class="modal" id="modalLinkShortener">
            <div class="modal-dialog">
                <div class="modal-content">
                    

                    <div class="modal-header">
                        <h4 class="modal-title">Encurtar novo link</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <form id="newLink" @submit.prevent="gerarLink">
                            <div class="mb-3 mt-3">
                                <label for="destino" class="form-label">URL</label>
                                <input type="text" class="form-control" id="url_destino" placeholder="https://example.com/my-long-url" v-model="url_destino">
                            </div>
                            <div class="mb-3 mt-3">
                                <label for="titulo" class="form-label">Título <span>(Opcional)</span></label>
                                <input type="text" class="form-control" id="titulo" v-model="titulo">
                            </div>
                            <div class="mb-3 mt-3">
                                <label for="slug" class="form-label">Slug personalizado <span>(Opcional)</span></label>
                                <input type="text" class="form-control" id="slug" v-model="slug">
                            </div>

                            
                        </form>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary" form="newLink">Gerar link</button>
                    </div>

                </div>
            </div>
        </div>


    </div>
</template>

<script>
    import axios from 'axios'

    export default {
        data() {
            return {
                termoBusca: '',
                urlBase: 'http://localhost:5173/',
                url_destino: '',
                titulo: '',
                slug: '',
                descriptionAlert: '',
                statusAlert: '',
                showAlert: false,
                items: [],
                resultadosBusca: [],
                sortAscending: true
            }
        },
        mounted() {
            this.getLinks()
        },
        computed: {
            totalItems() {
                return this.termoBusca == '' ? this.items.length : this.resultadosBusca.length
            },
            totalViews() {
                return this.termoBusca == '' ? this.items.reduce((total, item) => total + item.clicks, 0) : this.resultadosBusca.reduce((total, item) => total + item.clicks, 0)
            },
            resultadosBusca() {
                return this.items.filter(item => {
                    return item.title.toLowerCase().includes(this.termoBusca.toLowerCase())
                })
            }
        },
        methods: {
            getLinks() {
                axios.get('http://localhost:8000/api/links', {
                    headers: {
                    'Accept': 'application/json',
                    },
                })
                    .then(response => {
                        this.items = response.data
                    })
                    .catch(error => {
                        console.error(error)
                    });
            },
            gerarLink() {
                axios.post('http://localhost:8000/api/links', {
                    url: this.url_destino,
                    title: this.titulo,
                    slug: this.slug,
                })
                    .then(response => {
                        this.getLinks()
                        this.descriptionAlert = 'Link encurtado com sucesso.'
                        this.statusAlert = 'alert-success'
                        this.showAlert = true
                        console.log(response.data)
                    })
                    .catch(error => {
                        this.descriptionAlert = error.response.data.error
                        this.statusAlert = 'alert-danger'
                        this.showAlert = true
                        console.error(error.response.data.error)
                    })
            },
            deleteLink(id) {
                axios.delete(`http://localhost:8000/api/links/${id}`)
                    .then(response => {
                        this.getLinks()
                        this.descriptionAlert = 'Link deletado com sucesso.'
                        this.statusAlert = 'alert-success'
                        this.showAlert = true
                        console.log(response.data)
                    })
                    .catch(error => {
                        this.descriptionAlert = error.response.data.error
                        this.statusAlert = 'alert-danger'
                        this.showAlert = true
                        console.error(error.response.data.error)
                    });
            },
            retrieveLink(slug) {
                axios.get(`http://localhost:8000/api/links/${slug}`)
                    .then(response => {
                        this.getLinks()
                        window.open(this.urlBase+slug, '_blank');
                    })
                    .catch(error => {
                        console.error(error.response.data.error)
                    });
            },
            countStatus(status) {
                return this.termoBusca == '' ? this.items.filter(item => item.status === status).length : this.resultadosBusca.filter(item => item.status === status).length
            },
            realizarBusca() {
                this.resultadosBusca = this.items.filter(item => {
                    return item.title.toLowerCase().includes(this.termoBusca.toLowerCase())
                })
            },
            sortByField(field, order) {
                this.items.sort((a, b) => {
                    const valueA = a[field].toString().toUpperCase()
                    const valueB = b[field].toString().toUpperCase()
                    
                    if (valueA < valueB) {
                        return order === 'asc' ? -1 : 1
                    }
                    if (valueA > valueB) {
                        return order === 'asc' ? 1 : -1
                    }
                    
                    return 0
                })
            },
        }

    }
</script>