# SDN
### SDN Managementsite

[Hier](https://github.com/maltesserver/SDN/archive/refs/tags/1337.zip) kann man alle Dateien als Release Downloaden.

#### Funktionen: 

* User Management

* Geräte via SSH Anlegen

* Eigene Ping API

* SSH Befehle Senden per Website

* White- und Darkmode

* SSH Verbindung mit einen Klick starten

* CSV und PDF Export von Tabellen

* Kopieren von Daten aus Tabellen in die Zwischenablage

 
## Erste Schritte

PHP installieren oder sicherstellen, dass installiert ist.

Als Cisco DevOps Netzwerk wurde [dieses Netzwerk benutzt](https://devnetsandbox.cisco.com/RM/Diagram/Index/c9679e49-6751-4f43-9bb4-9d7ee162b069?diagramType=Topology ).

### Benötigt

* [PHP Composer](https://getcomposer.org/ ) - Dependency-Manager
* [PHP cURL](https://www.php.net/manual/de/book.curl.php ) - PHP Requests
* [PHP 7.0+](https://www.php.net/ ) - Programmiersprache
* SQL Datenbank (MariaDB oder MySQL)


#### Composer Pakete

* JWL Firebase
* phpseclib
* paragonie

### Installierung

* SQL Importieren in die Datenbank

* Config.php Editieren

* API Key in der Datenbank eintragen und in der Config einsetzen

* Rechte setzen (Linux)
(Bei Windows wird es nicht benötigt)
```
    -> chmod 777 config.php
    -> chmod 777 api
    -> chmod 777 app
    -> chmod 777 mgmt
```
* Webroot in /app Setzen oder index.html als Weiterleitung nutzen

* Einloggen

PHP Composer Update (Optional)

```
php composer update
```

### Gruppen:

Es gibt zwei Gruppen, Gruppe 1 sind die Nutzer, die Geräte Verwalten dürfen und Gruppe 2, das sind die Admins, diese dürfen User anlegen.

### Standard Logindaten:

Admin:

Benutzer: `admin@example.com`

Passwort: `adminpass`

Benutzer:

Benutzer: `max@mustermann.de`

Passwort: `userpass`

### API

Diese SDN bietet eine kleine aber feine API an, die Website arbeitet selbst damit, daher ist es wichtig, diese richtig einzustellen.
Der API-Key muss als Auth-Token angegeben werden in der Config.

Der Standart API-Key lautet: `1q2w3e4r5t6z7u8i9o0p`
Bitte diesen Key wegen der Sicherheit ändern!

#### API Endpoints



```
https://example.com/api/get-devices
```
Dieser Endpoint gibt alle Geräte aus der Datenbank in ein JSON Array aus ohne Passwort.

## Beispiel:

```
curl --location --request GET 'https://example.com/sdn/api/get-devices' \
--header 'Auth-Token: qw79dz9qw8ud89wqud'
```

## Output:

```
{
    "ID": "2",
    "Name": "Router-01",
    "IP": "10.0.0.1",
    "User": "root",
    "Shell_Port": "22"
}
```

```
https://example.com/api/ping-device
```
Dieser Endpoint pingt ein Gerät mit der IP und dem Port.

Benötigte Headers:

* device_ip         -> Die IP/Domain wo der Ping hingehen soll
* device_port       -> Der offene Port, der gepingt werden kann

## Beispiel:

```
curl --location --request GET 'https://example.com/sdn/api/ping-device' \
--header 'device_ip: 1.1.1.1' \
--header 'device_port: 443' \
--header 'Auth-Token: 1q2w3e4r5t6z7u8i9o0p'
```

## Output:

```
{
    "code": 200,
    "message": "OK",
    "request_url": "/api/ping-device/",
    "device_ip": "1.1.1.1",
    "device_port": "443",
    "device_status": "Online",
    "latency": "22.867ms"
}
```

### PHP Info

Um alle Funktionen richtig zu benutzten zu können, wird empfohlen die PHP Version ab 7.0 zu nehmen.
Als Zusatzpakete werden folgende benötigt:

* cURL
* SSH

## Built With

* [PHP 7.4.1](https://www.php.net/ ) - Version 7.4.1

## Authoren

* [Malte](https://github.com/Maltesserver)
* [Felix](https://github.com/Realtox)


## License

This project is licensed under the `MIT License` - see the [LICENSE.md](LICENSE.md) file for details





## © Malte & Felix 2021

