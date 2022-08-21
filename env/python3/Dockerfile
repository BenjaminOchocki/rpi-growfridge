ARG PYTHON_VERSION
FROM python:${PYTHON_VERSION}

# Install updates and additional packages.
# Upgrade pip and install hardware required python libraries
RUN apt update && apt upgrade -y && apt install -y i2c-tools \
	&& /usr/local/bin/python -m pip install --upgrade pip \
	&& pip3 install --no-cache-dir RPi.GPIO RPi.bme280 smbus2 influxdb-client mysql-connector-python==8.0.29
