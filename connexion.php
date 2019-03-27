<?php

$pdo = new PDO('mysql:host=localhost;dbname=todo-list', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);