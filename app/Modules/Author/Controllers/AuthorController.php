<?php

namespace App\Modules\Author\Controllers;

use App\Libraries\ACL;
use App\Libraries\CommonFunction;
use App\Libraries\Encryption;
use App\Modules\AuthorCategory\Models\AuthorCategory;
use App\Modules\User\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use yajra\Datatables\Datatables;

class AuthorController extends Controller
{
    public function authorList(){
        if(!ACL::getAccessRight('Author', '-V-'))
            die('You have no access right! Please contact with system admin');

        return view('Author::list');
    }

    public function getAuthorList(){
        if(!ACL::getAccessRight('Author', '-V-'))
            die('You have no access right! Please contact with system admin');

        $author = User::leftJoin('author_category as ac','ac.id','=','users.author_category_id')
            ->orderBy('users.author_category_id','asc')
            ->where('users.user_type','3x303')
            ->get([
                'users.id',
                'ac.category_name',
                'users.user_email',
                'users.designation',
                'users.name as author_name'
            ]);

        return Datatables::of($author)
            ->addColumn('serial', function () {
                return '';
            })
            ->addColumn('action', function ($data) {
                $str = '';
                $str .= '<a href="/author/open/' . Encryption::encodeId($data->id) . '" class="btn btn-primary btn-sm"> <i class="fa fa-folder-open"></i> Open</a> ';
                $str .= '<a href="/author/edit/' . Encryption::encodeId($data->id) . '" class="btn btn-info btn-sm"> <i class="fa fa-edit"></i> Edit</a> ';
                $str .= '<a onclick="return confirm(\'Are you sure?\')" href="/author/delete/' . Encryption::encodeId($data->id) . '" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> Delete</a>';
                return $str;
            })
//            ->rawColumns(['menu_status', 'status', 'action'])
            ->make(true);
    }

    public function authorCreate(){
        if(!ACL::getAccessRight('Author', '-A-'))
            die('You have no access right! Please contact with system admin');

        $authorCategories = AuthorCategory::where('status',1)->lists('category_name','id');
        return view("Author::create",compact('authorCategories'));
    }

    public function authorStore(Request $request, $authorId ='')
    {
        if(!ACL::getAccessRight('Author', '-A-'))
            die('You have no access right! Please contact with system admin');

        $rules = [
            'author_name' => 'required',
            'author_category_id' => 'required',
            'designation' => 'required',
            'user_email' => 'required'
        ];

        if(!empty($authorId)){
            $decodedAuthorId = Encryption::decodeId($authorId);
            $author = User::find($decodedAuthorId);
        }else{
            $author = new User();
            $rules = [
                'user_email' => 'required|unique:users'
            ];
        }

        $this->validate($request,$rules);
        $author->user_type = '3x303';
        $author->name = $request->get('author_name');
        $author->author_category_id = $request->get('author_category_id');
        $author->user_email = $request->get('user_email');
        $author->designation = $request->get('designation');
        $random_password = $this->quickRandom(8);
        $author->password =  Hash::make($random_password);
        $author->save();

        if(empty($authorId)){
            $bodyMsg = "Hi, <br/> Welcome to Lekhalekhi.
            <br/>Your account is successfully created in our system.
            <br/> Your password is : <b>$random_password</b>.";
            $params = array(
                'emailBody' => $bodyMsg,
                'emailSubject' => 'Lekhalekhi account information',
                'emailHeader' => 'Lekhalekhi',
                'emailAdd' => $author->user_email
            );
            $this->sendEmailFromSystem($params);
            Session::flash('success', 'Author created successfully');
        }else{
            Session::flash('success', 'Author updated successfully');
        }

        return redirect('/author/list');
    }


    public function quickRandom($length = 16)
    {
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
    }


    public function sendEmailFromSystem($param){
        $emailBody = $param['emailBody'] ==''? '' :$param['emailBody'] ;
        $emailHeader = $param['emailHeader'] ==''? '0' :$param['emailHeader'] ;
        $emailAdd = $param['emailAdd']==''? CommonFunction::auditEmail() :$param['emailAdd'];
        $emailSubject = $param['emailSubject']==''? '' :$param['emailSubject'];
        $body_msg = '<span style="color:#000;text-align:justify;"><b>';
        $body_msg .= $emailBody;
        $body_msg .= '</span>';
        $data = array(
            'header' => $emailHeader,
            'param' => $body_msg
        );
        \Mail::send('email-template', $data, function ($message) use ($emailAdd,$emailSubject,$emailHeader) {
            $message->from('beza.ocpl@gmail.com', $emailHeader)
                ->to($emailAdd)
                ->subject($emailSubject);
        });
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function authorDelete($authorId)
    {
        $decodedAuthorId = Encryption::decodeId($authorId);
        User::where('id',$decodedAuthorId)->delete();
        Session::flash('success','Author deleted successfully.');
        return redirect()->back();
    }

    public function authorEdit($authorId)
    {
        if(!ACL::getAccessRight('Author', '-E-'))
            die('You have no access right! Please contact with system admin');

        $decodedAuthorId = Encryption::decodeId($authorId);
        $authorCategories = AuthorCategory::where('status',1)->lists('category_name','id');
        $author = User::find($decodedAuthorId);
        $viewMode = 'edit';
        return view("Author::edit",compact('author','authorCategories','viewMode'));
    }

    public function authorOpen($authorId)
    {
        if(!ACL::getAccessRight('Author', '-V-'))
            die('You have no access right! Please contact with system admin');

        $decodedAuthorId = Encryption::decodeId($authorId);
        $authorCategories = AuthorCategory::where('status',1)->lists('category_name','id');
        $author = User::find($decodedAuthorId);
        $viewMode = 'open';
        return view("Author::edit",compact('author','authorCategories','viewMode'));
    }
}
