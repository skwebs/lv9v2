<?php

namespace App\Http\Controllers;

use App\Models\Result;
use App\Models\AdmitCard;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode; 

class ResultController extends Controller
{
    private $classes;
    
    public function __construct()
    {
	    $this->middleware('auth');
	    
	    $this->classes = ['Play', 'Nursery', 'LKG'];
	    
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        $result = AdmitCard::with('result');
        if($class=$req->query('class')){
    	        $result->where('class',$class);
        }
        //$r = $results->get();
        
        //$stu = Result::with('admitCard')->get();
        //$results = AdmitCard::with('result')->get();
        $results=$result->orderBy('roll')->get();
        
        return view('results.index',compact('results'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $req)
    {
    //dd(url()->previous());
        $stu = AdmitCard::find($req->query('stu_id'));
        $classes=$this->classes;
        $redirect_to = $req->query('redirect_to');
        return view('results.create', compact('stu','classes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // dd($request->query('redirect_to'));
        $request->validate([
	        'admit_card_id'=>'numeric',
	        'hindi'=>'numeric',
	        'english'=>'numeric',
	        'maths'=>'numeric',
	        'drawing'=>'numeric',
	        'total'=>'numeric',
	        'full_marks'=>'numeric',
        ]);
        
        if(!in_array($request->query('class'),$this->classes)){
	        $request->validate([
		        'science'=>'numeric',
		        'sst'=>'numeric',
		        'science_oral'=>'numeric',
		        'sst_oral'=>'numeric',
		        'computer'=>'numeric',
	        ]);
        }
        /*$marks = $request->only([
	        'hindi','english','maths','drawing','science','sst','computer','science_oral','sst_oral',
        ]);
        
        $request->mergeIfMissing([
        '_session' => $request->query('session'),
        'marks' => $marks,
        'uploaded_by_id' => auth()->user()->id
        ]);
        dd($request->only([
	        'admit_card_id','_session','marks','uploaded_by_id'
        ]));
        */
        $data = [
	        'admit_card_id'=>$request->admit_card_id,
	        'session'=>$request->query('session'),
	        'class'=>$request->query('class'),
	        'roll'=>$request->query('roll'),
	        'marks'=>$request->only([
			        'hindi','english','maths','drawing','science','sst','computer','science_oral','sst_oral',
		        ]),
	        'total'=>$request->total,
	        'total_text'=>$request->total,
	        'full_marks'=>$request->full_marks,
	        'uploaded_by_id' => auth()->user()->id,
        ];
        //dd($data);
        Result::create($data);
        
        //return redirect()->route('result.index')
        return redirect($request->query('redirect_to'))
        ->with('success','Result uploaded successfully!');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Result  $result
     * @return \Illuminate\Http\Response
     */
    public function show(Result $result)
    {
        //$stu=$result->with('admitCard')->first();//->admitCard;
        $stu=AdmitCard::find($result->admit_card_id);
        $classes=$this->classes;
        return view('results.show', compact('result','stu','classes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Result  $result
     * @return \Illuminate\Http\Response
     */
    public function edit(Result $result)
    {
        $stu=AdmitCard::find($result->admit_card_id);
        $classes=$this->classes;
        return view('results.edit', compact('result','stu','classes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Result  $result
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Result $result)
    {
	    //dd($request->query());
	    $request->validate([
    	        'admit_card_id'=>'numeric',
    	        'hindi'=>'numeric',
    	        'english'=>'numeric',
    	        'maths'=>'numeric',
    	        'drawing'=>'numeric',
    	        'total'=>'numeric',
    	        'full_marks'=>'numeric',
    ]);
    
    if(!in_array($request->query('class'),$this->classes)){
        $request->validate([
	        'science'=>'numeric',
	        'sst'=>'numeric',
	        'science_oral'=>'numeric',
	        'sst_oral'=>'numeric',
	        'computer'=>'numeric',
        ]);
    }
    
    $data = [
        'admit_card_id'=>$request->admit_card_id,
        'session'=>$request->query('session'),
        'class'=>$request->query('class'),
        'roll'=>$request->query('roll'),
        'marks'=>$request->only([
		        'hindi','english','maths','drawing','science','sst','computer','science_oral','sst_oral',
	        ]),
        'total'=>$request->total,
        'total_text'=>$request->total,
        'full_marks'=>$request->full_marks,
        'uploaded_by_id' => auth()->user()->id,
    ];
    //dd($data);
    $result->update($data);
    
    //return redirect()->route('result.index')
    return redirect($request->query('redirect_to'))
    ->with('success','Result updated successfully!');
        
// old    
/*		$request->mergeIfMissing(['updated_by_id' => auth()->user()->id]);
        
        $request->validate([
	        'hindi'=>'numeric',
	        'english'=>'numeric',
	        'maths'=>'numeric',
	        'drawing'=>'numeric',
	        'science'=>'numeric|nullable',
	        'social_science'=>'numeric|nullable',
	        'computer'=>'numeric|nullable',
	        'total'=>'numeric',
	        'full_marks'=>'numeric',
        ]);
        
        $result->update($request->only([
	        'hindi','english',
	        'maths','drawing','science','social_science',
	        'computer','gk','total','full_marks','updated_by_id',
        ]));
        
        return redirect()->route('result.index')->with('success','Result updated successfully!');
    */
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Result  $result
     * @return \Illuminate\Http\Response
     */
    public function destroy(Result $result)
    {
        //
    }
    
    

}