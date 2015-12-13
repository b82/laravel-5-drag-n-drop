<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Input;
use DB;
use App\News; // your Model

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DragndropController extends Controller {

    //
    public function sortNews(){

    	// list new sort - ARRAY of Strings
    	$newOrder = Input::get('newOrder');

    	// Array new order semplified
    	$arrayOrder = array();
    	foreach($newOrder as $order){
    		$sortName = explode('sort_', $order);
    		$arrayOrder[] = $sortName[1];
    	}

    	foreach($arrayOrder as $key => $value){
    		DB::table('news')->where('id', $value)->update(['order_posts' => $key + 1]);
    	}
    }

}
