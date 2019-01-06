up:
	docker-compose up -d

down:
	docker-compose down

test:
	vendor/bin/phpunit

assets-dev:
	docker-compose exec node npm run dev

assets-prod:
	docker-compose exec node npm run dev

assets-watch:
	docker-compose exec node npm run watch

perm:
	sudo chgrp -R www-data storage bootstrap/cache
	sudo chmod -R ug+rwx storage bootstrap/cache