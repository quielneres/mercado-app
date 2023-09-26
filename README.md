# Mercado-App

O projeto foi dividido com o backend no diretório `api` e o frontend no diretório `Angular`.

## Especificações

- PHP 7.4
- Node.js 14+

## Configuração

### Backend

1. Edite as credenciais do banco de dados no arquivo `api/config.php`.
2. Execute o arquivo `dump.sql` para configurar o banco de dados.
    - Se ocorrerem problemas com o `dump.sql`, você pode executar o seguinte comando para executar as migrações:

      ```shell
      php api/vendor/bin/phinx migrate -c config-phinx.php
      ```

### Servir a Aplicação

#### Backend

Para servir a API, siga os passos abaixo:

1. Execute o seguinte comando no diretório raiz do backend:

   ```shell
   php -S localhost:8000
    ```
#### Frontend

Para subir o frontend, siga os passos abaixo:

1. Navegue até o diretório `angular`.

2. Execute o seguinte comando para iniciar o servidor local (certifique-se de tê-lo instalado):  

      ```shell
   http-server
    ```
Caso o `http-server` não esteja instalado, você pode instalá-lo executando o seguinte comando:

  ```shell
         npm install -g http-server
   ```
Isso deve permitir que você sirva a aplicação tanto no frontend quanto no backend. Certifique-se de ter todas as dependências necessárias instaladas, como PHP, Node.js e as bibliotecas específicas do projeto.