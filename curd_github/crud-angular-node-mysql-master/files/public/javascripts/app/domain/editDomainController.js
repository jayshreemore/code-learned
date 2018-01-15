//copy
angular.module("domainModule")
.controller("editDomainController", editDomainController);

editDomainController.$inject = ['$scope', '$timeout', '$filter', 'domainService', 'requiredFieldValidationService']; //inject three service and $timeout angular js ...

function editDomainController($scope, $timeout, $filter, domainService, requiredFieldValidationService) { //inject
	// alert('edit-test');//works
	$scope.domainEdit = {
		domain_name : "",
		hosting : "",
		hosting_date : "",
		expiry_date : ""
	};

	getDomainById();

	$scope.ValidationResult = {
		/*containsValidationError : false,
		ValidationSummary: ""*/
	}

	$scope.message = {
		/*containsSuccessfulMessage: false,
		successfulMessage: ""*/
	};

	function displayMessage() {
		/*$scope.message.containsSuccessfulMessage = true;
		$scope.message.successfulMessage = "A Record updated successfully";*/
	}

	function bindView(domain) {
		$scope.domainEdit.domain_name = domain.domain_name;
		$scope.domainEdit.hosting = domain.hosting;
		// $scope.domainView.hosting_date = domain.hosting_date;
		$scope.domainEdit.hosting_date = $filter('date')(domain.hosting_date, 'yyyy-MM-dd');
		//$scope.domainView.expiry_date = domain.expiry_date;
		$scope.domainEdit.expiry_date = $filter('date')(domain.expiry_date, 'yyyy-MM-dd');
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

	$scope.editDomain = function () {
		// alert('clicked on edit');//works
		//console.log('scope-'+$scope.domainEdit.categoryName+$scope.domainEdit.categoryDetails);//What yout type to edit: NodeServerSide - works

		domainService.updateDomain($scope.domainEdit, domainService.getIdFromEndPoint())
			.success(function (data) {
				if(data 
					&& data.status 
					&& data.status == 'succesful') {
					displayMessage();
				}

				window.location.href="/viewDomain";
			});

	}
}