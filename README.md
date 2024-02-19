# Calculator
## Requirements
- PHP 8.3
## Features
- Question 1
- Question 2
- Question 3: ApiRestCalculator
## Installation
lancer la commande suivante pour télécharger le code source:
```sh
git clone https://github.com/ouninabila/calculator.git

```
puis 
```sh
cd Question1
```
lancer la commande 
# Question 1
```sh

php calculator.php
```

# Question 3

```sh
cd Question3
php calculator.php
```
# Question 4
si vous n'avez pas composer vous pouvez l'installer depuis:
https://getcomposer.org/download/
pour lancer le serveur symfony il faut installer  symfony-cli
https://symfony.com/download

```sh
cd ApiRestCalculator
```
lancer la commande 
```sh
composer update
```
lancer la commande suivante  pour lancer le serveur symfony sur l'@ ip http://127.0.0.1:8000
```sh
symfony serve 
```
le code soucre de l'api est dans le service src/Service/CalcutorService.php
l'appel de ce service est dans le controller src/Controller/CalculatorController.php
pour tester l'api soit vous utiliser postman en local
ou lancer la  commande curl
```sh
curl -X POST http://127.0.0.1:8000/calculate -d '{"expression": "6 / 2 * 2"}' -H "Content-Type: application/json"
```


