//copy
angular.module("domainModule")
.controller("viewDomainController", viewDomainController);

viewDomainController.$inject = ['$scope', '$timeout', 'domainService']; //inject three service and $timeout angular js ...

function viewDomainController($scope, $timeout, domainService) { //inject
	// alert('test view'); //works
	$scope.domainArr = [];


	
	getAllDomain();

	function getAllDomain() {
		domainService.getAllDomain().
		success(function(data) {//fetch the data
			if (data 
				&& data.domainArr 
				&& data.domainArr.length > 0) {
				
				$scope.domainArr = data.domainArr;//set that property

				//alert($scope.domainArr[0].Id);
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