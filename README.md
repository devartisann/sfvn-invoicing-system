# The Invoicing System 

## About This App

This is a small project related to a fruit invoicing system which have some basic functionalities:

- Login page for staff
- A page for register fruit category.
- A page for register fruit item.
- A CRUD page for invoice. Have the ability to print the invoice too.

## Prequisites

- Required Softwares: `docker`, `docker-compose`.
- OS: Only applicable to Unix (best running with Ubuntu or MacOS).

## Installation

- Generate the `.env` file by running the command: `cp .env.example .env`. Define your environment variable value for: `DB_PASSWORD`, `DB_ROOT_PASSWORD`, `ADMIN_PASSWORD`.
- Set up docker to intialize the environment by running `(sudo) docker compose up -d` (or `(sudo) docker-compose up -d` for Docker Compose v1.x). NOTE: Considering use `sudo` if need higher permission to run docker.
- Enter the `backend` container by running command: `(sudo) docker exec -it backend bash`.
- Run installation script by running command `./install.sh`. Give it a couple minutes to finish the instalation process.
- Test the site by visiting `http://localhost`.

## License

The project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
