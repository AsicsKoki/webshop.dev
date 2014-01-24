//This controller belongs to the comment area on product view page, and handeles comment rendering and utilities.
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
	$scope.hasLiked = function(likes){
		return likes.filter(function(like){
			return like.user_id == userId;
		}).length;
	}
	$scope.like = function(comment){
		$http.put('http://webshop.dev/products/postLike/'+comment.id).success(function(data){
			comment.likes.push(data);
		})
	}

	$scope.unLike = function(comment){
		$http.delete('http://webshop.dev/products/unLike/'+comment.id).success(function(data){
				comment.likes = comment.likes.filter(function(like){
					return like.user_id != userId;
			})
		});
	}
}
//This controller belongs to the profile page.
function profileController($scope, $http){
	var userId = $('div#data').data('userid');
	$http.get('http://webshop.dev/profile/'+userId+'/profileJson').success(function(data){
		$scope.user = data;
	});
}