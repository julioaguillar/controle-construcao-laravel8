<p align="center">
    <img src="https://laravel.com/img/logomark.min.svg" alt="Laravel" width="50" height="52">
    <img src="https://laravel.com/img/logotype.min.svg" alt="Laravel" width="114" height="29">
</p>

# Sistema Web desenvolvido em Laravel 8 utilizando banco de dados SQLite

### Desenvolvido para aplicar os conceitos teóricos adquiridos em cursos de desenvolvimento web com Laravel

## INFORMAÇÕES DO SISTEMA

Sistema Web utilizado para controle de gastos em uma obra da construção civil

O sistema possui um painel de controle onde é possível visualizar os principais dados da obra, o gasto real, gasto previsto, andamento da obra e a previsão de término. E também possui as seguintes funções:

##### CADASTROS
- Obra
- Produtos/Mercadorias
- Serviços
- Fornecedores
- Prestadores de Serviço

##### LANÇAMENTOS
- Compra de Produtos/Mercadorias
- Serviços Tomados

##### RELATÓRIOS
- Compras de Produtos/Mercadorias (Em desenvolvimento)
- Serviços Tomados

## LINGUAGENS E TECNOLOGIAS UTILIZADAS

* PHP 8
* HTML 5
* JavaScript
* CSS
* Bootstrap 5.1.3
* Laravel 8
* Banco de Dados SQLite
* Composer
* IDE VSCode
* Padrão MVC

## INSTALAÇÃO DO SISTEMA NA MÁQUINA LOCAL

##### Antes de iniciar é necessário instalar o composer
```sh
https://getcomposer.org
```


##### Obter os fontes via Git
```sh
git clone https://github.com/julioaguillar/controle-construcao-laravel8.git
```
ou fazer download dos fontes para a máquina local
```sh
https://github.com/julioaguillar/controle-construcao-laravel8
```
Após baixar os fontes executar o terminal de comando, acessar a pasta raiz do projeto e executar os comandos abaixo


##### 
```sh
composer update
```


##### Renomear o arquivo .env.example para .env
Linux
```sh
mv .env.example .env
```
Windows
```sh
ren .env.example .env
```


##### Gerar a chave do aplicativo
```sh
php artisan key:generate
```


##### Criar as Tabelas no banco de Dados
```sh
php artisan migrate
```


##### Popula as tabelas do Banco de Dados
```sh
php artisan db:seed
```


##### Inicia o servidor embutido do PHP usado pelo Laravel
```sh
php artisan serve
```


##### Acessar no browser
```sh
http://127.0.0.1:8000
```


## E-MAIL E SENHA PADRÃO

* E-MAIL: adm@aonsistemas.com.br
* SENHA: adm
