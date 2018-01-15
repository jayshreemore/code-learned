angular.module("domainModule")
.factory("requiredFieldValidationService", requiredFieldValidationService);

function requiredFieldValidationService() {
	function _getRequiredValidationMessage(requiredInfos) {
		var errorMessages = [];
		if(requiredInfos.length > 0) {
			angular.forEach(requiredInfos, function (requiredInfos) {
				if(
					requiredInfos.name !== 'undefined'

					&&

					(
						requiredInfos.name === null
						|| requiredInfos.name == ''
						|| requiredInfos.name.length == 0)
					) {
					errorMessages.push(requiredInfos.errorMessages);
				}
			});
		}
		return errorMessages;
	}

	return {
		getRequiredFieldValidationErrorMessage : _getRequiredValidationMessage
	};
}