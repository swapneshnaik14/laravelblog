<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Postr;
use Auth;

class PostrController extends Controller
{
    public function publicHomePage(Request $request){
        if($request->input('type')=='recentPosts')
        {
            $posts=Postr::orderBy('created_at','asc')->paginate(10);
            $organization='Top 10 Most Recent Posts';
        }else if($request->input('type')=='mostCommented'){
            $posts=Postr::orderBy('comment_count','desc')->paginate(10);
            $organization='Top 10 Most Commented Posts';
        }else if($request->input('type')=='mostVisited'){
            $posts=Postr::orderBy('visit_count','desc')->paginate(10);
            $organization='Top 10 Most Visited Posts';
            
        }else{
            $posts=Postr::orderBy('created_at','asc')->paginate(10);
            $organization='Top 10 Most Recent Posts';
        }
        
        
        $data=array(
            'posts'=>$posts,
            'organization'=>$organization
        );
    

        return view('blog/home',$data);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loggedInUserId=Auth::id();
        $posts=Postr::all()->where('user_id',$loggedInUserId);
        return view('adminPanel/home',['posts'=>$posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('adminPanel/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $postrs=new Postr;
        $postrsTitle= $request->title;
        $postrsBody= $request->body;
        $postrsUserId=Auth::id();

        $postrs->user_id=$postrsUserId;
        $postrs->title=$postrsTitle;
        $postrs->body=$postrsBody;


        $postrs->save();

        return redirect()->route('postrs.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $post = Postr::find($id);
      $data = array(
          'id'=>$id,
          'post'=>$post
      );
      return view ('blog.view_post',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $post=Postr::find($id);
       return view('adminPanel.edit',['post'=>$post]);
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
        $post=POSTR::find($id);
        if(isset($request->commentCount)){
            $commentCount=$request->commentCount;
            $post->comment_count=$commentCount;
           
            
        }
      
       if(isset($request->visitCount))
       {
        $visitCount=$request->visitCount;
        $post->visit_count=$visitCount;

       }
       if(isset($request->title)){
           $post->title=$request->title;

       }
       if(isset($request->body)){
        $post->body=$request->body;
        
    }
      
        $post->save();
        if(isset($request->editForm)){
            return redirect()->route(
                'postrs.index'
            );

        }else{
            return redirect()->route('postrs.show',['id'=>$id]);
        }

        if($request->hasFile('image')){
            return 'yes';

        }
       else{
           no;
       }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post=POSTR::find($id);
        $post->delete();
        return redirect()->route('postrs.index');
    }
}
