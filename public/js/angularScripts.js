var app = angular.module('webshop', []);

	app.controller('commentAreaController', function ($scope, $http){
		var productId = $('div#data').data('productid');
		var roleId = $('div#data').data('userrole');
		var userId = $('div#data').data('userid');

		$scope.loading = true;
		$http.get('http://webshop.dev/products/'+productId+'/comments').success(function(data){
				$scope.comments = data.comments;
			}).then(function(data) {
				$scope.loading = false;
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
	})
	.controller('profileController', function ($scope, $http){
		var roleId = $('div#data').data('userrole');
		var userId = $('div#data').data('userid');
		$http.get('http://webshop.dev/profile/'+userId+'/profileJson').success(function(data){
			$scope.user = data;
		});

		$scope.userId = userId;
		$scope.roleId = roleId;
		$scope.deleteComment = function(comment){
		$http.delete('http://webshop.dev/profile/deleteComment/'+comment.id).success(function(data){
			$scope.comments.splice( $scope.comments.indexOf(comment), 1 );
			});
		}

		$scope.deleteProduct = function(product){
		$http.delete('http://webshop.dev/profile/deleteProduct/'+product.id).success(function(data){
			$scope.user.products.splice( $scope.user.products.indexOf(product), 1 );
			});
		}

		$scope.submitReview = function(reviewForm, reviewText){
			var review = {
				user_id: userId,
				review: reviewText,
			};
			if (reviewForm.$valid){
			$http.post('http://webshop.dev/profile/postReview', review).success(function(review){
				$scope.user.reviews.push(review);
			})
		}}

		$scope.deleteReview = function(review){
		$http.delete('http://webshop.dev/profile/deleteReview/'+review.id).success(function(data){
			$scope.reviews.splice( $scope.reviews.indexOf(review), 1 );
			});
		}
	})
	.controller('contactController', function ($scope, $http){
		$scope.submitted = false;
		$scope.mail = {};
		$scope.sendMail = function() {
			if($scope.emailForm.$valid){
				$http({
					method : 'POST',
					url : 'http://webshop.dev/contact/sendEmail',
					data : $scope.mail
				})
			} else {
				$scope.emailForm.submitted = true;
			}
		}
	})
	.controller('creditCardController', function ($scope, $http){
		$scope.submitted = false;
		$scope.creditCardForm = {};
		$scope.checkout = function() {
			if($scope.creditCardForm.$valid){
				$http({
					method : 'POST',
					url : 'cart/create',
					data : $scope.creditCardForm
				})
			} else {
				$scope.creditCardForm.submitted = true;
			}
		}
	})
	.controller('orderController', function ($scope, $http){
		var userId = $('div#data').data('userid');
		$scope.loading = true;
		$http.get('http://webshop.dev/cart/history/'+userId).success(function(data){
				$scope.sales = data;
			}).then(function(data) {
				$scope.loading = false;
			});

		$scope.showDetails = function(paypal_id){
			$http.get('http://webshop.dev/cart/history/'+paypal_id).success(function(data){
				$scope.saleData = data;
			});
		}
	})