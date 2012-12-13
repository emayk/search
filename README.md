Search results iterator
=====================

install:
---------
    By Composer:

    Install composer http://getcomposer.org to your project root;

    create composer.json and add something like following:
    {
        "require": {
            "virm/search": "dev-master"
        },
        "require-dev": {
            "phpunit/phpunit": "3.7.*"
        },
        "autoload": {
            "psr-0": {"Virm\\Search": ""}
        }
    }

    run:
        php composer.phar install
        php composer.phar update
    for installing dependencies. (symfony dom_crawler, css_selector components)


Usage:
---------
    <?php
        header('Content-Type: text/html; charset=utf-8');
        require_once 'vendor/autoload.php';

        use Virm\Search\Search;
        use Virm\Search\Engine\GoogleEngine;

        $engine = new GoogleEngine('phpunit brutal');
        $search = new Search($engine, 250);

        echo $engine->getCount();

        foreach($search as $k => $result) {
            echo $result->getTitle();
            echo $result->getDescription();
            echo $result->getLink();
        }

        echo $search[23];
    ?>

