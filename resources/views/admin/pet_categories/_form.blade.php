@include('shared.errors')

<div class="form-group">
	<label class="form-control-label required" for="name">Nome</label>
	<input type="text" name="name" value="{{ old('name') ? old('name') : @$pet_category->name }}" class="form-control" required>
</div>

<div class="form-group">
	<label class="form-control-label" for="description">Descrição</label>
	<textarea name="description" class="form-control" rows="4">{{ old('description') ? old('description') : @$pet_category->description }}</textarea>
</div>

<div class="pt-5 text-right">
	<input class="btn btn-info px-5" type="submit" value="Salvar">
</div>