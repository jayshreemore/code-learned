//copy
angular.module("domainModule")
.controller("domainController", domainController);

//['$scope',, '$timeout', 'domainService'];
domainController.$inject = ['$scope', '$timeout', 'domainService', 'requiredFieldValidationService'];//inject service and $timeout angular js ...

function domainController($scope, $timeout, domainService, requiredFieldValidationService) { //inject
	//alert('create-test');//works now

	$scope.reservedDomain = {
		domain_name: "",
		hosting: "",
		hosting_date: "",
		expiry_date: ""
	};

	$scope.message = {
		containsSuccesfulMessage: false,
		successfulMessage: ""
	};

	$scope.validationResult = {
		containsValidationError: false,
		validationSummary: ""
	};

	function clearDomain() {
		/*$scope.reservedDomain.domain_name = "";
		$scope.reservedDomain.hosting = "";
		$scope.reservedDomain.hosting_date = "";
		$scope.reservedDomain.expiry_date = "";*/
	}

	function ClearMessage() {
		$scope.message.containsSuccesfulMessage = false;
		$scope.message.successfulMessage = "";
	}

	function displayMessage() {
		$scope.message.containsSuccesfulMessage = true;
		$scope.message.successfulMessage = "A Record added successfully";
	}

	$scope.createDomain = function(domain) {
		//inject it here
		// alert('clicked'+domain);

		domainService.createDomain(domain)
			.success(function (data) {
				if(data.status
					&& data.status == 'successful')
					displayMessage();
				$timeout(function afterTimeOut() {
					ClearMessage();
					clearDomain();
				}, 5000);
				
				window.location.href="/viewDomain";
			});
	}
}