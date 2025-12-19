# 🏦 Bankly V2

**Bankly V2** est une application web développée en **PHP procédural** avec **MySQL**, destinée à la gestion interne d’une petite banque.  
Elle permet aux employés de gérer les clients, les comptes bancaires, les transactions (dépôt et retrait) et de consulter un tableau de bord avec des statistiques globales.

---

## 🎯 Objectifs du projet
- Gérer les **clients**
- Créer et gérer les **comptes bancaires**
- Enregistrer des **transactions** (dépôt / retrait)
- Consulter l’**historique des transactions**
- Accéder à l’application uniquement après **authentification**
- Organiser les données dans une **base SQL** modélisée via un **ERD**
- Afficher un **Dashboard** avec des statistiques globales

---

## 🚀 Fonctionnalités

### 🔐 Authentification
- Connexion (login)
- Déconnexion (logout)
- Accès sécurisé par sessions

### 👤 Gestion des Clients
- Ajouter un client (nom, email, CIN)
- Modifier un client
- Supprimer un client
- Consulter la liste des clients

### 💳 Gestion des Comptes
- Créer un compte bancaire pour un client
- Modifier un compte
- Supprimer un compte
- Consulter la liste des comptes

### 🔄 Gestion des Transactions
- Effectuer un dépôt
- Effectuer un retrait
- Mise à jour automatique du solde
- Historique des transactions
- Sélection des comptes selon le client choisi

### 📊 Dashboard
- Nombre total de clients
- Nombre total de comptes
- Nombre total de transactions

---

## 🗄️ Base de données

La base de données est conçue à l’aide d’un **ERD** et contient les entités suivantes :
- Utilisateur
- Client
- Compte
- Transaction

Le schéma de la base de données est fourni dans le fichier :

---

## ⚙️ Technologies utilisées
- PHP (procédural)
- MySQL
- HTML / CSS
- JavaScript
- Git / GitHub

---

## ▶️ Installation (en local)

### 1️⃣ Cloner le dépôt
```bash
git clone https://github.com/USERNAME/BANKLY_V2.git

