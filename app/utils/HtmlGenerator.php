<?php namespace Utils;

class HtmlGenerator{


	/**
	 * Generates the html for the cart row.
	 * @param  [type] $html [description]
	 * @param  [type] $data [description]
	 * @param  [type] $sum  [description]
	 * @return [type]       [description]
	 */
	public static function cartItem($data, $sum){
		$html = "<tr>";
		$html .= "<td>".$data['name']."</td>";
		$html .= "<td>".$data['quantity']."</td>";
		$html .= "<td>".$data['price']."</td>";
		$html .= "<td><a href=# class='deleteCartEntry btn' data-pid=".$data['id'].">Remove</a></td>";
		$html .= "<td>".$sum."</td>";
		$html .= "</tr>";
		return $html;
	}

	public static function cartTotal($totalPrice){
		$html = "<div><h4>Total price: ".$totalPrice."</h4></div>";
		return $html;
	}

	public static function renderStars($rating, $pid, $uid){
		$htmlStars = '';
		$mark = $rating;
		$rest = 5 - $mark;
		for ($i=0; $i < $mark ; $i++) {
			$htmlStars .= '<div class="ratings_stars ratings_over" data-productid="'.$pid.'" data-userid="'.$uid.'"></div>';
		}
		for ($i=0; $i < $rest; $i++) {
			$htmlStars .= '<div class="ratings_stars" data-productid="'.$pid.'" data-userid="'.$uid.'"></div>';
		}
		return $htmlStars;
	}
	/**
	 * Render the on screen menu when selecting all items for a certian category
	 * @param  [type]  $parentId [description]
	 * @param  integer $level    [description]
	 * @return [type]            [description]
	 */
	public static function renderCategoryMenu($parentId, $level = 0){
		$html = "";
		if($parentId)
			$row = \Category::where('parent_id', $parentId)->get()->toArray();
		else
			$row = \Category::whereNull('parent_id')->get()->toArray();

		foreach($row as $category){
			$currentId = $category['id'];
			$html .= "<li><a href='products/category/".$currentId."'>";
			$html .= str_repeat(" - ", $level);
			$html .= $category['name']."</a></li>";
			$html .= HtmlGenerator::renderCategoryMenu($currentId, $level+1);
		}
		return $html;
	}

	public static function generateComment($text){
		$html = '';
		$html .= '<div class="commentBox well">
			<header class="com_header">
			Posted by you
			</header>'.$text.'</div>';
		return $html;
	}
	public static function renderCategorySelection($parentId, $level = 0, $productId = NULL){
		$html = "";

		if($parentId)
			$row = \Category::where('parent_id', $parentId)->get();
		else
			$row = \Category::whereNull('parent_id')->get();

		foreach($row as $category){
			$checked = '';
			if ($productId)
				$checked = $category->products()->where('product_id', $productId)->count() ? "checked = checked": "";

			$currentId = $category->id;
			$html .= "<li><input type='checkbox'".$checked." name='category[]' class='categoryCheck' data-productId=".$productId." data-categoryId=".$currentId." value=".$currentId.">";
			// $html .= str_repeat(" - ", $level);
			$html .= "<span style='margin-left:".($level*15)."px;'>".$category->name."</span></li>";

			$html .= static::renderCategorySelection($currentId, $level + 1, $productId);
		}
		return $html;
	}
}