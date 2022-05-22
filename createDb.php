<?php
try {
    $connection = new mysqli("localhost", "root", null);
    if ($connection->query("CREATE DATABASE IF NOT EXISTS Magazzino") == TRUE) {
        echo ("Database Magazzino creato correttamente<BR>");
        $connection = new mysqli("localhost", "root", null, "Magazzino");

        if ($connection->query('CREATE TABLE Utenti(id int auto_increment PRIMARY KEY, username varchar(20) NOT NULL UNIQUE, password varchar(20) NOT NULL, privilegi int(1) NOT NULL)') == TRUE) {
            echo ("Tabella Utenti creata correttamente<BR>");
        } else {
            echo ("Errore nella creazione della tabella Utenti: " . $connection->error . "<BR>");
        }

        if ($connection->query('CREATE TABLE Articoli(id int auto_increment PRIMARY KEY, descrizione varchar(20) NOT NULL, quantita int, prezzo double(6,2), UNIQUE(descrizione))') == TRUE) {
            echo ("Tabella Articoli creata correttamente<BR>");
        } else {
            echo ("Errore nella creazione della tabella Articoli: " . $connection->error . "<BR>");
        }

        $connection->close();
    } else {
        echo ("Errore nella creazione db: " . $connection->error . "<BR>");
        $connection->close();
    }
} catch (Exception $ex) {
    echo ($ex);
}
