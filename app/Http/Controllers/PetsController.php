<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\PetCategory;
use App\Models\Pet;

class PetsController extends Controller
{
	public function index()
	{
		$pets = Pet::where(['user_id' => auth()->user()->id])->get();
		return view('pets.index', ['title' => 'Pets', 'pets' => $pets]);
	}

	public function create()
	{
		$pet_categories = PetCategory::all();
		return view('pets.create', ['title' => 'Novo Pet', 'pet_categories' => $pet_categories]);
	}
	
	public function store(Request $request)
	{
		$request->validate([
			'name' => 'required',
			'gender' => 'required',
			'size' => 'required',
			'breed' => 'required',
			'lost_at' => 'required|date_format:d/m/Y',
			'description' => 'required',
			'pet_category_id' => 'required'
		]);

		$pet = new Pet([
			'name' => $request->get('name'),
      'gender' => $request->get('gender'),
      'size' => $request->get('size'),
      'breed' => $request->get('breed'),
      'lost_at' => !$request->get('lost_at') ? NULL : \Carbon\Carbon::parse(str_replace('/', '-', $request->get('lost_at')))->format('Y-m-d'),
      'description' => $request->get('description'),
      'slug' => Str::slug($request->get('name') . ' ' . $request->get('size') . ' ' .$request->get('breed'), '-'),
      'pet_category_id' => $request->get('pet_category_id'),
      'user_id' => auth()->user()->id
		]);

		$pet->save();

		return redirect()->route('pets.index')->with('success', 'Pet adicionado com sucesso.');
	}

	public function edit($id)
	{
		$pet_categories = PetCategory::all();
		$pet = Pet::find($id);
		return view('pets.edit', ['title' => 'Editar Pet', 'pet' => $pet, 'pet_categories' => $pet_categories]);
	}

	public function update(Request $request, $id)
	{
		$request->validate([
			'name' => 'required',
			'gender' => 'required',
			'size' => 'required',
			'breed' => 'required',
			'lost_at' => 'required|date_format:d/m/Y',
			'description' => 'required',
			'pet_category_id' => 'required'
		]);

		$pet = Pet::find($id);

		$pet->name = $request->get('name');
		$pet->gender = $request->get('gender');
		$pet->size = $request->get('size');
		$pet->breed = $request->get('breed');
		$pet->lost_at = !$request->get('lost_at') ? NULL : \Carbon\Carbon::parse(str_replace('/', '-', $request->get('lost_at')))->format('Y-m-d');
		$pet->description = $request->get('description');
		$pet->pet_category_id = $request->get('pet_category_id');
		$pet->slug = Str::slug($request->get('name') . ' ' . $request->get('size') . ' ' .$request->get('breed'), '-');
		$pet->user_id = auth()->user()->id;

		$pet->save();

		return redirect()->route('pets.index')->with('success', 'Pet alterado com sucesso.');
	}

	public function destroy(Request $request, $id)
	{
		$pet = Pet::find($id);
		$pet->delete();

		return redirect()->route('pets.index')->with('success', 'Pet removido com sucesso.');
	}

	// Custom methods

	public function update_status(Request $request, $id)
	{
		$pet = Pet::find($id);
		$status = str_replace('"', '', $request->get('status'));

		$pet->status = $status;
		$pet->save();

		return response()->json(['message' => 'Pet alterado com sucesso.'], 200);
	}
}
