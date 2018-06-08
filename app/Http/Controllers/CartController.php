<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AddCartRequest;

class CartController extends Controller
{
    public function add(AddCartRequest $request)
    {
        $key = 'sku_'.$request->input('sku_id');
        // 从用户请求中取出数量
        $amount = $request->input('amount');
        // 从 session 中取出购物车数据，如果没有则返回空数组
        $cart = $request->session()->get('cart', []);
        // 如果购物车中目前没有这个商品，则初始化
        if (!isset($cart[$key])) {
            $cart[$key] = 0;
        }
        // 购物车中该商品数量加上用户提交的数量
        $cart[$key] += $amount;
        // 存回 session
        $request->session()->put('cart', $cart);

        return [];
    }
}
