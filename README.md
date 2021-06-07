# Test Doubles

Código com exemplos do post "Teste Doubles" acessível em:

https://dev.to/thalimarra/testes-de-software-test-doubles-56af

## Docker
O docker-compose aqui presente já contempla o necessário para instalar as bibliotecas necessárias e executar os 
testes. Estão presentes as seguintes imagens:
- Composer 2.0: gerencia as dependências do projeto
- PHPUnit: imagem do PHP 7.4 com a chamada da biblioteca de testes

### Instalar dependências
1. Baixar o repositório e acessar a pasta
2. Executar o comando: `docker-compose run composer install`

### Executando os testes
```
docker-compose run phpunit
```
- Executar um único teste: `phpunit --filter nome_da_funcao`

### Remover projeto
```
docker-compose down
```
