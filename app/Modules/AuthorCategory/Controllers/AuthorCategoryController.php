<?php

namespace App\Modules\AuthorCategory\Controllers;

use App\Libraries\ACL;
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
        if(!ACL::getAccessRight('AuthorCategory', '-A-'))
            die('You have no access right! Please contact with system admin');
        return view("AuthorCategory::create");
    }

    public function categoryStore(Request $request, $categoryId=''){
        if(!ACL::getAccessRight('AuthorCategory', '-A-'))
            die('You have no access right! Please contact with system admin');
        $this->validate($request, [
            'category_name' => 'required|max:100',
            'status' => 'required',
            'feature_image' => 'required'
        ]);

        if(!empty($categoryId)){
            $decodedCategoryId = Encryption::decodeId($categoryId);
            $authorCategory = AuthorCategory::find($decodedCategoryId);
        }else{
            $authorCategory = new AuthorCategory();
        }

        $authorCategory->category_name = $request->get('category_name');
        $authorCategory->status = $request->get('status');
        $authorCategory->feature_image = $request->get('feature_image');

            $path = "uploads/category";
            if ($request->hasFile('feature_image')) {
                $_featureImage = $request->file('feature_image');
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

        $message = 'Category successfully saved';
        if(!empty($categoryId))
            $message = 'Category successfully updated';

        Session::flash('success',$message);

        return redirect('author-category/list');
    }

    public function categoryList(){
        if(!ACL::getAccessRight('AuthorCategory', '-V-'))
            die('You have no access right! Please contact with system admin');

        return view('AuthorCategory::list');
    }

    public function getCategoryList(){
        if(!ACL::getAccessRight('AuthorCategory', '-V-'))
            die('You have no access right! Please contact with system admin');

        $authorCategory = AuthorCategory::orderBy('category_name','asc')->get(['id', 'category_name','status', 'feature_image', 'menu_status']);

        return Datatables::of($authorCategory)
            ->addColumn('serial', function () {
                return '';
            })

            ->editColumn('menu_status', function ($data) {
                if ($data->menu_status == 1) {
                    return '<span class="btn btn-info btn-sm">Active</span>';
                }
                return '<span class="btn btn-danger btn-sm">Inactive</span>';
            })
            ->editColumn('status', function ($data) {
                if ($data->status == 1) {
                    return '<span class="btn btn-info btn-sm">Active</span>';
                }
                return '<span class="btn btn-danger btn-sm">Inactive</span>';
            })
            ->addColumn('action', function ($data) {
                $str = '';
                $str .= '<a href="/author-category/open/' . Encryption::encodeId($data->id) . '" class="btn btn-primary btn-sm"><i class="fa fa-folder-open"></i> Open</a> ';
                $str .= '<a href="/author-category/edit/' . Encryption::encodeId($data->id) . '" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> Edit</a> ';
                $str .= '<a onclick="return confirm(\'Are you sure?\')" href="/author-category/delete/' . Encryption::encodeId($data->id) . '" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</a>';
                return $str;
            })
//            ->rawColumns(['menu_status', 'status', 'action'])
            ->make(true);
    }

    public function categoryDelete($categoryId){
        if(!ACL::getAccessRight('AuthorCategory', '-D-'))
            die('You have no access right! Please contact with system admin');

        $decodedId = Encryption::decodeId($categoryId);
        AuthorCategory::where('id',$decodedId)->delete();
        Session::flash('success','Category has been deleted successfully');
        return redirect()->back();
    }

    public function categoryEdit($categoryId){
        if(!ACL::getAccessRight('AuthorCategory', '-E-'))
            die('You have no access right! Please contact with system admin');

        $decodedCategoryId = Encryption::decodeId($categoryId);
        $authorCategory = AuthorCategory::find($decodedCategoryId);
        $viewMode = 'edit';
        return view('AuthorCategory::edit',compact('authorCategory','viewMode'));
    }

    public function categoryOpen($categoryId){
        if(!ACL::getAccessRight('AuthorCategory', '-V-'))
            die('You have no access right! Please contact with system admin');

        $decodedCategoryId = Encryption::decodeId($categoryId);
        $authorCategory = AuthorCategory::find($decodedCategoryId);
        $viewMode = 'open';
        return view('AuthorCategory::edit',compact('authorCategory','viewMode'));
    }
}
