# rms_paradise

Deployment Instruction

To locally deploy the application, follow the following instructions:
Clone the application from following GitHub link
	https://github.com/anushanthR/rms_paradise.git

**make sure php is installed in the system and environments are all set,
Rename the .env.example file in the project root folder to .env
Edit .env file, Set database credentials and database name (rms_paradise),
Open mysql workbench (or any database management tool of your preference) 
Create new database with the name rms_paradise.
Go to project root directory and open a command prompt (or terminal) from root folder and run following commands.
	php artisan migrate (will create required tables in database)
	php artisan db:seed (will seed the database with dummy data)
	php artisan serve (will launch the server)

now open a browser and go to http://localhost:8000



