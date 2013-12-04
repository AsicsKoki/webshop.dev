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
}