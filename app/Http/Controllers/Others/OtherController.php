<?php

namespace App\Http\Controllers\Others;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Jackiedo\DotenvEditor\Facades\DotenvEditor;

class OtherController extends Controller
{
    public function getsettings(){

        abort_if(!auth()->user()->getRoleNames()->contains('Super Admin'),403,'No Permission !');

        return view('admin.others.index');

    }

    public function forcehttps(){

        if(env("DEMO_LOCK") == 1){

            notify()->error('This feature is restricted in demo !');
            return back();

        }

        abort_if(!auth()->user()->getRoleNames()->contains('Super Admin'),403,'No Permission !');

        $force_https = DotenvEditor::setKeys([
            'FORCE_HTTPS' => env('FORCE_HTTPS') == 1 ? '0' : '1'
        ]);

        $force_https->save();

        notify()->success('Settings updated !');

        return back();

    }

    public function removepublic(){

        if(env("DEMO_LOCK") == 1){

            notify()->error('This feature is restricted in demo !');
            return back();

        }

        abort_if(!auth()->user()->getRoleNames()->contains('Super Admin'),403,'No Permission !');

        $content = 
        
        '<IfModule mod_rewrite.c>
            RewriteEngine On
            RewriteRule ^(.*)$ public/$1 [L]
        </IfModule>';

        @file_put_contents(base_path().'/.htaccess',$content);

        notify()->success('Settings updated !');

        return back();

    }
}
