<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    public function roles_method()
    {
        if (Auth::guest()) {
            return redirect('login');
        } else {
            $roles = DB::table('roles')->get();
            return view('admin/modules/User/roles', ['roles' => $roles]);
        }
    }

    public function insertRole_method(Request $request)
    {
        $checkDuplicateRecord = DB::table('roles')->where('role', $request->role)->first('role');
        if ($checkDuplicateRecord) {

            return redirect('roles')->with('status', 'Duplicate value trying to insert');
        } else {
            $insertRole = DB::insert("insert into roles(role)values(?)", [$request->role]);
            if ($insertRole) {

                return redirect('roles');
            }
        }
    }

    public function checkDuplication_method(Request $request){
        if($request->type=='userType'){
            $duplicate = DB::table('userType')->where('userType',$request->value)->first();
            if($duplicate){
                return "Duplicate";
            }
            else{
                return "Not";
            }
        }
        else if($request->type=='createUserNameCheck'){
            $duplicate = DB::table('users')->where('name',$request->value)->first();
            if($duplicate){
                return "Duplicate";
            }
            else{
                return "Not";
            }
        }
        else if($request->type=='createUserEmailCheck'){
            $duplicate = DB::table('users')->where('email',$request->value)->first();
            if($duplicate){
                return "Duplicate";
            }
            else{
                return "Not";
            }
        }
        else if($request->type=='ZoneNameCheck'){
            $duplicate = DB::table('zones')->where('ZoneName',$request->value)->first();
            if($duplicate){
                return "Duplicate";
            }
            else{
                return "Not";
            }
        }
        else if($request->type=='ZoneCodeCheck'){
            $duplicate = DB::table('zones')->where('ZoneCode',$request->value)->first();
            if($duplicate){
                return "Duplicate";
            }
            else{
                return "Not";
            }
        }
        else if($request->type=='CityNameCheck'){
            $duplicate = DB::table('city')->where('CityName',$request->value)->first();
            if($duplicate){
                return "Duplicate";
            }
            else{
                return "Not";
            }
        }
        else if($request->type=='CityCodeCheck'){
            $duplicate = DB::table('city')->where('CityCode',$request->value)->first();
            if($duplicate){
                return "Duplicate";
            }
            else{
                return "Not";
            }
        }
        else if($request->type=='areaCheck'){
            $duplicate = DB::table('area')->where('Area',$request->value)->first();
            if($duplicate){
                return "Duplicate";
            }
            else{
                return "Not";
            }
        }
        else if($request->type=='companyCheck'){
            $duplicate = DB::table('companies')->where('CompanyName',$request->value)->first();
            if($duplicate){
                return "Duplicate";
            }
            else{
                return "Not";
            }
        }
        else if($request->type=='categoryCheck'){
            $duplicate = DB::table('category')->where('CategoryName',$request->value)->first();
            if($duplicate){
                return "Duplicate";
            }
            else{
                return "Not";
            }
        }
        else if($request->type=='ItemNameCheck'){
            $duplicate = DB::table('items')->where('ItemName',$request->value)->first();
            if($duplicate){
                return "Duplicate";
            }
            else{
                return "Not";
            }
        }
        else if($request->type=='partyTypeCheck'){
            $duplicate = DB::table('partytype')->where('partyType',$request->value)->first();
            if($duplicate){
                return "Duplicate";
            }
            else{
                return "Not";
            }
        }
        else if($request->type=='PartyNameCheck'){
            $duplicate = DB::table('party')->where('PartyName',$request->value)->first();
            if($duplicate){
                return "Duplicate";
            }
            else{
                return "Not";
            }
        }
        else if($request->type=='accountCompanyCheck'){
            $duplicate = DB::table('accountscompany')->where('AccountHead',$request->AccountHeadValue)
            ->where('CompanyName',$request->CompanyNameValue)->first();
            if($duplicate){
                return "Duplicate";
            }
            else{
                return "Not";
            }
        }
        else if($request->type=='userAccountCheck'){
            $duplicate = DB::table('useraccount')->where('UserName',$request->UserName)
            ->where('AccountHead',$request->AccountHead)->first();
            if($duplicate){
                return "Duplicate";
            }
            else{
                return "Not";
            }
        }
        else if($request->type=='accountEmployeeCheck'){
            $duplicate = DB::table('accountsemployee')->where('AccountHead',$request->AccountHeadValue)
            ->where('EmployeeName',$request->EmployeeNameValue)->first();
            if($duplicate){
                return "Duplicate";
            }
            else{
                return "Not";
            }
        }
        else{
            $duplicate = DB::table('roles')->where('role',$request->value)->first();
            if($duplicate){
                return "Duplicate";
            }
            else{
                return "Not";
            }
        }
       
    }

    public function roleEdit_method(Request $request)
    {
        $roleData = DB::table('roles')->where('role', $request->role)->first();
        return $roleData;
    }

    public function  updateRole_method(Request $request)
    {
        
        if($request->id == $request->role){
            return redirect('roles');
        }
        else{
             $updatedRole = DB::table('roles')->where('role', $request->id)->update([
                 'role' => $request->role,
             ]);
             if ($updatedRole) {
                 return redirect('roles');
             }

        }
    }

    public function roleDelete_method($id)
    {

        $deleted =  DB::table('roles')->where('role', $id)->delete();
        if ($deleted) {
            return redirect('roles');
        }
    }


    // UserType Code starts
    public function userType_method()
    {
        if (Auth::guest()) {
            return redirect('login');
        } else {
            $userTypes = DB::table('userType')->get();
            return view('admin/modules/User/userType', ['userTypes' => $userTypes]);
        }
    }
    public function insertUserType_method(Request $request)
    {


        $checkDuplicateRecord = DB::table('userType')->where('userType', $request->userType)->first('userType');
        if ($checkDuplicateRecord) {

            return redirect('userType')->with('status', 'Duplicate value trying to insert');
        } else {
            $inserted = DB::insert("insert into userType(userType)values(?)", [$request->userType]);
            if ($inserted) {
                return redirect('userType');
            }
        }
    }

    public function userTypeEdit_method(Request $request)
    {
        $roleData = DB::table('userType')->where('userType', $request->userType)->first();
        return $roleData;
    }

    public function  updateUserType_method(Request $request)
    {
        if($request->id == $request->userType){
            return redirect('userType');
        }
        else{
            $updatedRole = DB::table('userType')->where('userType', $request->id)->update([
                'userType' => $request->userType,
            ]);
            if ($updatedRole) {
                return redirect('userType');
            }

        }
    }

    public function userTypeDelete_method($id)
    {
        $deleted =  DB::table('userType')
            ->where('userType', $id)
            ->delete();
        if ($deleted) {
            return redirect('userType');
        }
    }


    // Create user code starts from here

    public function createUser_method()
    {
        if (Auth::guest()) {
            return redirect('login');
        } else {
            $users = DB::table('users')->get();
            $roles = DB::table('roles')->get();
            $userData = DB::table('userType')->get();
            return view('admin/modules/User/createUser', ['users' => $users, 'roles' => $roles, 'userData' => $userData]);
        }
    }

    public function insertCreatedUser_method(Request $request)
    {
        $checkDuplicateRecord = DB::table('users')->where('name', $request->name)->orWhere('email',$request->email)->first();
        if ($checkDuplicateRecord) {
            return redirect('createUser')->with('status', 'Duplicate value trying to insert');
        } else {
            $abc = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'userType' => $request->userType,
                'role' => json_encode($request->role),
                'image' => $request->file('image')->store('public/images'),
                'cell' => $request->cell,
            ];
            $inserted = DB::table('users')->insert($abc);
            if ($inserted) {
                return  redirect('createUser');
            }
        }
    }
    public function createdUserEdit_method(Request $request)
    {

        $roleData = DB::table('users')->where('id', $request->id)->first();
        return $roleData;
    }

    public function createdUserDelete_method($id)
    {
        $deleted =  DB::table('users')
            ->where('id', $id)
            ->delete();
        if ($deleted) {
            return redirect('createUser');
        }
    }

    public function getUserTypeAndRoleFromDB_method(Request $request)
    {
        $userType = DB::table('users')->where('id', $request->id)->first('userType');
        $role = DB::table('users')->where('id', $request->id)->first('role');
        $userTypeData = DB::table('userType')->get();
        $roles = DB::table('roles')->get();
        return ['userType' => $userType, 'role' => $role, 'userTypeData' => $userTypeData, 'roles' => $roles];
    }

    public function updateCreatedUser_method(Request $request)
    {
        // dd($request->all());
        $image_value = $request->file('modal_image');
        if (empty($image_value)) {
            $updatedUser = DB::table('users')->where('id', $request->modal_id)->update([
                'name' => $request->modal_name,
                'email' => $request->modal_email,
                'password' => Hash::make($request->modal_password),
                'userType' => $request->modal_userType,
                'role' => json_encode($request->modal_role),
                'cell' => $request->modal_cell,
            ]);
            if ($updatedUser) {
                return redirect('createUser');
            }
            else{
                return redirect('createUser');
            }
        } else {
            $updatedUser = DB::table('users')->where('id', $request->modal_id)->update([
                'name' => $request->modal_name,
                'email' => $request->modal_email,
                'password' => Hash::make($request->modal_password),
                'userType' => $request->modal_userType,
                'role' => json_encode($request->modal_role),
                'image' => $request->file('modal_image')->store('public/images'),
                'cell' => $request->modal_cell,
            ]);
            if ($updatedUser) {
                return redirect('createUser');
            }
            else{
                return redirect('createUser');
            }
        }
    }
    // Dashboard code starts from here
    public function getAccountHeadFromUserAccountTable_method()
    {
        
        return DB::table('useraccount')->distinct()->get('AccountHead'); 
    }
    public function setSessionAH_method(Request $request)
    {
        $AccountHead = $request->value;
        session(['AH' => $AccountHead]);
    }

    public function getCompaniesFromAccountsCompany_method()
    {
        return DB::table('accountscompany')->where('AccountHead', session('AH'))->distinct()->get('CompanyName');
    }

    public function setSessionCompany_method(Request $request)
    {
        $CompanyName = $request->value;
        session(['CompanyName' => $CompanyName]);
    }
    public function getCityNameForMakingPartyCode_method(Request $request){
       
        return DB::table('area')->where('CityName',$request->cityName)->get('Area');
           
    }
    public function getCityNameForMakingPartyCode2_method(Request $request){
        
        return DB::table('area')->where('CityName',$request->cityName)->get('Area');
      
    }
}
