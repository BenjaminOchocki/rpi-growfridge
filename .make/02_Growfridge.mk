##@ [Growfridge]

.PHONY: growfridge-start
growfridge-start: ## Start the Growfridge
	# Start all services except the relays-off service
	@docker-compose up -d mariadb influxdb
	@docker-compose up -d php-fpm nginx phpmyadmin sensor-reader relays-switcher

.PHONY: growfridge-stop
growfridge-stop: ## Stop the Growfridge
	@docker-compose down
	# Start the relays-off container to shut down all relays.
	@docker-compose up -d relays-off
	# Execute docker-compose down again to remove relays-off container.
	@docker-compose down

.PHONY: growfridge-restart
growfridge-restart: ## Restart the Growfridge
	@make growfridge-stop
	@make growfridge-start

.PHONY: growfridge-registration-off
growfridge-registration-off: ## Needs root! Removes the user registration option
	@bash ./install/laravel-toggle-registration.sh OFF

.PHONY: growfridge-registration-on
growfridge-registration-on: ## Needs root! Activates the user registration option
	@bash ./install/laravel-toggle-registration.sh ON

.PHONY: generate-passwords
generate-passwords: ## If you have to generate new secure passwords run this
	@bash ./install/passwords.sh