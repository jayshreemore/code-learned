# CRUD using Angular JS, Node JS, Mysql

## Inspiration
1. https://www.youtube.com/watch?v=wz-ZkLB7ozo&list=PLSXayGBdAAQAKAygXM3ZZrO0wxpMUIWJM (Part 1 - Part)
2. http://teknosains.com/i/simple-crud-nodejs-mysql

## Pre-Requisities
1. Node js and NPM: https://nodejs.org/en/download/
2. Express
	npm install express -g
	npm install express-generator -g
3. Bower
	npm install bower -g
4. MySQL (Wamp)
	Add C:\wamp\bin\mysql\mysql5.6.12\bin in Environment Variable - Path
5. Git: https://git-scm.com/downloads

Confirm all the required tools are installed correctly
1. node -v
2. npm -v
3. express --version
4. bower -v
5. mysql --version
6. git --version

## Creating app-name using express
	express app-name

## Install required bower and npm packages with --save (to add into package.json)
	cd app-name

	npm install

	npm init //to modify the package.json configuration

	npm install mysql --save
	npm install express-myconnection --save

	npm install ejs --save

	npm install stylus --save

	bower init //for bower.json	
	bower install angular --save
	bower install bootstrap --save

## Create Database
	see this: database/database-schema.md

## Modify app.js (completely)
app.set('view engine', 'ejs');
app.use('/bower_components', express.static(__dirname + '/bower_components'));

index.ejs
<% include layout %>

## Other files that you need to copy
- public
	- javascripts (folder)
		- app
			- domain
				- domainModule //module name
				- domainService //api or service routes
				- domainController
				- viewDomainController
				- editDomainController
- routes
	- domainRouteConfig.js //route, render
- Server (folder)
	- Dao //sql
		- domainDao.js //sql queries
	- mysqlConnectionString.js //database connection credentials
	- mysqlConnectionStringProvider.js //getMysqlConnection, closeMysqlConnection
- views (folder) //template
- app.js

## Other References:
	<p ng-bind="date | date:'MM/dd/yyyy'"></p>
http://stackoverflow.com/questions/22392328/how-to-format-date-in-angularjs