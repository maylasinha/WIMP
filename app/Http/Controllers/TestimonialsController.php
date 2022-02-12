<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Testimonial;

class TestimonialsController extends Controller
{
	public function index()
	{
		$testimonials = Testimonial::where(['user_id' => auth()->user()->id])->get();
		return view('testimonials.index', ['title' => 'Depoimentos', 'testimonials' => $testimonials]);
	}

	public function create()
	{
		return view('testimonials.create', ['title' => 'Novo Depoimento']);
	}
	
	public function store(Request $request)
	{
		$request->validate([
			'description' => 'required'
		]);

		$testimonial = new Testimonial([
      'description' => $request->get('description'),
      'slug' => Str::slug(auth()->user()->name . ' ' . \Carbon\Carbon::now(), '-'),
      'user_id' => auth()->user()->id
		]);

		$testimonial->save();

		return redirect()->route('testimonials.index')->with('success', 'Depoimento adicionado com sucesso.');
	}

	public function edit($id)
	{
		$testimonial = Testimonial::find($id);
		return view('testimonials.edit', ['title' => 'Editar Depoimento', 'testimonial' => $testimonial]);
	}

	public function update(Request $request, $id)
	{
		$request->validate([
			'description' => 'required'
		]);

		$testimonial = Testimonial::find($id);

		$testimonial->description = $request->get('description');
		$testimonial->user_id = auth()->user()->id;

		$testimonial->save();

		return redirect()->route('testimonials.index')->with('success', 'Depoimento alterado com sucesso.');
	}

	public function destroy(Request $request, $id)
	{
		$testimonial = Testimonial::find($id);
		$testimonial->delete();

		return redirect()->route('testimonials.index')->with('success', 'Depoimento removido com sucesso.');
	}
}
