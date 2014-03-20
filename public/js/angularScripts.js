var app = angular.module('webshop', []);
	app.factory('shopApi', function($http) {
		return{

			/*Payment*/
			getHistory: function(userId){
				return $http.get('http://webshop.dev/cart/history/'+userId);
			},
			getHistoryDetails: function(paypal_id){
				return $http.get('http://webshop.dev/cart/history/'+paypal_id);
			}

			/*Comments*/
			getComments: function(productId){
				return $http.get('http://webshop.dev/products/'+productId+'/comments');
			},
			deleteComment: function(commentId){
				return $http.delete('http://webshop.dev/products/deleteComment/'+commentId);
			},
			like: function(commentId){
				return $http.put('http://webshop.dev/products/postLike/'+commentId);
			},
			unLike: function(commentId){
				return $http.delete('http://webshop.dev/products/unLike/'+commentId);
			},

			/*Profile*/
			getProfile: function(userId){
				return $http.get('http://webshop.dev/profile/'+userId+'/profileJson');
			},
			deleteComment: function(commentId){
				return $http.delete('http://webshop.dev/profile/deleteComment/'+commentId);
			},
			deleteProduct: function(productId){
				return $http.delete('http://webshop.dev/profile/deleteProduct/'+productId);
			},
			submitReview: function(review){
				return $http.post('http://webshop.dev/profile/postReview', review);
			},
			deleteReview: function(){
				return $http.delete('http://webshop.dev/profile/deleteReview/'+reviewId);
			},
			/*Mailing*/
			sendMail: function(mail){
				$http({
					method : 'POST',
					url : 'http://webshop.dev/contact/sendEmail',
					data : mail
				})
			},
			checkout: function(data){
				$http({
					method : 'POST',
					url : 'cart/create',
					data : data
				})
			}
		}
	});

	app.controller('commentAreaController', function ($scope, shopApi){
		var productId = $('div#data').data('productid');
		var roleId = $('div#data').data('userrole');
		var userId = $('div#data').data('userid');

		$scope.loading = true;
		shopApi.getComments(productId).success(function(data){
				$scope.comments = data.comments;
			}).then(function(data) {
				$scope.loading = false;
			});

		$scope.roleid = roleId;
		$scope.deleteComment = function(comment){
			shopApi.deleteComment(comment.id).success(function(data){
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
			shopApi.like(comment.id).success(function(data){
				comment.likes.push(data);
			})
		}

		$scope.unLike = function(comment){
			shopApi.unLike(comment.id).success(function(data){
					comment.likes = comment.likes.filter(function(like){
						return like.user_id != userId;
				})
			});
		}
	})
	.controller('profileController', function ($scope, shopApi){
		var roleId = $('div#data').data('userrole');
		var userId = $('div#data').data('userid');
		shopApi.getProfile(userId).success(function(data){
			$scope.user = data;
		});

		$scope.userId = userId;
		$scope.roleId = roleId;
		$scope.deleteComment = function(comment){
		shopApi.deleteComment(comment.id).success(function(data){
			$scope.comments.splice( $scope.comments.indexOf(comment), 1 );
			});
		}

		$scope.deleteProduct = function(product){
		shopApi.deleteProduct(product.id).success(function(data){
			$scope.user.products.splice( $scope.user.products.indexOf(product), 1 );
			});
		}

		$scope.submitReview = function(reviewForm, reviewText){
			var review = {
				user_id: userId,
				review: reviewText,
			};
			if (reviewForm.$valid){
			shopApi.submitReview(review).success(function(review){
				$scope.user.reviews.push(review);
			})
		}}

		$scope.deleteReview = function(review){
		shopApi.deleteReview(review.id).success(function(data){
			$scope.reviews.splice( $scope.reviews.indexOf(review), 1 );
			});
		}
	})
	.controller('contactController', function ($scope, shopApi){
		$scope.submitted = false;
		$scope.mail = {};
		$scope.sendMail = function() {
			if($scope.emailForm.$valid){
				shopApi.sendMail($scope.mail);
			} else {
				$scope.emailForm.submitted = true;
			}
		}
	})
	.controller('creditCardController', function ($scope, shopApi){
		$scope.submitted = false;
		$scope.creditCardForm = {};
		$scope.checkout = function() {
			if($scope.creditCardForm.$valid){
				shopApi.checkout($scope.creditCardForm);
			} else {
				$scope.creditCardForm.submitted = true;
			}
		}
	})
	.controller('orderController', function ($scope, shopApi){
		var userId = $('div#data').data('userid');
		$scope.loading = true;
		shopApi.getHistory(userId).success(function(data){
				$scope.sales = data;
			}).always(function(data) {
				$scope.loading = false;
			});

		$scope.showDetails = function(paypal_id){
			shopApi.getHistoryDetails(paypal_id).success(function(data){
				$scope.saleData = data;
			});
		}
	})