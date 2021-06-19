# HTMLPurifier for EC-CUBE4

This plug-in integrates [HTMLPurifier](http://htmlpurifier.org/) into [EC-CUBE4](https://github.com/EC-CUBE/ec-cube).

## Installation

Install the plugin:
```bash
$ composer require exercise/htmlpurifier-bundle
$ git clone git@github.com:kurozumi/HTMLPurifier.git app/Plugin
$ bin/console e:p:i --code HTMLPurifier
$ bin/console e:p:e --code HTMLPurifier

or

$ bin/console eccube:composer:require exercise/htmlpurifier-bundle
$ git clone git@github.com:kurozumi/HTMLPurifier.git app/Plugin
$ bin/console e:p:i --code HTMLPurifier
$ bin/console e:p:e --code HTMLPurifier
```
