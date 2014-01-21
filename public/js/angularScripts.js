function commentAreaController($scope, $http){
	var productId = $('div#data').data('productid');
	var roleId = $('div#data').data('userrole');
	var userId = $('div#data').data('userid');

	$http.get('http://webshop.dev/products/'+productId+'/comments').success(function(data){
			$scope.comments = data.comments;
		});

	$scope.roleid = roleId;

	$scope.deleteComment = function(comment){
		$http.delete('http://webshop.dev/products/deleteComment/'+comment.id).success(function(data){
			$scope.comments.splice( $scope.comments.indexOf(comment), 1 );
		});
	$scope.userId = userId;
	}

	$scope.like = function(comment){
		$http.put('postLike/'+comment.id).success(function(data){
			$scope.comments.comment.push(data);
		})
	}
}