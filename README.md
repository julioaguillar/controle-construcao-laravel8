<p align="center">
    <img src="https://laravel.com/img/logomark.min.svg" alt="Laravel" width="50" height="52">
    <img src="https://laravel.com/img/logotype.min.svg" alt="Laravel" width="114" height="29">
</p>

<p align="center">
# Sistema Web desenvolvido em Laravel 8 utilizando banco de dados SQLite
</p>

### Desenvolvido para aplicar os conceitos teóricos adquiridos em cursos de desenvolvimento web com Laravel
##### Sistema Web para controle de gastos em uma construção

## INFORMAÇÕES DO SISTEMA

### Sistema Web utilizado para controle de gastos em uma obra da construção civil

### O sistema possui um painel de controle onde é possível visualizar os principais dados da obra, o gasto real, gasto previsto, andamento da obra e a previsão de término. E também possui as seguintes funções:

### CADASTROS
##### * Obra
##### * Produtos/Mercadorias
##### * Serviços
##### * Fornecedores
##### * Prestadores de Serviço

### LANÇAMENTOS
##### * Compra de Produtos/Mercadorias
##### * Serviços Tomados

### RELATÓRIOS
##### * Compras de Produtos/Mercadorias (Em desenvolvimento)
##### * Serviços Tomados

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

## INSTALAÇÃO DO SISTEMA LOCAL

```sh
git clone https://github.com/julioaguillar/controle-construcao-laravel8.git
```

```sh
php artisan migrate
```

```sh
php artisan db:seed
```
```sh
php artisan serve
```

Acessar no broser: http://127.0.0.1:8000/


## E-MAIL E SENHA PADRÃO

* E-MAIL: adm@aonsistemas.com.br
* SENHA: adm
