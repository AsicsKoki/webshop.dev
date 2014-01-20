//this is a test controller
function commentController($scope, $http){
	$http.get('http://webshop.dev/user/1/comments/rawComments').success(function(data){
		$scope.comments = data;
	});
};
function commentAreaController($scope, $http){
	var productId = $('div#data').data('productid');
	var roleId = $('div#data').data('userrole');
	$http.get('http://webshop.dev/products/'+productId+'/comments').success(function(data){
		$scope.comments = data.comments;
	});
	$scope.roleid = roleId;

	$scope.deleteComment = function(comment){
		var id = comment.id;
		$http.delete('http://webshop.dev/products/deleteComment/'+id).success(function(data){
			$scope.comments.splice( $scope.comments.indexOf(comment), 1 );
		});
	}
}