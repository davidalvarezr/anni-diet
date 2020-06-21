# anni-diet

To launch everything:
```
docker-compose up -d apache2 mysql
```

To connect to a container terminal:
```
docker exec -it <container_name> bash
```

MAKE SURE YOU HAVE A `.env` file in the following folders:
- anni_diet/laradock/
- anni_diet/anni_diet/

The first time you run the `docker-compose up` command, connect to the `workspace` container ans run those commands:
```
compose install					# install dependencies
php artisan migrate				# create de DB structure
php artisan passport:install    # install authentication system
```
