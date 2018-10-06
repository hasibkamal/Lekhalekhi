<?php

namespace App\Modules\User\Controllers;

use App\Modules\User\Models\EduInfo;
use App\Modules\User\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function profile()
    {
       $userId = Auth::user()->id;
       $user = User::leftJoin('author_category','author_category.id','=','users.author_category_id')
           ->where('users.id', $userId)
           ->first([
               'users.*',
               'author_category.category_name'
           ]);

       $eduInfo = EduInfo::where('user_id',$userId)->get();
       return view('User::profile', compact('user','eduInfo'));
    }

    /*$userId = Auth::user()->id;
    $user = User::leftJoin('author_category','author_category.id','=','users.author_category_id')
    ->where('users.id',$userId)
    ->first([
    'users.*',
    'author_category.category_name'
    ]);
    return view("User::profile",compact('user'));
     */
    public function basicInfoSave(Request $request)
    {
       $userId = Auth::user()->id;
       $user = User::find($userId);

       $user->name = $request->get('name');
       $user->designation = $request->get('designation');
       $user->company_name = $request->get('company_name');
       $user->years_of_experience = $request->get('years_of_experience');
       $user->user_photo = $request->get('user_photo');
       $user->highest_degree = $request->get('highest_degree');
       $userDOB= $request->get('user_dob');
	   
       if(!empty($userDOB))
           $user->user_dob = date('Y-m-d', strtotime($userDOB));
       $user->user_phone = $request->get('user_phone');
       $user->address = $request->get('address');

       $path = "uploads/user";
       if($request->hasFile('user_image')){
           $_profileImage = $request->file('user_image');
           $mimeType = $_profileImage->getClientMimeType();
           if(!in_array($mimeType,['image/jpg', 'image/jpeg', 'image/png']))
               return redirect()->back();
           if(!file_exists($path))
               mkdir($path, 0777, true);

           $profileImage = trim(sprintf('%s', uniqid('Profile_', true))) . '.' . $_profileImage->getClientOriginalExtension();
           Image::make($_profileImage->getRealPath())->resize(300,250)->save($path . '/' . $profileImage);
           $user->user_photo = $profileImage;
       }

       $user->save();
        Session::flash('success','Profile information successfully saved.');
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
