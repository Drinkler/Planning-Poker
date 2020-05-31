# Planning-Poker :black_joker:

[![Codacy Badge](https://api.codacy.com/project/badge/Grade/593c2cb72b1540b491176debcae6f180)](https://www.codacy.com/manual/Drinkler/Planning-Poker?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=Drinkler/Planning-Poker&amp;utm_campaign=Badge_Grade)
[![Website](https://img.shields.io/website?down_color=lightgrey&down_message=offline&up_color=green&up_message=online&url=http%3A%2F%2Fplanning-poker.eba-gveiarhp.eu-central-1.elasticbeanstalk.com%2F)](http://planning-poker.eba-gveiarhp.eu-central-1.elasticbeanstalk.com/)
[![Build Status](https://travis-ci.com/Drinkler/Planning-Poker.svg?branch=master)](https://travis-ci.com/Drinkler/Planning-Poker)
[![codecov](https://codecov.io/gh/Drinkler/Planning-Poker/branch/master/graph/badge.svg)](https://codecov.io/gh/Drinkler/Planning-Poker)
[![License: GPL v3](https://img.shields.io/badge/License-GPLv3-blue.svg)](https://www.gnu.org/licenses/gpl-3.0)

## About
Planning-Poker is a web based php app. The project emerged from the requirements of a study project. During the implementation we tried to use current best practices of software development and to get to know new ones.

## Website 
You can find a hosted version of this project here: http://planning-poker.eba-gveiarhp.eu-central-1.elasticbeanstalk.com/

# Prerequisites
To run this project locally, you must have a php development server running atleast version 7.3.0 .
On a Windows development environment, we recommend using XAMPP: https://www.apachefriends.org/de/index.html .
On a Mac OsX development environment, we recommend using Scotch Box: https://box.scotch.io/ .

## Database 
To connect to the databse, special environment params within the dev environment are required. Interested inquiries can be sent to the authors of this project.

## Bower components 
For dependency purposes, the free package manager bower needs to be executed.

```
$ npm install -g bower
```

After successfully installing, you can execute the bower.json
```
$ bower install
```

Alternatively bower can be install via Node. It is futhermore recommended to execute the package.json 
```
$ npm install
```

## Composer
To ensure further compatibility of the project, composer is used. 

To quickly install Composer in the current directory, run the following script in your terminal.
```
$ php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
$ php -r "if (hash_file('sha384', 'composer-setup.php') === 'e0012edf3e80b6978849f5eff0d4b4e4c79ff1609dd1e613307e16318854d24ae64f26d17af3ef0bf7cfb710ca74755a') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
$ php composer-setup.php
$ php -r "unlink('composer-setup.php');"
```

You can now execute the composer.json
```
$ composer install
```

# Built With
* [PHP](https://www.php.net/) - Backend Development Language
* [HTML](https://wiki.selfhtml.org/wiki/HTML) - Frontend Markup Language
* [CSS & SCSS](https://wiki.selfhtml.org/wiki/CSS) - Cascading Style Sheet Language
* [Bower](https://bower.io/) - Package Manager
* [Composer](https://getcomposer.org/) - PHP Dependency Management

# Authors
* **Luca Stanger** - Frontend development & serverside development - [Student @ DHBW Stuttgart](https://www.dhbw-stuttgart.de/home/)
* **Florian Drinker** - Backend development & deployment - [Student @ DHBW Stuttgart](https://www.dhbw-stuttgart.de/home/)

# Copyright 
Copyright 2020 Florian Drinkler, Luca Stanger

# License
This project is licensed under the **GNU General Public License v3.0** - see the [LICENSE.MD](https://github.com/Drinkler/Planning-Poker/blob/master/LICENSE) file for details
