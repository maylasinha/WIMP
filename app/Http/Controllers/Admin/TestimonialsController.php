<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Testimonial;

class TestimonialsController extends Controller
{
	public function __construct()
  {
  	$this->middleware(['permission:visualizar depoimento|criar depoimento|editar depoimento|apagar depoimento'], ['only' => ['index']]);
		$this->middleware(['can:visualizar depoimento'], ['only' => ['show']]);
		$this->middleware(['can:criar depoimento'], ['only' => ['create', 'store']]);
		$this->middleware(['can:editar depoimento'], ['only' => ['edit', 'update']]);
		$this->middleware(['can:apagar depoimento'], ['only' => ['destroy']]);
  }
  
	public function index(Request $request)
	{
		if (!$request->get('keyword')) {
			$testimonials = Testimonial::paginate(10);
		} else {
			$testimonials = Testimonial::select('testimonials.*')
																->join('users', 'users.id', '=', 'testimonials.user_id')
																->where('users.name', 'LIKE', '%'.$request->get('keyword').'%')->get();
		}

		return view('admin.testimonials.index', ['title' => 'Depoimentos', 'testimonials' => $testimonials]);
	}

	public function destroy($id)
	{
		$testimonial = Testimonial::find($id);
		$testimonial->delete();

		return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial apagado com sucesso');
	}

	public function show($slug)
	{
		return view('admin.testimonials.show', ['testimonial' => Testimonial::where('slug', $slug)->first()]);
	}

	// Custom methods

	public function update_status(Request $request, $id)
	{
		$testimonial = Testimonial::find($id);
		$status = str_replace('"', '', $request->get('status'));

		$testimonial->status = $status;
		$testimonial->save();

		return response()->json(['message' => 'Depoimento alterado com sucesso.'], 200);
	}
}
