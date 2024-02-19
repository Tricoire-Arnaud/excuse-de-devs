# Excuses de Dev

Ce projet est une application web qui génère des excuses aléatoires pour les développeurs. L'application utilise Symfony pour le backend et HTML/CSS avec Bootstrap pour le frontend.

## Prérequis

Avant de commencer, assurez-vous d'avoir installé les outils suivants sur votre système :

- PHP (version 7.4 ou supérieure)
- Composer
- Un serveur web local (Apache, Nginx, etc.)
- MySQL ou un autre système de gestion de base de données pris en charge par Symfony

## Installation

1. Clonez ce dépôt sur votre machine locale :

    ```bash
    git clone (https://github.com/Tricoire-Arnaud/excuse-de-devs.git)
    ```

2. Accédez au répertoire du projet :

    ```bash
    cd excuses_de_dev
    ```

3. Installez les dépendances PHP à l'aide de Composer :

    ```bash
    composer install
    ```

4. Créer à la racine un fichier ```.env.local```

Copier à l'intérieur de ce fichier la ligne suivante : 

```DATABASE_URL="mysql://root:root@127.0.0.1:3306/excuse?serverVersion=10.3.39-MariaDB&charset=utf8mb4"```

Dans le Terminal tapez ```mysql -V``` pour connaitre la version de Mysql, puis modifier la version de MariaDB dans la ligne de code au dessus.

5. Créez la base de données en exécutant les commandes suivantes :

    ```bash
    php bin/console doctrine:database:create
    php bin/console doctrine:migrations:migrate
    ```

## Envoi des fixtures

Pour ajouter des données de test à votre base de données, vous pouvez utiliser les fixtures. Exécutez la commande suivante :

```bash
php bin/console doctrine:fixtures:load
```

Cela ajoutera des données d'exemple à votre base de données.

## Lancement du serveur

Pour lancer le serveur Symfony, exécutez la commande suivante à partir du répertoire du projet :

```bash
symfony server:start
```
Assurez-vous que le serveur est démarré et que l'application est accessible à l'adresse indiquée dans la sortie de la commande.

Une fois le serveur démarré, accédez à l'adresse suivante dans votre navigateur web :

```bash
http://localhost:8000
```

## Routes
Les routes suivantes sont disponibles dans l'application :

/ : Affiche une excuse de dev aléatoire.

/lost : Affiche une page d'erreur "Lost".

/{http_code} : Affiche une excuse correspondant au code HTTP spécifié.


## Utilisation
Une fois le serveur lancé, vous pouvez accéder aux différentes fonctionnalités de l'application en utilisant les routes mentionnées ci-dessus.

Consultez la section "Routes" pour des instructions détaillées sur l'utilisation de chaque route.