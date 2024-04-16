<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Slider;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Mail;
use App\Models\Product;
session_start();

class HomeController extends Controller
{
    // public function send_mail(){
    //     //send mail
    //            $to_name = "EShopper";
    //            $to_email = "vinhhlk.21ad@vku.udn.vn";//send to this email
              
            
    //            $data = array("name"=>"Mail từ tài khoản Khách hàng","body"=>'Đặt hàng thành công'); //body of mail.blade.php
               
    //            Mail::send('pages.send_mail',$data,function($message) use ($to_name,$to_email){

    //                $message->to($to_email)->subject('Giao hàng thành công');//send this mail with subject
    //                $message->from($to_email,$to_name);//send from this mail
    //            });
    //            // return redirect('/')->with('message','');
    //            //--send mail
    // }
    public function index(Request $request) {
        //slide
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();

        // Seo
            $meta_desc ="Mua laptop giá rẻ, máy tính xách tay chính hãng 100%, luôn cập nhật mẫu mới. Bảo hành hậu mãi chu đáo, trả góp 0%, miễn phí giao hàng, đổi trả linh hoạt.";
            $meta_keywords ="HỆ THỐNG LAPTOP XACH TAY";
            $meta_title ="Laptop | Máy tính xách tay - Giá rẻ, trả góp 0%, có thu cũ";
            $url_canonical=$request->url();
        // Seo
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderBy('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderBy('brand_id','desc')->get();

        // $all_product = DB::table('tbl_product')
        // ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        // ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')->orderBy('tbl_product.product_id', 'desc')->get();

        $all_product = DB::table('tbl_product')->where('product_status','1')->orderBy('product_sold','DESC')->paginate(6);
        return view('pages.home')->with('category', $cate_product)->with('brand', $brand_product)->with('all_product', $all_product)
        ->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('slider',$slider);
    }
    public function search(Request $request){
        //slide
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','1')->take(4)->get();
        //seo 
        $meta_desc = "Tìm kiếm sản phẩm"; 
        $meta_keywords = "Tìm kiếm sản phẩm";
        $meta_title = "Tìm kiếm sản phẩm";
        $url_canonical = $request->url();
        //--seo
        $keywords = $request -> keywords_submit;
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderBy('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderBy('brand_id','desc')->get();

        

        $search_product = Product::join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')->where('product_name','like','%'.$keywords.'%')
        ->orWhere('product_price','like','%'.$keywords.'%')->orWhere('brand_name','like','%'.$keywords.'%')->get();
        return view('pages.sanpham.search')->with('category', $cate_product)->with('brand', $brand_product)->with('search_product', $search_product)
        ->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('slider',$slider);
    }
}
