<?php

namespace App\Modules\AuthorCategory\Controllers;

use App\Libraries\Encryption;
use App\Modules\AuthorCategory\Models\AuthorCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Session;
use yajra\Datatables\Datatables;

class AuthorCategoryController extends Controller
{
    public function categoryCreate(){
        return view("AuthorCategory::create");
    }

    public function categoryStore(Request $request){

        $this->validate($request, [
            'category_name' => 'required|max:100',
            'status' => 'required',
            'feature_image' => 'required'
        ]);
        $authorCategory = new AuthorCategory();
        $authorCategory->category_name = $request->get('category_name');
        $authorCategory->status = $request->get('status');

            $_featureImage = $request->file('feature_image');
            $path = "uploads/category";
            if ($request->hasFile('feature_image')) {
                $mime_type = $_featureImage->getClientMimeType();
//                if($mime_type == 'image/jpeg' || $mime_type == 'image/jpg' || $mime_type == 'image/png'){
                if(!in_array($mime_type,['image/jpeg','image/jpg','image/png']))
                    return redirect()->back();

                if (!file_exists($path))
                    mkdir($path, 0777, true);

                $featureImage = trim(sprintf("%s", uniqid('LekhaLekhi_', true))) . '.' . $_featureImage->getClientOriginalExtension();

                Image::make($_featureImage->getRealPath())->resize(300, 250)->save($path . '/' . $featureImage);
                $authorCategory->feature_image = $featureImage;
            }
            
        $authorCategory->save();
        Session::flash('success','Category successfully stored');
        return redirect('author-category/list');
    }

    public function categoryList(){
        return view('AuthorCategory::list');
    }

    public function getCategoryList(){
        $authorCategory = AuthorCategory::orderBy('category_name','asc')->get(['id', 'category_name','status', 'feature_image', 'menu_status']);

        return Datatables::of($authorCategory)
//            ->editColumn('serial', function () {
//                return '';
//            })
//
//            ->editColumn('menu_status', function ($data) {
//                if ($data->menu_status == 1) {
//                    return '<span class="label label-info">Active</span>';
//                }
//                return '<span class="label label-danger">Inactive</span>';
//            })
//            ->editColumn('status', function ($data) {
//                if ($data->status == 1) {
//                    return '<span class="label label-primary">Active</span>';
//                }
//                return '<span class="label label-danger">Inactive</span>';
//            })
            ->addColumn('action', function ($data) {
                return $data->id;
//                $str = '';
//                $str .= '<a href="/author-category/open/' . Encryption::encodeId($data->id) . '" class="btn btn-primary btn-xs"><i class="fa fa-folder-open"></i> Open</a>';
//                return $str;
            })
//            ->rawColumns(['menu_status', 'status', 'action'])
            ->make(true);
    }

    public function categoryEdit($categoryId){
        dd($categoryId);
    }
}
