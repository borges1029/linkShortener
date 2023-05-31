<template>
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
  </template>

<style scoped>

</style>