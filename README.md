#NEW API FOR SECURE AMS

### Using

* https://github.com/docker-library/php for apache + app container
    * Check the doco there for info on including more packages
* Lumen 5.3 for app
* tymon/jwt-auth: for JWT
* league/fractal: for api tools (transformers)
* built on heroku: https://samslaravel.herokuapp.com/public/

### To run

Build docker image:

```Docker build -f Dockerfile .```

Run container:

```docker run -d -e "VIRTUAL_PORT=80" -e "VIRTUAL_HOST=samsapi.docker" --name composer-install-app -v "$PWD":/var/www/html 00d9ffb941a1```

Pull and build:

```git clone https://github.com/brobey8/samslaravel```

```composer install```

![Heroku](https://heroku-badge.herokuapp.com/?app=samslaravel&root=public)
