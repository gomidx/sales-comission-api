run:
	cp ./src/.env.example ./src/.env
	docker compose build
	docker compose up -d
	docker exec php /bin/sh -c "composer install && chmod -R 777 storage && php artisan key:generate && php artisan migrate:fresh --seed"

run-tests:
	docker exec php-api /bin/sh -c "php artisan test"

down:
	docker compose down