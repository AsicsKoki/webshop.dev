<?php namespace Utils;

class Cart{

    public static function getCart(){
          if(!\Session::has('cartData')) return null;
          $html = '';
          foreach (\Session::get('cartData') as $pid => $quantity) {
               $data = \Product::find($pid)->toArray();
               $data['quantity'] = $quantity;
               $totalPrice = 0;
               $price = $data['price'];
               $sum = $price*$data['quantity'];
               $totalPrice = $totalPrice + $sum;
               $html .= HtmlGenerator::cartItem($html,$data, $sum);
          }
               $html .= HtmlGenerator::cartTotal($totalPrice);
               return $html;
     }
}