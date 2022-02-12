<legend class="mb-5 text-center">{{ $title }}</legend>

@include('shared.errors')

<div class="p-3 mb-3 border rounded" style="border-style: dashed !important;">
  <p class="mb-0">Aceitamentos elogios, conte como o Wimp ajudou você a encontrar o seu pet.</p>
</div>

<div class="form-group">
  <textarea name="description" class="form-control" rows="4" placeholder="* Descrição" required>{{ old('description') ? old('description') : @$testimonial->description }}</textarea>
</div>

<div class="pt-5 overflow-hidden">
  <a href="{{ route('testimonials.index') }}" class="btn btn-link"><i class="fas fa-angle-double-left fa-fw"></i> Voltar</a>
  <button type="submit" class="btn btn-warning px-5 float-right"><i class="fas fa-check fa-fw"></i> Salvar</button>
</div>
