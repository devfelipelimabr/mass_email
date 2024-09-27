# Mass Email Sender

Este é um projeto PHP de envio em massa de e-mails para empresas, com integração ao servidor SMTP da Hostinger e o uso da biblioteca PHPMailer. Ele permite o envio de e-mails personalizados, extraindo dados como nome e e-mail do banco de dados MySQL e enviando-os com o conteúdo formatado em HTML. Além disso, oferece um mecanismo de desinscrição, permitindo que os destinatários possam optar por não receber mais e-mails, realizando um "soft delete" no banco de dados. O sistema agora inclui um sistema de login baseado em variáveis de ambiente para maior segurança.

## Funcionalidades

- Envio em massa de e-mails utilizando PHPMailer.
- Personalização do conteúdo do e-mail, incluindo nome da empresa e link de chamada para ação.
- Link de desinscrição dinâmico que permite que as empresas parem de receber e-mails.
- Soft delete de empresas desinscritas (marca a empresa como excluída sem removê-la do banco de dados).
- Template de e-mail em HTML com suporte para caracteres especiais (UTF-8).
- Utilização de variáveis sensíveis, como credenciais SMTP e de login, armazenadas em um arquivo `.env` para segurança.
- Interface simples para visualizar o processo de envio.
- Sistema de login baseado em variáveis de ambiente para controle de acesso.

## Tecnologias Utilizadas

- **PHP**: Linguagem principal para backend.
- **PHPMailer**: Biblioteca utilizada para envio de e-mails via SMTP.
- **MySQL**: Banco de dados para armazenar informações de empresas e e-mails.
- **HTML/CSS**: Para formatação dos e-mails e interface de login.
- **XAMPP** ou outro servidor PHP local para desenvolvimento.
- **Hostinger SMTP**: Servidor de e-mail utilizado para envio.
- **phpdotenv**: Para carregar variáveis de ambiente do arquivo `.env`.

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

Instale o PHPMailer e phpdotenv via Composer:

```bash
composer require phpmailer/phpmailer vlucas/phpdotenv
```

### 3. Configuração do arquivo `.env`

Crie um arquivo `.env` na raiz do projeto e adicione suas credenciais SMTP e de login:

```env
SMTP_HOST=smtp.dominio.com
SMTP_PORT=465
SMTP_USER=seuemail@dominio.com
SMTP_PASS=sua_senha
FROM_EMAIL=seuemail@dominio.com
FROM_NAME="Sua Empresa"
ADMIN_USERNAME=seu_usuario_admin
ADMIN_PASSWORD=sua_senha_admin
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

### 5. Configuração do Sistema de Login

O sistema de login já está configurado para usar as credenciais do arquivo `.env`. Não é necessário criar uma tabela de usuários no banco de dados.

### 6. Implementação do Soft Delete (Desinscrição)

A desinscrição e o soft delete ocorrem no endpoint que processa a solicitação de desinscrição, através do arquivo `unsubscribe.php`.

### 7. Adicione o Link de Desinscrição ao Template de E-mail

No arquivo `email_template.php`, inclua um link de desinscrição dinâmico para que os usuários possam parar de receber e-mails.

### 8. Executar o Sistema

Agora você pode rodar o sistema. Navegue até o diretório do projeto no seu servidor web local ou remoto.

## Estrutura do Projeto

```bash
mass-email-sender/
│
├── .env.example             # Exemplo do arquivo .env
├── composer.json            # Dependências do Composer
├── config.php               # Configurações gerais e inicialização da sessão
├── email_template.php       # Template HTML do e-mail
├── index.php                # Página principal (requer login)
├── login.php                # Página de login
├── logout.php               # Script de logout
├── send_emails.php          # Script principal para enviar e-mails
├── unsubscribe.php          # Endpoint de desinscrição
├── README.md                # Documentação do projeto
└── vendor/                  # Bibliotecas instaladas pelo Composer
```

## Customização do Template de E-mail

O template HTML do e-mail está no arquivo `email_template.php`. Você pode personalizá-lo para atender às suas necessidades. Atualmente, ele inclui uma saudação com o nome da empresa, uma breve descrição dos benefícios do **JáVai**, um botão de chamada para ação, e um link de desinscrição.

## Sistema de Login

O sistema de login utiliza credenciais armazenadas no arquivo `.env`. Para acessar o sistema:

1. Acesse a página de login (`login.php`).
2. Digite o nome de usuário e senha definidos no arquivo `.env`.
3. Após o login bem-sucedido, você será redirecionado para a página principal (`index.php`).

## Problemas Comuns

### 1. Problemas com Codificação de Caracteres

Se você encontrar problemas com caracteres especiais (acentos, cedilha), certifique-se de que:

- O arquivo `.env` está salvo com codificação UTF-8.
- O PHPMailer está configurado com `$mail->CharSet = 'UTF-8';`.
- O conteúdo HTML do e-mail inclui `<meta charset="UTF-8">`.

### 2. Erro de Conexão SMTP

Verifique se as credenciais de SMTP no arquivo `.env` estão corretas. Também confirme que a porta `587` está liberada e que você está utilizando a autenticação TLS.

### 3. Problemas de Login

Se você não conseguir fazer login, verifique se as credenciais no arquivo `.env` estão corretas e se o arquivo está sendo carregado corretamente.

## Segurança

- Mantenha o arquivo `.env` seguro e nunca o compartilhe ou adicione ao controle de versão.
- Considere implementar proteção contra ataques de força bruta no sistema de login.
- Use HTTPS para todas as comunicações, especialmente na página de login.

## Contribuindo

Se você deseja contribuir para o projeto, fique à vontade para abrir um pull request ou relatar problemas na página de Issues.

## Licença

Este projeto está licenciado sob a Licença MIT - veja o arquivo [LICENSE](LICENSE) para mais detalhes.