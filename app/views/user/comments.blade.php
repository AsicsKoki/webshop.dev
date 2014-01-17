<!doctype html>
<html ng-app >
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.9/angular.min.js"></script>
	{{ HTML::script('js/angularScripts.js') }}
	<title>Comments</title>
</head>
<body ng-controller="commentController">
	<h1>Comments</h1>
	<div ng-include="tpl='{{URL::to('/')}}/templates/partials/comments.html'">
	Loading
	</div>
</body>
</html>