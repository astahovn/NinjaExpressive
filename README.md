# Ninja

Service for secure team work. 
Tasks, comments and messaging - everything stored in a crypted way. 

## Programming stack

* PHP 7
* Zend Expressive

## Installation

* Install composer dependencies

```
composer install
```

* Install npm dependencies

```
npm install
```

## JSX conversion

```
grunt
```

## Database migrations

Database migrations situated in [Ninja migrations](https://github.com/astahovn/NinjaMigrations) repo.

## RSA keys generation

* Within your terminal (Unix based OS) type the following.

```
openssl genrsa -out rsa_1024_priv.pem 1024
```

* This generates a private key, which you can use to decrypt data.

* Next, you need to get the public key by executing the following command.

```
openssl rsa -pubout -in rsa_1024_priv.pem -out rsa_1024_pub.pem
```

* This public key you need to enter in your profile. It will be used to encrypt data.