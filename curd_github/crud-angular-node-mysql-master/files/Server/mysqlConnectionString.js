var mysqlConnectionString = {
	connection :{
		dev : {
			host: 'localhost',
			user: 'root',
			password : '',
			database : 'kazi_projects'
		},

		qa: {
			host: 'localhost',
			user: 'root',
			password : '',
			database: 'kazi_projects'
		},

		prod: {
			host: 'localhost',
			user: 'root',
			password : '',
			database: 'kazi_projects'
		}
	}
};

module.exports.mysqlConnectionString = mysqlConnectionString;