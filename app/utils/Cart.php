<?php namespace Utils;

class Cart{

     /**
      * This class will handle cart related functions.
      */

     /**
      * Generates the cart row with all the data.
      * @return [type] [description]
      */
     public static function getCart(){
          if(!\Session::has('cartData')) return null;
          $html = '';
          $totalPrice = 0;
          foreach (\Session::get('cartData') as $pid => $quantity) {
               $data = \Product::find($pid)->toArray();
               $data['quantity'] = $quantity;
               $price = $data['price'];
               $sum = $price*$data['quantity'];
               $totalPrice = $totalPrice + $sum;
               $html .= HtmlGenerator::cartItem($data, $sum);
          }
               $html .= HtmlGenerator::cartTotal($totalPrice);
               return $html;
     }
}