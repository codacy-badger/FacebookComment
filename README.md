
# Product Facebook Comment - Magento 2

---

Adds an extra tab to the Magento 2 Product View page with Facebook Comment 

[![License: GPL v3](https://img.shields.io/badge/License-GPL%20v3-blue.svg)](https://www.gnu.org/licenses/gpl-3.0)
[![Donate](https://img.shields.io/badge/Donate-PayPal-green.svg)](https://www.paypal.me/thinghost)
![Version 1.1.0](https://img.shields.io/badge/Version-1.1.0-green.svg)


---
## [![Alt GhoSter](http://thinghost.info/wp-content/uploads/2015/12/ghoster.png "thinghost.info")](http://thinghost.info) Overview


- Download and place in app/code/GhoSter/FacebookComment.
- Run module enable and upgrade command
- [Extension on GitHub](https://github.com/tuyennn/FacebookComment)
- [Direct download link](https://github.com/tuyennn/FacebookComment/tarball/master)


![Alt Screenshot-1](http://thinghost.info/wp-content/uploads/2017/07/Selection_322-1024x681.jpg "thinghost.info")
![Alt Screenshot-2](http://thinghost.info/wp-content/uploads/2017/07/Selection_324-1024x352.jpg "thinghost.info")

## Main Features

* Adds an extra tab to Product View page with Facebook Comment 
* Support theme light and dark.
* Support multi store and languages.

## Configure and Manage

* Enable Module - Enable or disable module.
* Facebook App Id - Your Facebook App Id.
* Detail Tab Title - Extra tab title on Product View Page.
* Facebook Theme Schema - Choose Light or Dark.
* Number of Post on Current View - Number of Comment per current view
* Order By - Sort the comments
* Locale - Choose your locale
* Show Avatar Face - Choose whether to show avatar face or not

## Installation with Composer

* Connect to your server with SSH
* Navigation to your project and run these commands
 
```bash
composer require ghoster/facebook-comment


php bin/magento setup:upgrade
rm -rf pub/static/* 
rm -rf var/*

php bin/magento setup:static-content:deploy
```

## Installation without Composer

* Download the files from github: [Direct download link](https://github.com/tuyennn/FacebookComment/tarball/master)
* Extract archive and copy all directories to app/code/GhoSter/FacebookComment
* Go to project home directory and execute these commands

```bash
php bin/magento setup:upgrade
rm -rf pub/static/* 
rm -rf var/*

php bin/magento setup:static-content:deploy
```
## Licence

[Open Software License (OSL 3.0)](http://opensource.org/licenses/osl-3.0.php)


## Donation

If this project help you reduce time to develop, you can give me a cup of coffee :) 

[![paypal](https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif)](https://www.paypal.me/thinghost)
