<?php
// email_template.php

function getEmailTemplate($nome_empresa, $empresa_id)
{
    $nome_empresa = $nome_empresa ?? 'Empreendedor(a)';
    return "
    <html lang='pt-br'>
    <meta charset='UTF-8'>
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
                text-transform: capitalize;
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
            .unsubscribe {
                margin-top: 20px;
                font-size: 12px;
                color: #999;
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
            <div class='unsubscribe'>
                <p>Se não desejar receber mais e-mails, <a href='https://3867-2804-214-11-c073-28e4-72d0-195a-c604.ngrok-free.app/mass_email/unsubscribe.php?id=$empresa_id'>clique aqui para desinscrever-se</a>.</p>
            </div>
        </div>
    </body>
    </html>
    ";
}
