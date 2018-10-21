<?php

namespace App\Modules\User\Controllers;

use App\Modules\User\Models\EduInfo;
use App\Modules\User\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

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

       $path = "uploads/users";
       if($request->hasFile('user_photo')){
           $_profileImage = $request->file('user_photo');
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
       return redirect('user/profile#basicInfo');

    }

    public function eduInfoSave(Request $request)
    {
        $userId = Auth::user()->id;
        $data = $request->all();
        $eduInfoIds = [];
        foreach($data['institute'] as $key => $institute){
            $eduInfo = new EduInfo;
            $eduInfo->user_id = Auth::user()->id;
            $eduInfo->institute = (isset($data['institute'][$key]))?$data['institute'][$key]:'';
            $eduInfo->degree = (isset($data['degree'][$key]))?$data['degree'][$key]:'';
            $eduInfo->passing_year = (isset($data['pass_year'][$key]))?$data['pass_year'][$key]:'';
            $eduInfo->cgpa = (isset($data['cgpa'][$key]))?$data['cgpa'][$key]:'';
            $eduInfo->out_of = (isset($data['out_of'][$key]))?$data['out_of'][$key]:'';
            $eduInfo->save();
            $eduInfoIds[] = $eduInfo->id;
        }

        if(!empty($eduInfoIds)){
            EduInfo::where('user_id',$userId)->whereNotIn('id',$eduInfoIds)->delete();
        }

        Session::flash('success','Educational Information successfully saved.');

        return redirect('user/profile#eduInfo');
    }

    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required'
        ]);

        $userId = Auth::user()->id;
        $user = User::find($userId);

        $oldPassword = $request->get('old_password');
        $newPassword = $request->get('new_password');
        $confirmPassword = $request->get('confirm_password');

        if(!(Hash::check($oldPassword,$user->pasword))){
            Session::flash('error','Old password does not matched');
            return redirect()->back();
        }

        if($newPassword != $confirmPassword){
            Session::flash('error','Confirm password does not matched');
            return redirect()->back();
        }

        $generatedPassword = Hash::make($newPassword);
        $user->password = $generatedPassword;
        $user->save();
        Session::flash('success','Password successfully updated.');
        return redirect()->back();
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
