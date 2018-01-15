/* SQL Queries */
var connectionProvider = require('../mysqlConnectionStringProvider.js');//path

var table_name = 'tbl_kazi_domain';

var domainDao = {

	createDomain : function (domain, OnSuccessfulCallback) {//
		var insertStatement = "INSERT INTO " + table_name + " SET ?";

		var domainArr = {
			//ColumnName: domain...
			domain_name: domain.domain_name,
			hosting: domain.hosting,
			hosting_date: domain.hosting_date,
			expiry_date: domain.expiry_date
		};

		console.log(domainArr);

		var connection = connectionProvider.mysqlConnectionStringProvider.getMySqlConnection();//from mysqlConnectionStringProvider.js

		if (connection) {
			connection.query(insertStatement, domainArr, function (err, result) {
				if (err) { }

				OnSuccessfulCallback({status: 'successful'});
			
				// console.log(result)
			});
			connectionProvider.mysqlConnectionStringProvider.closeMySqlConnection(connection);
		}
	},

	getAllDomain: function (callback) {
		var connection = connectionProvider.mysqlConnectionStringProvider.getMySqlConnection();
		var queryStatement = "SELECT * FROM " + table_name + " ORDER BY domain_id DESC";

		if (connection) {
			connection.query(queryStatement, function (err, rows, fields) {
				if (err) { throw err; }

				// console.log(rows);

				callback(rows);
			});
			connectionProvider.mysqlConnectionStringProvider.closeMySqlConnection(connection);
		}
	}
	,

	getDomainById : function (domain_id, callback) {
		var connection = connectionProvider.mysqlConnectionStringProvider.getMySqlConnection();
		var queryStatement = "SELECT * FROM " + table_name + " WHERE domain_id = ?";

		if(connection) {
			connection.query(queryStatement, [domain_id], function (err, rows, fields) {
				if (err) { throw err; }

				console.log(rows);//working

				callback(rows);
			});

			connectionProvider.mysqlConnectionStringProvider.closeMySqlConnection(connection);
		}
	},

	updateDomain: function(domain_name, hosting, hosting_date, expiry_date, domain_id, callback) {
		//works fine here
		if(domain_name == undefined) domain_name = 'grow.tgg.org.np';//just debugging

		// console.log('Updated: '+domain_name + hosting);

		var connection = connectionProvider.mysqlConnectionStringProvider.getMySqlConnection();
		var queryStatement = "UPDATE " + table_name + " SET domain_name = ? , hosting = ?, hosting_date = ?, expiry_date = ? WHERE domain_id = ?";

		if(connection) {
			connection.query(queryStatement, [domain_name, hosting, hosting_date, expiry_date, domain_id], function (err, rows, fields) {
				if (err) { throw err; }

				console.log(rows);

				if (rows) {
					callback({ status: 'successful' })
				}
			});

			connectionProvider.mysqlConnectionStringProvider.closeMySqlConnection(connection);
		}

	},

	deleteDomainById: function(domain_id, callback) {
		var connection = connectionProvider.mysqlConnectionStringProvider.getMySqlConnection();
		var queryStatement = "DELETE FROM " + table_name + " WHERE domain_id = ?";

		if(connection) {
			connection.query(queryStatement, [domain_id], function (err, rows, fields) {
				if (err) { throw err; }

				console.log(rows);

				if (rows) {
					callback({ status: 'successful' })
				}
			});

			connectionProvider.mysqlConnectionStringProvider.closeMySqlConnection(connection);
		}
	}
};

module.exports.domainDao = domainDao;