up:
	sudo docker-compose up -d
	sleep 10
	sudo docker-compose exec -T backend php artisan migrate --force
	sudo docker-compose exec -T backend php artisan test
	@echo "Ресурс доступен по адресу: http://localhost:80"
down:
	sudo docker-compose down

restart:
	sudo docker-compose down
	sudo docker-compose up -d

rebuild: down
	sudo docker-compose build
	sudo docker-compose up -d

composer:
	sudo docker-compose exec -T backend composer install

php:
	sudo docker-compose exec backend bash
