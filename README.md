<p align="center">
  <a href="" rel="noopener">
 <img width=200px height=200px src="https://github.com/lucascampanelli/MySecretFriend/blob/master/view/assets/images/logo.png?raw=true">
 </a>
</p>

<h3 align="center">lucascampanelli/mysecretfriend</h3>

<div align="center">

[![Status](https://img.shields.io/badge/status-active-success.svg)]()
[![License](https://img.shields.io/badge/license-MIT-blue.svg)](/LICENSE)

</div>

---

######<p align="center"> A simple website to organize a secret santa with your friends and family.
    <br> 
</p>

## 📝 Table of Contents

- [About](#about)
- [Getting Started](#getting_started)
- [Usage](#usage)
- [Built Using](#built_using)
- [Authors](#authors)

## 🧐 About <a name = "about"></a>

MySecretFriend is a application made for people who needs to organize a secret santa faster.
It allows group creation between friends and family with a few clicks.

## 🏁 Getting Started <a name = "getting_started"></a>

<ul>
<li>Download the project</li>
<li>Insert it into your PHP server folder</li>
<li>Rename .env.example to .env</li>
<li>Set your own .env file containing database and PHPMailer information</li>
<li>Run <b>composer update</b> at the project folder to install the dependencies</li>
<li>Import the database <i>secretfriend_db.sql</i> to your PHP server</li>
<li>Enjoy it!</li>
</ul>

### Prerequisites

You'll need to have <b>Composer</b> installed in your machine to be able to install and update dependencies.

## 🎈 Usage <a name="usage"></a>
```
HOME
```
This page shows a form to sign up for the application and a button to redirect you to login page.
 <img src="https://github.com/lucascampanelli/MySecretFriend/blob/master/signupView.png?raw=true">
 <br>
```
LOGIN
```
This page shows a form to sign in.
 <img src="https://github.com/lucascampanelli/MySecretFriend/blob/master/loginView.png?raw=true">
 <br>
```
DASHBOARD
```
Shows user groups. This page has sections such as user configuration and group creation.
 <img src="https://github.com/lucascampanelli/MySecretFriend/blob/master/dashboardView.png?raw=true">
 <br>
```
RAFFLE
```
Section to create a secret santa. It has a form to type all the information about the raffle.
 <img src="https://github.com/lucascampanelli/MySecretFriend/blob/master/raffleView.png?raw=true">
 <img src="https://github.com/lucascampanelli/MySecretFriend/blob/master/raffleexampleView.png?raw=true">
 <br>
```
PASSWORD RECOVER
```
If necessary, this page sends an e-mail verification to recover the user's password.
 <img src="https://github.com/lucascampanelli/MySecretFriend/blob/master/passwdrecoverView.png?raw=true">
 <br>


## ⛏️ Built Using <a name = "built_using"></a>

- [XAMPP](https://www.apachefriends.org/pt_br/index.html) - Package
- [VSCODE](https://code.visualstudio.com/) - Code editing
- [Composer](https://getcomposer.org/) - Code editing
- [Router](https://github.com/robsonvleite/router) - Library
- [Data Layer](https://github.com/robsonvleite/datalayer) - Library
- [PHPMailer](https://github.com/PHPMailer/PHPMailer) - Library
- [phpdotenv](https://github.com/vlucas/phpdotenv) - Library

## ✍️ Authors <a name = "authors"></a>

- [@lucascampanelli](https://github.com/lucascampanelli) - Idea & Development
