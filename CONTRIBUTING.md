Contributing
============

We welcome any contributing!

Pull requests
-------------

You must follow the next rules to contribute to this project:

- **Create feature branches** - You must create a new branch for a feature. We don't accept pull requests from master branch.

- **One pull request per feature** - If you want to do more than one thing, send multiple pull requests.

- **Only English** - Please use English language in pull requests.

Tests
-----

You can run tests with composer command

```
$ composer test
```

or using following command

```
$ ./vendor/bin/codecept build && ./vendor/bin/codecept run
```

Code style
----------

To fix the code style just run the following command

```
$ composer cs-fix
```

or

```
$ ./vendor/bin/php-cs-fixer fix --allow-risky=yes
```

Happy coding :)
---------------
