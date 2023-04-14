<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\AccessToken;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use Illuminate\Support\Facades\DB;
use DateTime;

session_start();
class UserController extends Controller
{
    public function logOut($token)
    {
        $user=User::where('token',$token)->first();
        if($user)
        {
        $user->token=null;
        session_destroy();
        session_unset();
        $data="Deconnexion avec succes";
        $statuts="success";
        $codes="200";
        return response()->json([$data,$statuts,$codes]);
        }else
        {
        $data="Token invalide, deconnexion annuler";
        $statuts="Failed";
        $codes="400";
        return response()->json([$data,$statuts,$codes]);
        }
    }

    public function signIn(Request $request)
    {
        $request->validate(
            [
                'login'=>'required',
                'password'=>'required',
            ]
            );
        $user=user::where('email',$request->get('login'))->first();
        //return $user;
        if($user!=null)
        {
            $userPassword=$user->password;
            //return $userPassword;
            if(Hash::check($request->get('password'),$userPassword) && $user->statut==1)
                {
                    $accessToken =Str::random(100);
                    $user->token=$accessToken;
                    $user->save();
                    $data=$user;
                    $statuts="success";
                    $codes=200;
                    $_SESSION['id']=$user['id'];
                    $_SESSION['username']=$user['username'];
                    $_SESSION['token']=$accessToken;
                    return response()->json(['data'=>$data,'statut'=>$statuts,'code'=>$codes]);
                }else
                {
                    $data="Password incorrect";
                    $statuts="Failed";
                    $codes=400;
                    return response()->json(['data'=>$data,'statut'=>$statuts,'code'=>$codes]);
                }
        }else
        {
            $data="Ientifiant incorrect";
            $statuts="Failed";
            $codes=400;
            return response()->json(['data'=>$data,'statut'=>$statuts,'code'=>$codes]);
        }

    }

    public function register(Request $request)
    {
        
        $request->validate
        ([
            'username'=>'required',
            'email'=>'required',
            'firstName'=>'required',
            'lastName'=>'required',
            'password'=>'required',
            'password_confirmation'=>'required',
            'birthdate'=>'required',
        ]);
        
        if($request->get('password') == $request->get('password_confirmation'))
        {
            $lowerUsername = Str::lower($request->get('username'));
            $getUser=user::where('username',$lowerUsername)->first();
            if(!$getUser)
            {
                $code = Str::random(10);
            $mailData = [
                                "code" => $code,
                            ];
            $statut=0;
            $isAdmin=0;
            $passwordHash= Hash::make($request->get('password'));
            $mail=$request->get('email');
            //dd(Hash::check($request->get('password'),$passwordHash));
            Mail::to($mail)->send(new SendMail($mailData));
            $newUser= new User
            ([
            'statut'=>$statut,
            'isAdmin'=>$isAdmin,
            'username'=>$lowerUsername,
            'lastName'=>$request->get('lastName'),
            'firstName'=>$request->get('firstName'),
            'password'=>$passwordHash,
            'email'=>$request->get('email'),
            'birthdate'=>$request->get('birthdate'),
            'code'=>$code,
            ]);
            $newUser->save();
            $data=$newUser;
            $statuts="success";
            $codes=200;
            return response()->json(['data'=>$data,'statuts'=>$statuts,'code'=>$codes]);
            }else
            {
                return response()->json(['data'=>'This username is already in use','statuts'=>'failed','codes'=>401]);
            }
            
        }else
        {
            $data="Password don't match";
            $statuts="Failed";
            $codes=400;
            return response()->json(['data'=>$data,'statuts'=>$statuts,'code'=>$codes]);
        }
    }

    public function confirmEmailWithCode(Request $request)
    {
        $request->validate
        ([
            'code'=>'required',
        ]);
        $user=user::where('code',$request->get('code'))->first();
        if($user!=null)
        {
            $user->statut=1;
            $user->email_verified_at= new DateTime();
            $user->save();
            $data="Code correct";
            $statuts="success";
            $codes=200;
            return response()->json(['data'=>$data,'statuts'=>$statuts,'code'=>$codes]);
        }else
        {
            $data="Code incorrect";
            $statuts="failed";
            $codes=400;
            return response()->json(['data'=>$data,'statuts'=>$statuts,'code'=>$codes]);
        }
    }

    public function updatePassword(Request $request, $token)
    {
        $request->validate
        ([
            'passwordOld' =>'required',
            'passwordNew' =>'required',
            'passwordConfirm' =>'required',
        ]);

        $user = user::where('token',$token)->first();
        if(Hash::check($request->get('passwordOld'), $user['password']))
        {
            if($request->get('passwordNew')==$request->get('passwordConfirm'))
            {
                $passwordNewHash= Hash::make($request->get('passwordConfirm'));
                $user->password= $passwordNewHash;
                $user->save();
                $data="Change successfully";
                $statuts="Success";
                $codes=200;
                return response()->json(['data'=>$data,'statuts'=>$statuts,'code'=>$codes]);
            }else
            {
                $data="New password and passwordConfirm don't match";
                $statuts="Failed";
                $codes=400;
                return response()->json(['data'=>$data,'statuts'=>$statuts,'code'=>$codes]);
            }
        }else
        {
                $data="Old password don't match";
                $statuts="Failed";
                $codes=400;
                return response()->json(['data'=>$data,'statuts'=>$statuts,'code'=>$codes]);
        }
    }

    

