<?php

namespace App\Http\Controllers;

use App\Models\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 

        $query = Upload::query(); 
        $query->where('status', 0);
        $uploads = $query->get();
        return view('uploads.index', ['uploads' => $uploads]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    
        $upload = new Upload;

        return view('uploads.create', compact('upload'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $upload = new Upload;
        $upload->title = $request->input('title');
        $upload->content = $request->input('content');
        $upload->mimeType = $request->file('upload')->getMimeType();
        $upload->originalName = $request->file('upload')->getClientOriginalName();
        $upload->path = $request->file('upload')->store('uploads');
        $upload->save();
        return view('uploads.create',
            ['id'=>$upload->id,
            'path'=>$upload->path,
            'originalName'=>$upload->originalName,
            'mimeType'=>$upload->mimeType,
            'title' => $upload->title,
            'content' => $upload->content,
    ]);
  
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Upload  $upload
     * @return \Illuminate\Http\Response
     */
    public function show(Upload $upload)
    {
        $upload = Upload::findOrFail($upload->id);
        //dd($upload);
        return response()->file(storage_path() . '/app/' . $upload->path);
    }

  
    public function edit($id)
    {
        $upload = Upload::findOrFail($id);
        return view('uploads.edit', [
            'id'           => $id,
            'originalName' => $upload->originalName,
            'upload'       => $upload,
        ]);
    
    }
    
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Upload  $upload
     * @return \Illuminate\Http\Response
     */
public function update(Request $request, $id)
{
    $upload = Upload::findOrFail($id);
    // Validate the request data
    $request->validate([
        'title' => 'required|string',
        'content' => 'required|string',
        'upload' => 'required|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Update fields
    $upload->title = $request->title;
    $upload->content = $request->content;

    // Check if a new file is uploaded
    if ($request->hasFile('upload')) {
        // Delete the existing file
        Storage::delete($upload->path);

        // Save the new file
        $upload->originalName = $request->file('upload')->getClientOriginalName();
        $upload->path = $request->file('upload')->store('uploads');
        $upload->mimeType = $request->file('upload')->getClientMimeType();
    }

    // Save changes
    $upload->save();

    return redirect()->route('uploads.index');
}


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Upload  $upload
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Upload $upload)
    // {
    //     $upload = Upload::findOrFail($upload->id);
    //     Storage::delete($upload->path);
    //     $upload->delete();
    //     return back()->with(['operation'=>'deleted', 'id'=>$upload->id]);
    //     return view('view', compact('uploads'));
    // }

// 在 UploadController.php 中
public function destroy ($id)
{

    $upload = Upload::findOrFail($id);
    Storage::delete($upload->path);
   // $upload->delete();
   $upload->status=1;
   if($upload->save()){
    return redirect()->back()->with('success', '删除成功!');
   }else{
    return redirect()->back()->with('error', '删除失败!');
   }
    //return back()->with(['operation' => 'deleted', 'id' => $upload->id]);
}

public function showEditForm(Upload $upload)
{
    return view('uploads.edit', compact('upload'));
}



}
