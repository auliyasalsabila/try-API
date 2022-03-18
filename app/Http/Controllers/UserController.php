<?php

namespace App\Http\Controllers;

use App\Http\Libraries\BaseApi;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = (new BaseApi)->index('/user');

        return view('user.index')->with(['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // buat variable baru untuk menset parameter agar sesuai dengan documentasi
		$payload = [
            'firstName' => $request->input('firstName'),
            'lastName' => $request->input('lastName'),
            'email' => $request->input('email'),

        ];

        $baseApi = new BaseApi;
        $response = $baseApi->create('/user/create', $payload);

        if ($response->failed()) {
            
            $errors = $response->json('data');

            $messages = "<ul>";

            foreach ($errors as $key => $msg) {
                $messages .= "<li>$key : $msg</li>";
            }

            $messages .= "</ul>";

            $request->session()->flash(
                'message',
                "Data gagal disimpan
                $messages",
            );

            return redirect()->back();
        }

        $request->session()->flash(
            'message',
            'Data berhasil disimpan',
        );

        // return redirect()->back();
        return redirect('users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $response = (new BaseApi)->detail('/user', $id);
        return view('user.edit')->with([
            'user' => $response->json()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return redirect('user.edit');
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
        $payload = [
            'firstName' => $request->input('firstName'),
            'lastName' => $request->input('lastName'),
            'email' => $request->input('email'),

        ];

        $response = (new BaseApi)->update('/user', $id, $payload);
        
        if ($response->failed()) {
            $errors = $response->json('data');

            $messages = "<ul>";

            foreach ($errors as $key => $msg) {
                $messages .= "<li>$key : $msg</li>";
            }

            $messages .= "</ul>";

            $request->session()->flash(
                'message',
                "Data gagal disimpan
                $messages",
            );

            return redirect('users');
        }

        $request->session()->flash(
            'message',
            'Data berhasil disimpan',
        );

        return redirect('users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( Request $request,$id)
    {
        $response = (new BaseApi)->delete('/user', $id);

        if ($response->failed()) {
            $request->session()->flash(
                'message',
                'Data gagal dihapus'
            );

            return redirect('users');
        }

        $request->session()->flash(
            'message',
            'Data berhasil dihapus',
        );

        return redirect('users');
    }
}
