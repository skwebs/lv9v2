<?php

namespace App\Http\Controllers;

use App\Models\AdmitCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Image;
use SimpleSoftwareIO\QrCode\Facades\QrCode; 

class AdmitCardController extends Controller
{

	
    public function __construct()
    {
	    $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['admitCards'] = AdmitCard::orderByDesc('id')->get(); //orderBy('id','desc');
       //dd($data);
        return view('admitCards.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admitCards.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
        'name'      => 'required',
        'mother'    => 'required',
        'father'    => 'required',
        'gender'    => 'required',
        'dob'       => 'date|required',
        'mobile'    => 'regex:/^[6-9][0-9]{9}/i',
        'address'   => 'required',
        'class'     => 'required', 
        'roll'      => 'numeric|required',
        ]);
        
        $request->mergeIfMissing(['created_by' => auth()->user()->name]);
        
        if(AdmitCard::where(['class'=>$request->class, 'roll'=>$request->roll])->first()){
	        return redirect()->back()->withInput()->with('warning',"The student Class: \"{$request->class}\" and Roll No. \"{$request->roll}\" already exist.");
        }
        
        $admitCard = AdmitCard::create($request->except(['_token']));
        
        //return redirect()->route('sdmitCard.index')->with('success',"{$request->name}, Class : \"{$request->class}\",  Roll No.: \"{$request->roll}\" is added successfully.");
        return redirect()->route('admitCard.upload_image',$admitCard->id)->with('success',"{$request->name}, Class : \"{$request->class}\",  Roll No.: \"{$request->roll}\" has added successfully.");
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AdmitCard  $admitCard
     * @return \Illuminate\Http\Response
     */
    public function show(AdmitCard $admitCard)
    {
	    $admitCards[0] = $admitCard;
	    // using admit_cards_all view for single admit card using above method
        return view('admitCards.admit_card_all', compact('admitCards'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AdmitCard  $admitCard
     * @return \Illuminate\Http\Response
     */
    public function edit(AdmitCard $admitCard)
    {
        return view('admitCards.edit', compact('admitCard'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AdmitCard  $admitCard
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AdmitCard $admitCard)
    {
        $request->validate([
        'name'      => 'required',
        'mother'    => 'required',
        'father'    => 'required',
        'gender'    => 'required',
        'dob'       => 'date|nullable',
        'mobile'    => 'regex:/^[6-9][0-9]{9}/i',
        'address'   => 'required',
        'class'     => 'required', 
        'roll'      => 'numeric|required',
        ]);
        
        $request->mergeIfMissing(['updated_by' => auth()->user()->name]);
        
        // check if update roll or/and class then enter class-roll combination already exist or not
        if($stu=AdmitCard::where(['class'=>$request->class, 'roll'=>$request->roll])->first()){
	        if($stu->id != $request->id){
	        //if class-roll combination already exist then return back
			    return redirect()->back()->withInput()->with('warning',"The student Class: \"{$request->class}\" and Roll No. \"{$request->roll}\" already exist.");
			    //return redirect()->back()->withInput()->with('warning','Updating class and/or roll already exist!');
		    }
        }
        
        $admitCard->update($request->except(['_token', 'id']));
        
        //return redirect()->route('admitCard.upload_image',$id);
        return redirect()->route('admitCard.index')->with('success',"{$request->name}, Class : \"{$request->class}\",  Roll No.: \"{$request->roll}\" has updated successfully.");
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AdmitCard  $admitCard
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdmitCard $admitCard)
    {
        $name = $admitCard->name;
        $class = $admitCard->class;
        $roll = $admitCard->roll;
        
        $admitCard->delete();
        
        return redirect()->route('admitCard.index')->with('success',"{$name}, Class : \"{$class}\",  Roll No.: \"{$roll}\" has trashed successfully.");
        
    }
    
    //added
	public function upload_image(AdmitCard $admitCard)
	{
	    return view('admitCards.crop_image',compact('admitCard'));
	}
	
	public function save_image(Request $request, AdmitCard $admitCard)
	{
		// define all paths in array
		$paths = array(
			'stu_img' => public_path("uploads/images/students"),
			'thumb'   => public_path("uploads/images/students/thumbnail"),
			'trash'   => public_path("trash"),
		);
		
		// check and create paths
		foreach($paths as $path){
			$this->mk_dir($path);
		}
		// retrive first name
		$first_name = explode(" ",$admitCard->name)[0];
		
		// validate input
		$request->validate([
			"image" => "required|image|mimes:jpg,jpeg,png|max:2048",
		]);
		
		// old files
		$old_file = $paths['stu_img']."/".$admitCard->image;
		$old_thumb_file = $paths['thumb']."/".$admitCard->image;
		
		// if exist old file, move to trashed folder
		if(!$admitCard->image == null && file_exists($old_file)){
			rename($old_file, $paths['trash'].'/'.$admitCard->image);
		}
		
		// if thumb exits delete it
		if(!$admitCard->image == null && file_exists($old_thumb_file)){
			unlink($old_thumb_file);
		}
		
		// define new file name
		$new_file_name = $first_name.date('_Ymd-His.').$request->image->extension();  
	
		$image = $request->image;
		$img = Image::make($image->path());
		$img->resize(100, 100, function ($constraint) {
			$constraint->aspectRatio();
		})->save($paths['thumb'].'/'.$new_file_name);
		
		$request->image->move($paths['stu_img'], $new_file_name);
		
		$admitCard->image = $new_file_name;
		
		$admitCard->save();
		
		//	all array data encode into json for client
		return response()->json([
			'success'=>true,
			'msg'=>'Image uploaded.'
		]);

	}
	
	public function admit_cards()
	{
		$data['admitCards'] = AdmitCard::orderByDesc('class')->where('image','!=',null)->get(); //orderBy('id','desc');
		//dd($data);
		return view('admitCards.admit_card_all',$data);
	}
	
	// admin homepage
	
	public function admin_homepage(){
		return view('admin_homepage');
	}
	
	private function mk_dir($path){
		if(!is_dir($path)){
		/* Directory does not exist, so lets create it. */
			mkdir($path, 0755, true);
		}
	}
	
}