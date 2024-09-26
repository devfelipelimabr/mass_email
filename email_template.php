<?php
// email_template.php

function getEmailTemplate($nome_empresa)
{
    return "
    <html>
    <head>
        <title>Oferta Especial de Gestão de Delivery</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                margin: 0;
                padding: 0;
            }
            .container {
                width: 100%;
                max-width: 600px;
                margin: 0 auto;
                background-color: #ffffff;
                padding: 20px;
                border-radius: 5px;
            }
            h1 {
                color: #333;
            }
            p {
                font-size: 16px;
                line-height: 1.5;
            }
            .btn {
                display: inline-block;
                padding: 10px 20px;
                background-color: #28a745;
                color: #ffffff;
                text-decoration: none;
                border-radius: 5px;
            }
        </style>
    </head>
    <body>
        <div class='container'>
            <h1>Olá, $nome_empresa!</h1>
            <p>Estamos animados em apresentar a você o <strong>JáVai – Aplicação de Gestão de Delivery</strong>, 
               que vai transformar a forma como você gerencia suas operações de entrega.</p>
            <p>Com o JáVai, você poderá aumentar a eficiência, otimizar seus processos e reduzir os erros no seu delivery.</p>
            <p><a class='btn' href='https://javai.shop/'>Saiba mais</a></p>
        </div>
    </body>
    </html>
    ";
}
