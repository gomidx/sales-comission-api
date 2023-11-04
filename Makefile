run-app-with-setup:
	docker compose build
	docker compose up -d
	docker exec php-api /bin/sh -c "composer install && chmod -R 777 storage && php artisan key:generate && php artisan migrate:fresh --seed"

run-app:
	docker compose up -d

run-tests:
	docker exec php-api /bin/sh -c "php artisan test"

kill-app:
	docker compose down

enter-nginx-container:
	docker exec -it nginx-api /bin/sh