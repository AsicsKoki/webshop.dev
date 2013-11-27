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

	public function renderStars($result, $pid, $uid){
        $html = '';
        $id = $productId;
        $userId = $userId;
        $html = '';
        $mark = $result;
        $rest = 5 - $mark;
        for ($i=0; $i < $mark ; $i++) {
                $html .= '<div class="ratings_stars ratings_over" data-productid="'.$id.'" data-userid="'.$uid.'"></div>';
        }
        for ($i=0; $i < $rest; $i++) {
                $html .= '<div class="ratings_stars" data-productid="'.$id.'" data-userid="'.$uid.'"></div>';
        }
        return $html;
}
}