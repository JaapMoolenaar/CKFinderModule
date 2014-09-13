# CKFinderModule
[![Latest Stable Version](https://poser.pugx.org/satsume/ckfinder-module/v/stable.svg)](https://packagist.org/packages/satsume/ckfinder-module) [![Latest Unstable Version](https://poser.pugx.org/satsume/ckfinder-module/v/unstable.svg)](https://packagist.org/packages/satsume/ckfinder-module) [![Build Status](https://travis-ci.org/Satsume/CKEditorModule.svg?branch=master)](https://travis-ci.org/Satsume/CKEditorModule)

## Introduction
This module is relies on [AssetManager](https://github.com/RWOverdijk/AssetManager/)
to provide a ckfinder implemenation without having to install it in the publicly
accessible folder.


## Installation
CKFinderModule is set-up to use the ckfinder source from /vendor/ckfinder/ckfinder
( ckfinder.php would be in /vendor/ckfinder/ckfinder/ckfinder.php ). You should
download the source from ckfinder.com and extract it in /vendor/ckfinder/ckfinder/

A route is automatically setup at ```/ckfinder/```

Permissions for the main and connector route are added for [BjyAuthorize](https://github.com/bjyoungblood/BjyAuthorize) and [zfc-rbac](https://github.com/ZF-Commons/zfc-rbac) for users with a role of ```admin```.

The config.php supplied by ckfinder ( ```/ckfinder/config.php``` ) is not used, instead its located in ```/satsume/ckfinder-module/config/ckfinder.config.php``` ( take look at it's contents [here](https://github.com/Satsume/CKFinderModule/blob/master/config/ckfinder.config.php) ). The location of this file can be overridden by setting a different path in ```'ckfinder_module' => 'ckfinder_config_path'```.

## CKEditor
If [CKEditorModule](https://github.com/Satsume/CKEditorModule) is included, the ckfinder will automatically be setup for use in the ckeditor.