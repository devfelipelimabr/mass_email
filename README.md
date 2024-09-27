# Mass Email Sender

Este é um projeto PHP de envio em massa de e-mails para empresas, com integração ao servidor SMTP da Hostinger e o uso da biblioteca PHPMailer. Ele permite o envio de e-mails personalizados, extraindo dados como nome e e-mail do banco de dados MySQL e enviando-os com o conteúdo formatado em HTML. Além disso, oferece um mecanismo de desinscrição, permitindo que os destinatários possam optar por não receber mais e-mails, realizando um "soft delete" no banco de dados.

## Funcionalidades

- Envio em massa de e-mails utilizando PHPMailer.
- Personalização do conteúdo do e-mail, incluindo nome da empresa e link de chamada para ação.
- Link de desinscrição dinâmico que permite que as empresas parem de receber e-mails.
- Soft delete de empresas desinscritas (marca a empresa como excluída sem removê-la do banco de dados).
- Template de e-mail em HTML com suporte para caracteres especiais (UTF-8).
- Utilização de variáveis sensíveis, como credenciais SMTP, armazenadas em um arquivo `.env` para segurança.
- Interface simples para visualizar o processo de envio.

## Tecnologias Utilizadas

- **PHP**: Linguagem principal para backend.
- **PHPMailer**: Biblioteca utilizada para envio de e-mails via SMTP.
- **MySQL**: Banco de dados para armazenar informações de empresas e e-mails.
- **HTML/CSS**: Para formatação dos e-mails.
- **XAMPP** ou outro servidor PHP local para desenvolvimento.
- **Hostinger SMTP**: Servidor de e-mail utilizado para envio.

## Pré-requisitos

- PHP 7.4 ou superior
- Composer instalado
- MySQL ou MariaDB
- Servidor SMTP configurado (Hostinger)
- Extensão `php_openssl` habilitada no PHP

## Instalação

### 1. Clone o repositório

```bash
git clone https://github.com/devfelipelimabr/mass_email.git
cd mass-email-sender
```

### 2. Instale as dependências

Instale o PHPMailer via Composer:

```bash
composer install
```

### 3. Configuração do arquivo `.env`

Crie um arquivo `.env` na raiz do projeto e adicione suas credenciais SMTP:

```env
SMTP_HOST=smtp.dominio.com
SMTP_PORT=587
SMTP_USER=seuemail@dominio.com
SMTP_PASS=sua_senha
FROM_EMAIL=seuemail@dominio.com
FROM_NAME="Sua Empresa"
```

### 4. Configuração do Banco de Dados

Crie uma tabela no MySQL para armazenar as informações das empresas. Execute o seguinte comando SQL:

```sql
CREATE TABLE empresas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    data_envio TIMESTAMP NULL DEFAULT NULL,
    data_delecao TIMESTAMP NULL DEFAULT NULL
);
```

Insira os dados das empresas que você deseja enviar os e-mails:

```sql
INSERT INTO empresas (nome, email) VALUES ('Empresa Teste', 'contato@empresa.com');
```

### 5. Configuração do PHPMailer

No arquivo `send_emails.php`, o PHPMailer já está configurado para enviar e-mails usando as informações do arquivo `.env`. Verifique se você incluiu `$mail->CharSet = 'UTF-8';` para evitar erros de caracteres especiais.

### 6. Implementação do Soft Delete (Desinscrição)

A desinscrição e o soft delete ocorrem no endpoint que processa a solicitação de desinscrição, através do arquivo `unsubscribe.php`.

### 7. Adicione o Link de Desinscrição ao Template de E-mail

No arquivo `email_template.php`, inclua um link de desinscrição dinâmico para que os usuários possam parar de receber e-mails.

### 8. Executar o Script de Envio

Agora você pode rodar o script de envio de e-mails. Navegue até o diretório do projeto no terminal e execute:

```bash
php send_emails.php
```

Os e-mails serão enviados para todos os destinatários que estão na tabela `empresas`, exceto aqueles que já tenham a coluna `data_delecao` preenchida.

## Estrutura do Projeto

```bash
mass-email-sender/
│
├── .env.example             # Exemplo do arquivo .env
├── composer.json            # Dependências do Composer
├── email_template.php       # Template HTML do e-mail
├── index.php                # Frontend
├── send_emails.php          # Script principal para enviar e-mails
├── unsubscribe.php          # Endpoint de desinscrição
├── README.md                # Documentação do projeto
└── vendor/                  # Bibliotecas instaladas pelo Composer
```

## Customização do Template de E-mail

O template HTML do e-mail está no arquivo `email_template.php`. Você pode personalizá-lo para atender às suas necessidades. Atualmente, ele inclui uma saudação com o nome da empresa, uma breve descrição dos benefícios do **JáVai**, um botão de chamada para ação, e um link de desinscrição.

## Problemas Comuns

### 1. Problemas com Codificação de Caracteres

Se você encontrar problemas com caracteres especiais (acentos, cedilha), certifique-se de que:

- O arquivo `.env` está salvo com codificação UTF-8.
- O PHPMailer está configurado com `$mail->CharSet = 'UTF-8';`.
- O conteúdo HTML do e-mail inclui `<meta charset="UTF-8">`.

### 2. Erro de Conexão SMTP

Verifique se as credenciais de SMTP no arquivo `.env` estão corretas. Também confirme que a porta `587` está liberada e que você está utilizando a autenticação TLS.

## Contribuindo

Se você deseja contribuir para o projeto, fique à vontade para abrir um pull request ou relatar problemas na página de Issues.

## Licença

Este projeto está licenciado sob a Licença MIT - veja o arquivo [LICENSE](LICENSE) para mais detalhes.