    public function showMyPofil($token)
    {
        $user=user::where('token',$token)->first();
        if($user!=null)
        {
            $data=$user;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   
            $statuts="Success";
            $codes=200;
            return response()->json(['data'=>$data,'statuts'=>$statuts,'codes'=>$codes]);
        }
    }

    public function verifyMailForResetPassword(Request $request)
    {
        $request->validate
        ([
            'email'=> 'required',
        ]);
        $mail=user::where('email',$request->get('email'))->first();
        if($mail!=null)
        {
            $code = Str::random(10);
            $mail->code = $code;
            $mailData = [
        "code" => $code,
        ];
        Mail::to($mail['email'])->send(new SendMail($mailData));
        $data="Code send sucessfuly";
        $statuts="success";
        $codes=200;
        return response()->json (['data'=>$data,'statuts'=>$statuts,'code'=>$codes]);
        }
    }

    public function resetPassword(Request $request)
    {
        $request->validate
        ([
            'code'=>'required',
            'newPassword'=> 'required',
            'confirmNewPassword'=> 'required',
        ]);
        $user=user::where('code',$request->get('code'))->first();
        if($user!=null)
        {
            if($request->get('newPassword')==$request->get('confirmNewPassword'))
            {
                $password=$request->get('newPassword');
                $passwordHash=Hash::make($password);
                $user->password=$passwordHash;
                $user->email_verified_at= new DateTime();
                $user->save();
                $data="Password reset";
                $statuts="Success";
                $codes=200;
                return response()->json(['data'=>$data,'statuts'=>$statuts,'codes'=>$codes]);
            }
            else
            {
                $data="New password and password confirm don't match";
                $statuts="Failed";
                $codes=400;
                return response()->json(['data'=>$data,'statuts'=>$statuts,'codes'=>$codes]);
            }
        }
        else
            {
                $data="Code not correct";
                $statuts="Failed";
                $codes=400;
                return response()->json(['data'=>$data,'statuts'=>$statuts,'codes'=>$codes]);
            }
    }

    public function allUser()
    {
        $data=user::all();
        $statuts="Success";
        $codes=200;
        return response()->json(['data'=>$data,'statuts'=>$statuts,'codes'=>$codes]);
    }

    public function createAdmin(Request $request)
    {
        $request->validate
        ([
            'username'=>'required',
            'email'=>'required',
            'firstName'=>'required',
            'lastName'=>'required',
            'password'=>'required',
            'birthdate'=>'required',
        ]);
        $lowerUsername = Str::lower($request->get('username'));
            $getUser=user::where('username',$lowerUsername)->first();
            if($getUser)
            {
               // $code = Str::random(10);
           // $mailData = [
             //                   "code" => $code,
             //               ];
            $statut=1;
            $isAdmin=1;
            $passwordHash= Hash::make($request->get('password'));
            //$mail=$request->get('email');
            //dd(Hash::check($request->get('password'),$passwordHash));
            //Mail::to($mail)->send(new SendMail($mailData));
            $newUser= new User
            ([
            'statut'=>$statut,
            'isAdmin'=>$isAdmin,
            'username'=>$lowerUsername,
            'lastName'=>$request->get('lastName'),
            'firstName'=>$request->get('firstName'),
            'password'=>$passwordHash,
            'code'=>null,
            'email'=>$request->get('email'),
            'birthdate'=>$request->get('birthdate'),
            ]);
            $newUser->save();
            $data=$newUser;
            $statuts="success";
            $codes=200;
            return response()->json(['data'=>$data,'statuts'=>$statuts,'code'=>$codes]);
            }else
            {
                return response()->json(['data'=>'This username is already in use','statuts'=>'failed','codes'=>401]);
            }
    }
    public function allUserAdmin()
    {
        $data=user::all()->where('isAdmin',1);
        $statuts='Success';
        $codes=200;
        return response()->json(['data'=>$data,'statuts'=>$statuts,'codes'=>$codes]);
    }

    public function countAdmin()
    {
        $data=user::all()->where('isAdmin',1)->count();
        $statuts='Success';
        $codes=200;
        return response()->json(['data'=>$data,'statuts'=>$statuts,'codes'=>$codes]);
    }

