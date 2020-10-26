# Desafio Back-end

## Proposta

Temos 2 tipos de usuários, os comuns e lojistas, ambos têm carteira com dinheiro e realizam transferências entre eles. Vamos nos atentar somente ao fluxo de transferência entre dois usuários.

Requisitos:

- Para ambos tipos de usuário, precisamos do Nome Completo, CPF, e-mail e Senha. CPF/CNPJ e e-mails devem ser únicos no sistema. Sendo assim, seu sistema deve permitir apenas um cadastro com o mesmo CPF ou endereço de e-mail.

- Usuários podem enviar dinheiro (efetuar transferência) para lojistas e entre usuários. 

- Lojistas **só recebem** transferências, não enviam dinheiro para ninguém.

- Antes de finalizar a transferência, deve-se consultar um serviço autorizador externo, use este mock para simular (https://run.mocky.io/v3/8fafdd68-a090-496f-8c9a-3442cf30dae6).

- A operação de transferência deve ser uma transação (ou seja, revertida em qualquer caso de inconsistência) e o dinheiro deve voltar para a carteira do usuário que envia. 

- No recebimento de pagamento, o usuário ou lojista precisa receber notificação enviada por um serviço de terceiro e eventualmente este serviço pode estar indisponível/instável. Use este mock para simular o envio (https://run.mocky.io/v3/b19f7b9f-9cbf-4fc6-ad22-dc30601aec04). 

- Este serviço deve ser RESTFul.

## Dependências

- Docker

## Instalação e Configuração
- Clone ou faça o download deste repositório
- Execute `cp .env.example .env` no Mac/Unix ou `COPY .env.example .env` no Windows
- Execute `docker-compose up -d` para buildar e criar os containers
- Execute `docker exec -it app composer install` para instalar todas as dependências
- Execute `docker exec -it app php artisan migrate` para criar as tabelas
- Finalmente execute `docker exec -it app php artisan db:seed` para popular as tabelas
- Se tudo funcionou corretamente, você pode navegar para `http://localhost:8000` 🚀

### Material complementar
A documentação dos endpoints pode ser utilizada via Postman através do URL https://documenter.getpostman.com/view/4703011/TVYF8eH5

### Importante
Sempre fique atento que não exista outro processo rodando nas portas 8000, 9000 e 3306, pois, serão as portas utilizadas ao executar o docker

### Testes
Para rodar os testes, após os containers estarem rodando, execute no seu terminal: vendor/bin/phpunit
