# Documentação do Sistema Encurtador de Links

Esta documentação descreve o sistema encurtador de links, que é composto por um front-end desenvolvido em Vue.js e um back-end desenvolvido em Laravel. O sistema permite aos usuários encurtar URLs longas e acompanhar o número de acessos aos links encurtados.

## Front-end (Vue.js)

O front-end do sistema foi desenvolvido utilizando o framework Vue.js. Ele fornece uma interface de usuário interativa para encurtar links e gerenciar as URLs encurtadas.

### Estrutura de Arquivos

- **src/**
  - **assets/**: Contém os recursos estáticos, como imagens e arquivos de estilo.
  - **views/**: Contém os arquivos das views do sistema.
  - **routes/index.php**: Arquivo de configuração das rotas do front-end.
  - **App.vue**: Arquivo principal do aplicativo Vue.js.
  - **main.js**: Arquivo de entrada que inicializa o aplicativo Vue.js e configura as dependências.

### Dependências

- **Vue.js**: Framework JavaScript para construção de interfaces de usuário.
- **Bootstrap**: Biblioteca de CSS que oferece componentes e estilos pré-definidos.
- **Axios**: Biblioteca para realizar requisições HTTP.
- **Vue Router**: Biblioteca para gerenciamento de rotas no Vue.js.

### Back-end (Laravel)

O back-end do sistema foi desenvolvido utilizando o framework Laravel. Ele fornece uma API para criação, recuperação, edição e exclusão de links encurtados.

### Estrutura de Arquivos

- **app/Console/Commands/ResetLinkAccess.php**: Arquivo de onde é configurado a cron para reset do número de acessos.
- **app/Http/Controllers/api/LinksController.php**: Arquivo Controller responsável por coordenar as ações do back-end, como processamento de dados, manipulação de modelos e retorno de respostas para o cliente.
- **app/Models/Links.php**: Arquivo onde está contido a estrutura de dados e a lógica de negócios da aplicação.
- **database/migrations**: Arquivos responsáveil pelo versionamento da estrutura do banco de dados.
- **routes/api.php**: Arquivo onde contém todas as rotas da aplicação.

### Banco de Dados

O sistema utiliza o banco de dados (linkshortener) MySQL para armazenar os links encurtados. A conexão com o banco de dados é configurada no arquivo ".env" do Laravel.

### Cron para Zerar Número de Acessos

O sistema possui uma tarefa cron programada para ser executada todo primeiro dia do mês. Essa tarefa zera o número de acessos de todos os links encurtados armazenados no banco de dados.

## Instruções de Instalação e Execução

### Front-end (Vue.js)

1. Certifique-se de ter o Node.js e o npm instalados em seu sistema.

2. Navegue até o diretório do front-end.

3. Instale as dependências do projeto executando o comando: npm install

4. Inicie o servidor de desenvolvimento executando o comando: npm run dev

### Back-end (Laravel)

1. Certifique-se de ter o PHP e o Composer instalados em seu sistema.

2. Navegue até o diretório do back-end.

3. Instale as dependências do projeto executando o comando: composer install

4. Configure a conexão com o banco de dados no arquivo ".env".

5. Gere a chave de aplicação executando o comando: php artisan key:generate

6. Execute as migrações do banco de dados para criar a tabela necessária executando o comando: php artisan migrate

7. Inicie o servidor PHP embutido executando o comando: php artisan serve --port=8000

## Requisitos

- **PHP**: ^8.0.2
- **axios**: ^1.4.0
- **bootstrap**: ^5.2.3
- **vue**: ^3.3.2
- **vue-router**: ^4.2.1
