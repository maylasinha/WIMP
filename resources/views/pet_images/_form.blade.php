<legend class="mb-5 text-center">{{ $title }}</legend>

@include('shared.errors')

<label for="file">Imagem <small>Tamanho Ideal (1920 &bull; 1280 px)</small></label>
<div class="input-group mb-3">
	<input type="hidden" name="current_file" value="{{ @$pet_image->image }}">
	<div class="custom-file">
		<input type="file" name="image" class="custom-file-input" accept="file/*">
		<label class="custom-file-label" for="image">{{ @$pet_image->image ? basename(@$pet_image->image) : 'Selecione um arquivo...' }}</label>
	</div>
</div>

<div class="pt-5 overflow-hidden">
  <button type="submit" class="btn btn-warning px-5 float-right"><i class="fas fa-check fa-fw"></i> Salvar</button>
</div>