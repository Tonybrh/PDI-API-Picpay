<p align="center">
  <a href="https://git.io/typing-svg">
<a href="https://git.io/typing-svg"><img src="https://readme-typing-svg.herokuapp.com?font=DynaPuff&size=42&duration=3000&pause=1000&color=449EF5&width=210&height=70&lines=Picpay+api" alt="Typing SVG" /></a>  </a>
</p>


## Descrição
> ### Projeto feito em symfony para aprimorar os conhecimentos e crescer individualmente, o projeto consiste em uma api que simula um sistema de pagamento, onde é possível realizar transações, consultar saldo, consultar transações e realizar transferências entre usuários.
![img.png](img.png)
## Tecnologias
> [![PHP](https://img.shields.io/badge/php-%23777BB4.svg?&logo=php&logoColor=white)](#)
[![Symfony](https://img.shields.io/badge/Symfony-black?logo=symfony)](#)
[![Docker](https://img.shields.io/badge/Docker-2496ED?logo=docker&logoColor=fff)](#)
[![Postgres](https://img.shields.io/badge/Postgres-%23316192.svg?logo=postgresql&logoColor=white)](#)
[![Composer](https://img.shields.io/badge/Composer-885630?logo=composer&logoColor=fff)](#)
[![PHPUnit](https://img.shields.io/badge/PHPUnit-485DD0?logo=phpunit&logoColor=fff)](#)
[![Swagger](https://img.shields.io/badge/Swagger-%2385EA2D.svg?logo=swagger&logoColor=black)](#)
[![RabbitMQ](https://img.shields.io/badge/RabbitMQ-%23FF6600.svg?logo=rabbitmq&logoColor=black)](#)
[![Vuejs](https://img.shields.io/badge/-Vue.js-4fc08d?style=flat&logo=vuedotjs&logoColor=white)](#)
[![JWT](https://img.shields.io/badge/JWT-%23000000.svg?logo=json-web-tokens&logoColor=white)](#)
[![HTML](https://img.shields.io/badge/HTML-%23E34F26.svg?logo=html5&logoColor=white)](#)
[![CSS](https://img.shields.io/badge/CSS-%231572B6.svg?logo=css3&logoColor=white)](#)
[![JavaScript](https://img.shields.io/badge/JavaScript-%23F7DF1E.svg?logo=javascript&logoColor=black)](#)

## Explicando o projeto
### Aplicado um ddd (Domain Driven design) simples, tendo como domínios principais o Usuário, a Transação, Adaptadores e um Domínio a ser compartilhado com outras partes da aplicação.

```yml
├── Adapter
│   └── Http
│       ├── System
│       └── ViewsActions
├── Kernel.php
├── Shared
│   ├── Application
│   │   └── EventListener
│   ├── Handler
│   │   └── SendTransactionSuccessEmailHandler.php
│   └── Message
│       └── SendTransactionSuccessEmail.php
├── Transaction
│   ├── Application
│   │   ├── Api # Camada de actions
│   │   ├── Helper
│   │   └── Service
│   ├── Domain
│   │   ├── Builder # Abstração do Builder
│   │   ├── Entity
│   │   ├── Exception
│   │   ├── Repository # Abstração do Repository
│   │   └── ValueObject
│   └── Infrastructure
│       ├── Builder # Implementação do Builder
│       └── Repository # Implementação do Repository
└── User
    ├── Application
    │   ├── Api # Camada de actions
    │   └── Service
    ├── Domain
    │   ├── Builder # Abstração do Builder
    │   ├── Entity
    │   ├── Enum
    │   ├── Exception
    │   ├── Repository # Abstração do Repository
    │   └── ValueObject
    └── Infrastructure
        ├── Builder # Implementação do Builder
        └── Repository # Implementação do Repository
```
### O projeto segue os conceitos do S.O.L.I.D, aplicando o princípio da responsabilidade única, aberto/fechado, substituição de liskov, segregação de interface e inversão de dependência.

## Status do projeto
> ### Finalizado, adicionando novas features.

# Endpoints
> ## Para criar um novo usuário
> >### ```/api/user/post```
> ## Para atualizar a carteira de um usuário
> > ### ```/api/user/update-wallet```
> ## Para listar os usuários cadastrados
> > ### ```/api/users/get```
> ## Para realizar uma transação
> > ### ```/api/transaction/send```
> ## Para se logar na aplicação
> > ### ```/api/login_check```

## Algumas regras da api...

- ### Usuários não logados tem acesso apenas ao endpoint de login e de registro.
- ### Usuários sem saldo suficiente não podem realizar transações.
- ### Usuários lojistas não fazem transferências, apenas usuários comuns.

## Contato
> ### [![Linkedin](https://img.shields.io/badge/Linkedin-%230077B5.svg?logo=linkedin&logoColor=white)](https://www.linkedin.com/in/dias-antonio/) [![Instagram](https://img.shields.io/badge/Instagram-%23E4405F.svg?logo=instagram&logoColor=white)](https://www.instagram.com/noneeeduardo) [![Gmaill](https://img.shields.io/badge/Gmail-D14836?logo=gmail&logoColor=white)](mailto:antoniodias1106@gmail.com)