    public function updateUserByAdminSysteme($id,Request $request,$token)
    {
        $admin = user::where('token',$token)->first();
        if($admin!=null && $admin->isAdmin == 2)
        {
        $user = user::where('id',$id)->first();
        if($user && $user->statut==1)
        {
            if($request->get('username')!=null)
            {
                $lowerUsername=Str::lower($request->get('username'));
                $findUser = user::where('username',$lowerUsername)->first();
                if($findUser==null)
                {
                    $user->username=$lowerUsername;
                }else
                {
                    return response()->json(['data'=>'Username already in use','statuts'=>'failed','codes'=>401]);
                }
            }
            if($request->get('firstName')!=null)
                $user->firstName=$request->get('firstName');
            if($request->get('lastName')!=null)
                $user->lastName=$request->get('lastName');
            if($request->get('password')!=null)
            {
                $password = Hash::make($request->get('password'));
                $user->password=$password;
            }
            if($request->get('email')!=null)
                $user->email=$request->get('email');
            $user->save();
        }else
        {
            return response()->json(['data'=>'User not active','statuts'=>'failed','codes'=>401]);
        }
    }
    }

    public function updateUserByAdmin($id,Request $request,$token)
    {
        $admin = user::where('token',$token)->first();
        if($admin!=null && $admin->isAdmin == 1)
        {
        $user = user::where('id',$id)->first();
        if($user && $user->statut==1 && $user->isAdmin!=2)
        {
            if($request->get('username')!=null)
            {
                $lowerUsername=Str::lower($request->get('username'));
                $findUser = user::where('username',$lowerUsername)->first();
                if($findUser==null)
                {
                    $user->username=$lowerUsername;
                }else
                {
                    return response()->json(['data'=>'Username already in use','statuts'=>'failed','codes'=>401]);
                }
            }
            if($request->get('firstName')!=null)
                $user->firstName=$request->get('firstName');
            if($request->get('lastName')!=null)
                $user->lastName=$request->get('lastName');
            if($request->get('password')!=null)
            {
                $password = Hash::make($request->get('password'));
                $user->password=$password;
            }
            if($request->get('email')!=null)
                $user->email=$request->get('email');
            $user->save();
        }else
        {
            return response()->json(['data'=>'User not active','statuts'=>'failed','codes'=>401]);
        }
    }
    }
    public function showUserProfil($id)
    {
        $user=user::where('id',$id)->first();
        if($user!=null && $user->isAdmin!=2)
        {
            $data=$user;
            $statuts="Success";
            $codes=200;
            return response()->get(['data'=>$data,'statuts'=>$statuts,'codes'=>$codes]);
        }
    }

    public function deleteAdmin($id,$token)
    {
        $admin = user::where('token',$token)->first();
        if($admin!=null && $admin->isAdmin == 2)
        {
        $user=user::findOrfail($id);
        if($user!=null && $user->statut==1 && $user->isAdmin==1)
        {
            $user->statut=-1;
            $user->save();
            $data="Admin delete successfuly";
            $statut="Success";
            $codes=200;
            return response()->json(['data'=>$data,'statut'=>$statut,'codes'=>$codes]);
        }
        }else
        {
            return response()->json(['data'=>'Failed to delete admin.','statut'=>'failed','codes'=>401]);
        }
    }

    public function updateMyProfil(Request $request,$token)
    {
        $user = user::where('token',$token)->first();
        if($user && $user->statut==1)
        {
            if($request->get('username')!=null)
            {
                $lowerUsername=Str::lower($request->get('username'));
                $findUser = user::where('username',$lowerUsername)->first();
                if($findUser==null)
                {
                    $user->username=$lowerUsername;
                }else
                {
                    return response()->json(['data'=>'Username already in use','statuts'=>'failed','codes'=>401]);
                }
            }
            if($request->get('firstName')!=null)
                $user->firstName=$request->get('firstName');
            if($request->get('lastName')!=null)
                $user->lastName=$request->get('lastName');
            $user->save();
        }else
        {
            return response()->json(['data'=>'User not active','statuts'=>'failed','codes'=>401]);
        }
    }

    public function verifyUserToken($token)
    {
        $user = user::where('token',$token)->first();
        if($user!=null)
        {
            return true;
        }else
        {
            return false;
        }
    }

    public function verifyUsername($username)
    {
        $user=user::where('username',$username)->first();
        if($user!=null)
        {
            return response()->json(['data'=>"User already exist",'statut'=>"Success",'code'=>200]);
        }
    }

    public function countUser()
    {
        $count=user::all()->count();
        $data=$count;
        $statuts="Success";
        $codes=200;
        return response()->json(['data'=>$data,'statut'=>$statuts,'code'=>$codes]);
    }

    public function deleteUser($id,$token)
    {
        $admin = user::where('token',$token)->first();
        if($admin!=null && $admin->isAdmin == 2)
        {
            $user=user::findOrfail($id);
        if($user!=null && $user->statut==1)
        {
            $user->statut=-1;
            $user->save();
            $data="User delete successfuly";
            $statut="Success";
            $codes=200;
            return response()->json(['data'=>$data,'statut'=>$statut,'codes'=>$codes]);
        }else
        {
            $data="User not fund";
            $statut="Failed";
            $codes=200;
            return response()->json(['data'=>$data,'statut'=>$statut,'codes'=>$codes]);
        }
        }else
        {
            $data='Action canceled';
            $statuts='failed';
            $codes=401;
            return response()->json(['data'=>$data,'statut'=>$statuts,'codes'=>$codes]);
        }
        
    }
}