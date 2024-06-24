# pa-desafio-back-end

## CMS (Content Management System)

Uma aplicação simples de gerenciamento de posts

## Live preview do projeto

https://soffia.victormgomes.net/

## Instruções de execução

#### Importe a collection e documentação da API no postman ou outro cliente de sua preferência

arquivo na raiz do projeto "pa-desafio-back-end.json"
obs: alterar a variável base_url de acordo com o endereço live preview ou local

## Como executar o projeto de forma local

### Requisitos

#### Docker e Docker Composer

Este projeto é executado via containers: https://docs.docker.com/
Obs: Mas também pode ser utilizado sem dockerização, sendo necessária a instalação manual da stack LAMP.
Verificar o composer.json.

#### Recomendado o uso de Linux ou WSL

Para as instruções de comando, outras plataformas talvez necessitem de adaptações.

#### Laravel Sail

Este projeto é executado utilizando Laravel Sail: https://laravel.com/docs/11.x/sail

### Instruções

#### Clone o repositório e abra o projeto, preferencialmente com o VSCODE.

#### Copie o arquivo .env.example e renomei para .env e altere as variais que deseja

`cp .env.example .env`

#### Instale os pacotes

por meio da task "Install Composer Packages" configurada para o vscode

#### ou executando o script "install_composer_packages.sh"

`/.docker/scripts/install_composer_packages.sh`

#### Se deseja crie o alias do sail por meio da task "Create Sail Alias"

alias de
`./vendor/bin/sail`
para
`s`

#### Execute o projeto

`s up -d`

#### Gere a chave da aplicação

`s artisan key:generate`

#### Execute as migrations

`s artisan migrate`

#### Execute as seeds

`s artisan db:seed`

## Deploy

#### este projeto têm Worflow de deploy automatico da branch main via GitHub Actions

Edite o arquivo ".github/workflows/deploy.yml" conforme sua necessidade.
