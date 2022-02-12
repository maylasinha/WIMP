<legend class="mb-5 text-center">{{ $title }}</legend>

@include('shared.errors')

<div class="row">
  <div class="col-sm-8">
    <div class="form-group">
      <input type="text" name="name" value="{{ old('name') ? old('name') : @$pet->name }}" class="form-control" placeholder="* Nome" required>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group">
      <select name="pet_category_id" class="form-control">
        @foreach($pet_categories as $key => $pet_category)
          <option value="{{ $pet_category->id }}" {{ @$pet->pet_category->id == $pet_category->id ? 'selected' : NULL }}>{{ $pet_category->name }}</option>
        @endforeach
      </select>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-sm-6">
    <div class="form-group">
      <select name="gender" class="form-control">
        <option value="">* Sexo</option>
        @foreach(range(0, 1) as $option)
          <option value="{{ $option }}" {{ @$pet->gender == $option ? 'selected' : NULL }}>{{ \App\Enums\PetGender::getDescription($option) }}</option>
        @endforeach
      </select>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="form-group">
      <select name="size" class="form-control">
        <option value="">* Porte</option>
        @foreach(range(0, 2) as $option)
          <option value="{{ $option }}" {{ @$pet->size == $option ? 'selected' : NULL }}>{{ \App\Enums\PetSize::getDescription($option) }}</option>
        @endforeach
      </select>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-sm-6">
    <div class="form-group">
      <input type="text" name="breed" value="{{ old('breed') ? old('breed') : @$pet->breed }}" class="form-control" placeholder="* Raça" required>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="form-group">
      <input type="text" name="lost_at" value="{{ old('lost_at') ? old('lost_at') : (!@$pet->lost_at ? NULL : \Carbon\Carbon::parse(@$pet->lost_at)->format('d/m/Y')) }}" class="form-control date" placeholder="* Data do desaparecimento" required>
    </div>
  </div>
</div>

<div class="form-group">
  <textarea name="description" class="form-control" rows="4" placeholder="* Descrição" required>{{ old('description') ? old('description') : @$pet->description }}</textarea>
</div>

<div class="pt-5 overflow-hidden">
  <a href="{{ route('pets.index') }}" class="btn btn-link"><i class="fas fa-angle-double-left fa-fw"></i> Voltar</a>
  <button type="submit" class="btn btn-warning px-5 float-right"><i class="fas fa-check fa-fw"></i> Salvar</button>
</div>
