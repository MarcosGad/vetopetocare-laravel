<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\RequestsUser;
use App\Refusal;
use App\User;


class RequestsUserController extends Controller
{
    public function index(){
        $requestsUsers = RequestsUser::select()->orderBy('created_at', 'desc')->paginate(PAGINATION_COUNT);
        return view('admin.requestsUser.index', compact('requestsUsers'));
    }

    
    public function acc($userId,$type,$id){
        try {
            $user = User::find($userId);
            if (!$user) {
                return redirect()->route('admin.requestsUser')->with(['error' => 'هذه المستخدم غير موجود']);
            }
            User::where('id',$userId)->update(['type'=>$type]);

            $requestsUser = RequestsUser::find($id);
            if (!$requestsUser) {
                return redirect()->route('admin.requestsUser', $id)->with(['error' => 'هذه الطلب غير موجود']);
            }
            $requestsUser->delete();
            return redirect()->route('admin.requestsUser')->with(['success' => 'تم التحويل بنجاح']);

        } catch (\Exception $ex) {
            return $ex;
            return redirect()->route('admin.requestsUser')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }


    public function insertRefusalThree(Request $request)
    {
            $this->validate($request, [
                'with_id' =>  ['required', 'numeric'],
                'user_id' =>  ['required', 'numeric'],
                'one' => ['required', 'string', 'max:255'],
                'two' => ['required', 'string', 'max:255'],
                'details' => ['required', 'string', 'max:255'],
            ],[
                'required'  => 'هذا الحقل مطلوب',
            ]);
            
            Refusal::create($request->all());
                
            $requestsUser = RequestsUser::find($request->with_id);
            if (!$requestsUser) {
                return redirect()->route('admin.requestsUser', $id)->with(['error' => 'هذه الطلب غير موجود']);
            }

            $requestsUser->delete();
    
            return response()->json(
                [
                    'success' => true,
                    'message' => 'تم رفض الطلب والحذف بنجاح'
                ]
            );
    }

    
    public function destroy($id){
        try {
            $requestsUser = RequestsUser::find($id);
            if (!$requestsUser) {
                return redirect()->route('admin.requestsUser', $id)->with(['error' => 'هذه الطلب غير موجود']);
            }

            $requestsUser->delete();
            return redirect()->route('admin.requestsUser')->with(['success' => 'تم الحذف بنجاح']);

        } catch (\Exception $ex) {
            return $ex;
            return redirect()->route('admin.requestsUser')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }

   

}