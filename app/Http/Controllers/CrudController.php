<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Information;
use App\Countries;
use Session;

class CrudController extends Controller
{
    public function createForm(){
    	$countries = Countries::lists('country_name','country_code');
    	return view('crud.create',compact('countries'));
    }

    public function storeInformation(Request $request){
    	$information = new Information();
    	$information->name = $request->get('name');
    	$information->email = $request->get('email');
    	$information->phone = $request->get('phone');
    	$information->country = $request->get('country');
    	$information->save();
    	Session::flash('success','Informaiton successfully saved');
    	return redirect('crud/list');
    }

    public function getList(){
    	$informations = Information::all();
    	$countries = Countries::lists('country_name','country_code');
    	return view('crud.list',compact('informations','countries'));
    }

    public function editInformation($id){
    	$info = Information::find($id);
    	$countries = Countries::lists('country_name','country_code');
    	return view('crud.edit',compact('info','countries'));
    }

    public function updateInformation(Request $request,$id){
    	$information = Information::find($id);
    	$information->name = $request->get('name');
    	$information->email = $request->get('email');
    	$information->phone = $request->get('phone');
    	$information->country = $request->get('country');
    	$information->save();
    	Session::flash('success','Informaiton successfully updated');
    	return redirect('crud/list');
    }

    public function deleteInformation($id){
    	Information::where('id',$id)->delete();
    	Session::flash('success','Informaiton successfully deleted');
    	return redirect('crud/list');

    }
}
