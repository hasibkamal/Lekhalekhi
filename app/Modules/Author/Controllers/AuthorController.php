<?php

namespace App\Modules\Author\Controllers;

use App\Libraries\ACL;
use App\Libraries\Encryption;
use App\Modules\AuthorCategory\Models\AuthorCategory;
use App\Modules\User\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
                $str .= '<a href="/author/open/' . Encryption::encodeId($data->id) . '" class="btn btn-primary btn-sm"><i class="fa fa-folder-open"></i> Open</a> ';
                $str .= '<a href="/author/edit/' . Encryption::encodeId($data->id) . '" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> Edit</a> ';
                $str .= '<a onclick="return confirm(\'Are you sure?\')" href="/author-category/delete/' . Encryption::encodeId($data->id) . '" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</a>';
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

    public function authorStore(Request $request)
    {
        if(!ACL::getAccessRight('Author', '-A-'))
            die('You have no access right! Please contact with system admin');

        $this->validate($request, [
            'user_email' => 'required|unique:users',
            'author_name' => 'required',
            'author_category_id' => 'required',
            'designation' => 'required'
        ]);

        $author = new User();
        $author->user_type = '3x303';
        $author->name = $request->get('author_name');
        $author->author_category_id = $request->get('author_category_id');
        $author->user_email = $request->get('user_email');
        $author->designation = $request->get('designation');
        $author->save();
        Session::flash('success','Author saved successfully');
        return redirect('author/list');
    }


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
