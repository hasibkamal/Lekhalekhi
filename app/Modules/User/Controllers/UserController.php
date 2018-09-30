<?php

namespace App\Modules\User\Controllers;

use App\Modules\User\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Intervention\Image\ImageManagerStatic as Image;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        $userId = Auth::user()->id;
        $user = User::leftJoin('author_category','author_category.id','=','users.author_category_id')
            ->where('users.id',$userId)
            ->first([
                'users.*',
                'author_category.category_name'
            ]);
        return view("User::profile",compact('user'));
    }


    public function basicInfoSave(Request $request)
    {
        $userId = Auth::user()->id;
        $user = User::find($userId);
        $user->name = $request->get('name');
        $user->designation = $request->get('designation');
        $user->company_name = $request->get('company_name');
        $user->years_of_experience = $request->get('years_of_experience');
        $user->highest_degree = $request->get('highest_degree');
        $userDOB = $request->get('user_dob');
        if(!empty($userDOB))
            $user->user_dob = date('Y-m-d',strtotime($userDOB));

        $user->user_phone = $request->get('user_phone');
        $user->address = $request->get('address');
        $user->user_photo = $request->get('user_photo');
        $path = "uploads/users";
        if ($request->hasFile('user_photo')) {
            $_profileImage = $request->file('user_photo');
            $mime_type = $_profileImage->getClientMimeType();
//                if($mime_type == 'image/jpeg' || $mime_type == 'image/jpg' || $mime_type == 'image/png'){
            if(!in_array($mime_type,['image/jpeg','image/jpg','image/png']))
                return redirect()->back();

            if (!file_exists($path))
                mkdir($path, 0777, true);

            $profileImage = trim(sprintf("%s", uniqid('Profile_', true))) . '.' . $_profileImage->getClientOriginalExtension();

            Image::make($_profileImage->getRealPath())->resize(200, 200)->save($path . '/' . $profileImage);
            $user->user_photo = $profileImage;
        }
        $user->save();

        Session::flash('success','Profile information successfully saved');
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
