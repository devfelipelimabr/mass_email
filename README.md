Aqui está um exemplo de um arquivo `README.md` para o seu projeto de envio de e-mails em massa via PHP utilizando PHPMailer e configuração com Hostinger:

```md
# Mass Email Sender

Este é um projeto PHP de envio em massa de e-mails para empresas, com integração ao servidor SMTP da Hostinger e o uso da biblioteca PHPMailer. Ele permite o envio de e-mails personalizados, extraindo dados como nome e e-mail do banco de dados MySQL e enviando-os com o conteúdo formatado em HTML.

## Funcionalidades

- Envio em massa de e-mails utilizando PHPMailer.
- Personalização do conteúdo do e-mail, incluindo nome da empresa e link de chamada para ação.
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
git clone https://github.com/seu-usuario/mass-email-sender.git
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
SMTP_HOST=smtp.hostinger.com
SMTP_PORT=587
SMTP_USER=seuemail@dominio.com
SMTP_PASS=sua_senha
FROM_EMAIL=seuemail@dominio.com
FROM_NAME="JáVai Delivery"
```

### 4. Configuração do Banco de Dados

Crie uma tabela no MySQL para armazenar as informações das empresas. Execute o seguinte comando SQL:

```sql
CREATE TABLE empresas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL
);
```

Insira os dados das empresas que você deseja enviar os e-mails:

```sql
INSERT INTO empresas (nome, email) VALUES ('Empresa Teste', 'contato@empresa.com');
```

### 5. Configuração do PHPMailer

No arquivo `send_emails.php`, o PHPMailer já está configurado para enviar e-mails usando as informações do arquivo `.env`. Verifique se você incluiu `$mail->CharSet = 'UTF-8';` para evitar erros de caracteres especiais.

### 6. Executar o Script de Envio

Agora você pode rodar o script de envio de e-mails. Navegue até o diretório do projeto no terminal e execute:

```bash
php send_emails.php
```

Os e-mails serão enviados para todos os destinatários que estão na tabela `empresas`.

## Estrutura do Projeto

```bash
mass-email-sender/
│
├── .env.example             # Exemplo do arquivo .env
├── composer.json            # Dependências do Composer
├── email_template.php       # Template HTML do e-mail
├── send_emails.php          # Script principal para enviar e-mails
├── README.md                # Documentação do projeto
└── vendor/                  # Bibliotecas instaladas pelo Composer
```

## Customização do Template de E-mail

O template HTML do e-mail está no arquivo `email_template.php`. Você pode personalizá-lo para atender às suas necessidades. Atualmente, ele inclui uma saudação com o nome da empresa, uma breve descrição dos benefícios do **JáVai**, e um botão de chamada para ação.

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
```

### **Instruções do README**
1. **Instalação**: Explica como configurar o projeto no ambiente local.
2. **Configuração do `.env`**: Orienta como definir as variáveis sensíveis, como as credenciais de SMTP.
3. **Configuração do Banco de Dados**: Explica como criar a tabela e inserir os dados no banco.
4. **Execução**: Mostra como executar o script de envio de e-mails.
5. **Customização**: Instruções sobre como editar o template HTML do e-mail.

Este arquivo deve ajudar qualquer pessoa a entender o funcionamento e configuração do seu projeto.