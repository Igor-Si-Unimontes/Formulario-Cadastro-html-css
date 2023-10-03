<?php

print("CPF:");
print($_POST['cpf']."<br>");

print("Nome:");
print($_POST['name']."<br>");

print("Ano nascimento:");
print($_POST['year']."<br>");
/*
print("CEP:");
print($_POST['cep']."<br>");

print("Logradouro:");
print($_POST['logradouro']."<br>");

print("Numero da Casa:");
print($_POST['numberhouse']."<br>");

print("Bairro:");
print($_POST['bairro']."<br>");

print("Cidade:");
print($_POST['city']."<br>");

print("Estado:");
print($_POST['state']."<br>");
*/
print("Celular:");
print($_POST['number']."<br>");

print("E-mail:");
print($_POST['email']."<br>");

//parei nos sim e nao


$cep = $_POST['cep'];

$retorno = json_decode(file_get_contents("https://viacep.com.br/ws/$cep/json/"));

//var_dump($retorno);

print("<h1>Resultado da consulta</h1>");
print("Logradouro: ".$retorno->logradouro."<br>");

if($retorno->complemento <> "") {
   print("Complemento: ".$retorno->complemento."<br>");
}


print("Bairro: ".$retorno->bairro."<br>");
print("Cidade: ".$retorno->localidade."<br>");
print("Estado: ".$retorno->uf);

?>