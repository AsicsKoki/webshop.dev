<?php namespace Utils;

class RatingUtils{


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

	function calculateRating($pid){
        global $conn;
        $sql = "SELECT rating FROM product_ratings WHERE product_id = $productId";
        $retval = mysql_query($sql, $conn);
        $rows = mysql_num_rows($retval);
        if ($rows != 0){
                $ratings = mysql_fetch_array($retval);
                $resault = array_sum($ratings) / count(array_filter($ratings));
                return $resault;
        } else {
                $resault = 0;
                return $resault;
        }
}
}