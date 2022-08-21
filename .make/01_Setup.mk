##@ [Install the Growfridge. Run in this order]

# .PHONY is needed in case of having a file with the same name in the same directory.
# .PHONY will prevent using the local same name file and instead calls the defined task
.PHONY: setup-login
setup-login: ## Initialize credentials. Modify the .env file for your needs before you proceed!
	@bash ./install/config-copy.sh

.PHONY: setup-software
setup-software: ## Needs root! Execute this to install system required software. Reboots afterwards!
	@bash ./install/setup.sh

.PHONY: setup-drivers
setup-drivers: ## Needs root! Install required hardware drivers. Reboots afterwards!
	@bash ./install/arducam-drivers.sh

.PHONY: setup-cron
setup-cron: ## Install required camera cronjob.
	@bash ./install/arducam-cron.sh

.PHONY: setup-config
setup-config: ## Execute this after you updated your .env file
	@bash ./install/config-init.sh

.PHONY: setup-container
setup-container: ## Setup Growfridge. This will shutdown by itself
	# Start mariadb and influxdb before starting others so they have time to initialize
	@docker-compose up -d mariadb influxdb
	@docker-compose up -d php-fpm nginx phpmyadmin sensor-reader relays-switcher
	# Installing laravel components and set permissions
	@bash ./install/setup-laravel.sh
	# At this point all containers have been initialized.
	@docker-compose down
	# Start the relays-off container to shut down all relays just in case of weird behavior
	@docker-compose up -d relays-off
	# Execute docker-compose down again to remove relays-off container.
	@docker-compose down
