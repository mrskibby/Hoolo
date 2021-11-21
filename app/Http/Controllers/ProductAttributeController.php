<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\ProductAttributes;


class ProductAttributeController extends Controller
{

	public function index()
	{
        abort_if(!auth()->user()->can('attributes.view'),403,'User does not have the right permissions.');

		$pattr = ProductAttributes::all();
		return view('admin.attributes.index',compact('pattr'));
	}

    public function create()
    {
        abort_if(!auth()->user()->can('attributes.create'),403,'User does not have the right permissions.');
    	return view('admin.attributes.addattr');
    }

    public function store(Request $request)
    {

        abort_if(!auth()->user()->can('attributes.create'),403,'User does not have the right permissions.');
        
    	$request->validate([
    		'attr_name' => 'required|unique:product_attributes,attr_name',
            'cats_id' => 'required'
    	],[
            'cats_id.required' => 'One Category is required atleast !',
            'attr_name.required' => 'Attribute name is required !',
            'attr_name.unique' => 'Option Already Added !'
        ]);
        
        if (preg_match('/\s/',$request->attr_name) ){
            $attr_name = str_replace(' ','_',$request->attr_name);
        }else{
            $attr_name = $request->attr_name;
        }
    	
		$newopt = new ProductAttributes;
    	
    	$newopt->attr_name = $attr_name;
        $newopt->unit_id = $request->unit_id;
        $newopt->cats_id = $request->cats_id;


		$newopt->save();

    	
		return redirect()->route('attr.index')->with('added','Option '.$request->attr_name.' Created Successfully !');
    }

    public function edit($id)
    {
        abort_if(!auth()->user()->can('attributes.edit'),403,'User does not have the right permissions.');

    	$proattr = ProductAttributes::findorfail($id);

    	return view('admin.attributes.editattr',compact('proattr'));
    }


    public function update(Request $request, $id)
    {

        abort_if(!auth()->user()->can('attributes.edit'),403,'User does not have the right permissions.');

    	$proattr = ProductAttributes::findorfail($id);

        $input = $request->all();
        
        if (preg_match('/\s/',$request->attr_name) ){
            $input['attr_name'] = str_replace(' ','_',$request->attr_name);
        }else{
            $input['attr_name'] = $request->attr_name;
        }

        $findsameattr = ProductAttributes::where('attr_name','=',$request->attr_name)->first();

        if(isset($findsameattr))
        {
            if(strcasecmp($request->attr_name, $findsameattr->attr_name) == 0 && $proattr->id != $findsameattr->id)
            {
                return back()->with('warning','Variant is Already there !'); 
            }else {
               $proattr->update($input);

                return redirect()->route('attr.index')->with('updated','Option Updated to '.$input['attr_name'].' Successfully !');
            } 
        }else
        {
            $proattr->update($input);

            return redirect()->route('attr.index')->with('updated','Option Updated to '.$input['attr_name'].' Successfully !');
        }
       

        if(isset($findsameattr))
        {
            if($findsameattr->attr_name == $request->attr_name && $proattr->id != $findsameattr->id)
            {
            return back()->with('warning','Variant is Already there !');
            }  
        }else{
            $proattr->update($input);

            return redirect()->route('attr.index')->with('updated','Option Updated to '.$input['attr_name'].' Successfully !');
        }
        

    	
    }

    
}
