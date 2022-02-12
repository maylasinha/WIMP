<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

use App\Models\Pet;
use App\Models\PetImage;

class PetImagesController extends Controller
{	
	public function index($pet_id)
	{
		$pet = Pet::find($pet_id);
		$pet_images = PetImage::where('pet_id', $pet_id)->get();

		return view('pet_images.index', ['title' => 'Imagens', 'pet_images' => $pet_images, 'pet' => $pet]);
	}

	public function create($pet_id)
	{
		$pet = Pet::find($pet_id);
		return view('pet_images.create', ['title' => 'Nova Imagem', 'pet' => $pet]);
	}

	public function store($pet_id, Request $request)
	{
		$request->validate([
			'image' => 'required'
		]);

		$pet = Pet::find($pet_id);

		$pet_images = PetImage::where('pet_id', $pet_id)->get();

		$pet_image = new PetImage([
			'image' => !$request->hasFile('image') ? NULL : $request->image->store('uploads/pet_images/' . $pet->slug),
			'position' => $pet_images->count() + 1,
			'pet_id' => $pet_id,
			'user_id' => auth()->user()->id
		]);

		$pet_image->save();

		return redirect()->route('pets.pet_images.index', $pet_id)->with('success', 'Imagem salva com sucesso.');
	}

	public function edit($pet_id, $id)
	{
		$pet = Pet::find($pet_id);
		$pet_image = PetImage::find($id);
		
		return view('pet_images.edit', ['title' => 'Editar Imagem', 'pet' => $pet, 'pet_image' => $pet_image]);
	}

	public function update($pet_id, Request $request, $id)
	{
		$request->validate([
			'image' => 'required'
		]);

		$pet = Pet::find($pet_id);
		$pet_image = PetImage::find($id);

		if ($request->hasFile('image')) {
			Storage::delete($request->get('current_file'));
			$pet_image->image = $request->image->store('uploads/pet_images/' . $pet->slug);
		}

		$pet_image->pet_id = $pet_id;
		$pet_image->user_id = auth()->user()->id;

		$pet_image->save();

		return redirect()->route('pets.pet_images.index', $pet_id)->with('success', 'Imagem salva com sucesso.');
	}

	public function destroy($pet_id, $id)
	{
		$pet_image = PetImage::find($id);
		$pet_image->delete();

		return redirect()->route('pets.pet_images.index', $pet_id)->with('success', 'Imagem apagada com sucesso.');
	}

	// Custom methods

	public function update_featured(Request $request, $id)
	{
		$pet_image = PetImage::find($id);
		$pet = Pet::find($pet_image->pet_id);

		$featured = str_replace('"', '', $request->get('featured'));

		if($featured == '1' && count($pet->pet_images->where('featured', '=', '1')) > 0) {
			return response()->json('Você já possui uma imagem como destaque.', 400);
		}

		$pet_image->featured = $featured;
		$pet_image->save();

		return response()->json(['message' => 'Imagem alterada com sucesso.']);
	}
}
