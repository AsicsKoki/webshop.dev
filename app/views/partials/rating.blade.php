<div id="r1" class="rate_widget">
	{{ \Utils\HtmlGenerator::renderStars($product->calculateRating(), $product->id, $product->user->id) }}
</div>