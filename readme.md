## InternAPP : basic application for internships

#Features :

	The application will have 2 kinds of users, student and employer.

	After registering, the employer should be able to post internships, with bare minimum details. Internship posting should be restricted only to an employer and a student as well as a non registered user, should not be allowed.

	There should be a page which should display all the internships being posted on the application. This page should be accessible to everyone irrespective of whether the user is even logged in.

	A student should be able to apply to any internship he may want. If the student has already applied for an internship, he should be restricted from applying again. If the user is not logged in, it should redirect to the login page. And if the user is logged in as an employer, he should not be allowed to apply.

	The employer should be able to see all the application he has received for his internships

#Installing Laravel
	The following link explains it better:
	http://laravel.com/docs/quick#installation

#Installing Neo4j
	I have used Neo4j version 2.1.3, I have tried it on 2.1.4 but the adaptor I'm using does not work with it, So install v2.1.3.

	Instructions to install neo4j on ubuntu

	Enter The following commands in terminal.

	sudo -s

	wget -O - http://debian.neo4j.org/neotechnology.gpg.key | apt-key add -

	echo 'deb http://debian.neo4j.org/repo stable/' > /etc/apt/sources.list.d/neo4j.list

	apt-get update

	apt-get install neo4j=2.1.3

	service neo4j-service status

#Instructions to run the app

	After installing the above.

	Pull the repository

	run the command : composer install : it will download all the dependencies.

	run the command : php artisan serve : on the app directory

	app will start runnung on localhost:8000 as default.

	Thank you.