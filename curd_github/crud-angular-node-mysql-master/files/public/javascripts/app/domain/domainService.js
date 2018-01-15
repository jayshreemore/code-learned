//domainService
angular.module("domainModule")
.factory("domainService", domainService);

domainService.$inject = ['$http', '$location'];//that can talk to server

function domainService($http, $location) {
	return {
		createDomain : function (domain) {

			return $http.post('/api/createDomain', //api
			{
				domain_name: domain.domain_name,
				hosting: domain.hosting,
				hosting_date: domain.hosting_date,
				expiry_date: domain.expiry_date
			});

		},

		getAllDomain : function() {
			return $http.get('/api/getAllDomain');//api
		},

		getIdFromEndPoint: function() {
			var absoluteUrl = $location.absUrl();
			var segments = absoluteUrl.split("/");
			var domain_id = segments[segments.length - 1];
			return domain_id
		},

		getDomainById: function(domain_id) {
			//console.log(domain_id);
			return $http.get('/api/getDomainById/' + domain_id);//api
		},

		updateDomain : function(domain, domain_id) {
			/*console.log(domain.categoryName);
			console.log(domain.categoryDetails);

			console.log(domain_id);*/

			return $http.post('/api/updateDomain', //api
			{				
				domain_name: domain.domain_name,
				hosting: domain.hosting,
				hosting_date: domain.hosting_date,
				expiry_date: domain.expiry_date,
				
				domain_id: domain_id

			});
		},

		deleteDomainById: function(domain_id) {
			//return $http.delete('/deleteDomainById/' + domain_id);

			return $http['delete']('/api/deleteDomainById/' + domain_id);
		}
	};//return object
}