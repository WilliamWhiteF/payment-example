# Payments

## Sobre

- Projeto simples para testar e aplicar conhecimentos de docker, de fila e Teste;
- O projeto teve sua sintaxe testada usando a ferramenta phpmd, tendo como unico apontamento a regra de StaticAccess, devido a utilização de Facades do Framework;
- Para valores monetarios, eles são armazenados em BIGINT, sendo transformados em centavos no momento de calculo das operações para evitar problemas relacionados a utilização de valores flutuantes;
- O projeto foi organizado em um dominio de pagamentos controlando a lógica de pagamento e ordenação disso, e um dominio compartilhado contendo o que é global ao projeto (como notificação, interfaces para multiplos dominios);
- Integrações com serviços de terceiros foram separadas via DI, para diminuir o acoplamento com o restante dos componentes.

## Stack

- PHP 8.3
- Laravel 11
- mariadb 10
- rabbit 3

## Testando o projeto

1. docker-compose up --build -d

## Para rodar os testes

1. docker-compose exec php php artisan test

## Possíveis melhorias para o projeto

- Criação de registro para os eventos que alteram o balanço da conta: depósito, transaferencia, saque. Para permitir que seja possivel validar erros na operação, ou desfazer uma operação errada;
- Criação de processo diario para validar o balanço das contas para garantir que elas estejam feitas corretamente;
- Finalizar implementação de autenticação.
