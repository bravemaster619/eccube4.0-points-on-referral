# PointsOnReferral

PointsOnReferral is an [EC-CUBE 4.0](https://doc4.ec-cube.net/) plugin that rewards users points on referral.

# Requirement

- EC-CUBE v 4.0.3 or higher

# Installation Guide

See the [official guide for plugin installation](https://doc4.ec-cube.net/plugin_install).

## Via admin plugin page

Upload and install your own plugin (tar.gz/zip)

## Via command line

### Install

```console
$ php bin/console eccube:plugin:install --code=PointsOnReferral
```

### Enable

```console
$ php bin/console eccube:plugin:enable --code=PointsOnReferral
```

### Disable

```console
$ php bin/console eccube:plugin:disable --code=PointsOnReferral
```

### Uninstall

```console
$ php bin/console eccube:plugin:uninstall --code=PointsOnReferral
```

# Test Guide

### 1. Set up docker-compose for latest eccube release. 

[Official guide](https://doc4.ec-cube.net/quickstart_install)

### 2. In docker shell, run the following command:
 
```console
$ composer install
```
This will install require-dev dependencies, including phpunit.

### 3. In docker shell, run the following command:

```console
$ bin/phpunit app/Plugin/PointsOnReferral -c /var/www/html/app/Plugin/PointsOnReferral/phpunit.xml.dist
```
