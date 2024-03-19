# Payments

## Sobre

- Projeto simples para testar e aplicar conhecimentos de docker, de fila e Teste;
- O projeto teve sua sintaxe testada usando a ferramenta phpmd, tendo como unico apontamento a regra de StaticAccess, devido a utilização de Facades do Framework;
- Para valores monetarios, eles são armazenados em BIGINT, sendo transformados em centavos no momento de calculo das operações para evitar problemas relacionados a utilização de valores flutuantes;

## Stack

- PHP 8.3
- Laravel 11
- mariadb 10
- rabbit 3

## Testando o projeto

1. docker-compose up --build -d

## Possíveis melhorias para o projeto

- Criação de registro para os eventos que alteram o balanço da conta: depósito, transaferencia, saque. Para permitir que seja possivel validar erros na operação, ou desfazer uma operação errada;
- Criação de processo diario para validar o balanço das contas para garantir que elas estejam feitas corretamente.

## Organização do projeto

