//copy
angular.module("domainModule")
.controller("viewDomainByIdController", viewDomainByIdController);

viewDomainByIdController.$inject = ['$scope', '$timeout', '$filter', 'domainService', 'requiredFieldValidationService']; //inject three service and $timeout angular js ...

function viewDomainByIdController($scope, $timeout, $filter, domainService, requiredFieldValidationService) { //inject
	// alert('test view'); //works
	$scope.domainView = {
		domain_name : "",
		hosting : "",
		hosting_date : "",
		expiry_date : ""
	};


	getDomainById();

	function bindView(domain) {
		$scope.domainView.domain_name = domain.domain_name;
		$scope.domainView.hosting = domain.hosting;
		// $scope.domainView.hosting_date = domain.hosting_date;
		$scope.domainView.hosting_date = $filter('date')(domain.hosting_date, 'yyyy-MM-dd');
		//$scope.domainView.expiry_date = domain.expiry_date;
		$scope.domainView.expiry_date = $filter('date')(domain.expiry_date, 'yyyy-MM-dd');

		// alert(domain);
		// alert('Name'+domain.domain_name);//Existing: grow.tgg.org.np
		// alert('Detail'+domain.hosting);
		// alert('hosting_date'+domain.hosting_date);
	}

	function getDomainById() {
		domainService.getDomainById(domainService.getIdFromEndPoint()).
		success(function(data) {//fetch the data

			// alert('test'+data);//works

			if (data 
				&& data.domainArr 
				&& data.domainArr.length > 0) {
				
				// alert('test'+data.domainArr[0]);//works - object object
				bindView(data.domainArr[0]);

			}
		})
	}





	$scope.currentDomainId = 0;

	$scope.setCurrentDomainId = function (domain_id) {
		$scope.currentDomainId = domain_id;
	}

	$scope.deleteDomain = function () {
		if($scope.currentDomainId > 0) {
			domainService.deleteDomainById($scope.currentDomainId)
			.success(function (data) {
				if(data && data.status && data.status == 'successful') {
					window.location.href="/viewDomain";
				}
			})
		}
	}

}