# The Big Brains Company - Composer Javascript

Composer script handler for executing `npm install` and `bower install` automatically
after the `composer install` (or update) command.


## Usage

Add this lines to your composer.json file:

```json
{
    "require": {
        "tbbc/composer-javascript": "~1.0"
    },
    "scripts": {
        "post-install-cmd": [
            "Tbbc\\ComposerJavascript\\ScriptHandler::npmInstall",
            "Tbbc\\ComposerJavascript\\ScriptHandler::bowerInstall"
        ],
        "post-update-cmd": [
            "Tbbc\\ComposerJavascript\\ScriptHandler::npmInstall",
            "Tbbc\\ComposerJavascript\\ScriptHandler::bowerInstall"
        ]
    }
}
```

You can freely add both or just one of the `npmInstall` or `bowerInstall` scripts.


## Options

For users that work with a Samba sharing or like, you can pass an option for `npm install` to prevent using
symlinks for binaries.

Just add the following to your composer.json file:

```json
"extra": {
    "tbbc-composer-javascript": {
        "npm-bin-links": false
    }
}
```

`npm-bin-links` default value is `true`.