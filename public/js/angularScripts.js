//this is a test controller
function commentController($scope, $http){
	$http.get('http://webshop.dev/user/1/comments/rawComments').success(function(data){
		$scope.comments = data;
	});
};
function commentAreaController($scope, $http){
	$http.get('http://webshop.dev/products/37/comments').success(function(data){
		$scope.comments = data;
	});
}