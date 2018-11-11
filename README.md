MicroBlog
=======================

Symfony 4 project.

Installation
------------

1. Clone repository

```bash
$ git clone https://github.com/YuriyFilonenko/MicroBlog.git
```

2. Copy `.env.dist` to `.env`

```bash
$ cp .env.dist .env
```

3. Build and run docker environment

```bash
$ docker-compose up --build -d
```
4. Run migrations

```bash
$ docker-compose exec web bash
$ ./bin/console doctrine:migrations:migrate
```

Usage
-----

You can load fixtures by following command:

```bash
$ ./bin/console doctrine:fixtures:load
```

cs-fix
-----

You can fix code style with command:

```bash
$ composer cs-fix
```
