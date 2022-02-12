@if($pet_comments->isEmpty())
  <p class="mb-0 text-center">Nenhum comentário até o momento.</p>
@else
  @foreach($pet_comments as $key => $pet_comment)
    <div class="media mb-3">
      <img src="https://ui-avatars.com/api/?name={{ $pet_comment->name }}&background=555&color=fff" class="mr-3" alt="{{ $pet_comment->name }}">
      <div class="media-body">
        <h5 class="mt-0">{{ $pet_comment->name }}</h5>
        <p>{{ $pet_comment->description }}</p>
      </div>
    </div>
  @endforeach
@endif

<h6 class="line-title mt-5 mb-4">
  <span class="bg-white">Adicionar Comentário</span>
</h6>

<form action="{{ route('pets.pet_comments.store', $pet->id) }}" method="post" onsubmit="createPetComment(this, event)">
  @csrf
  <div class="form-group">
    <input type="text" name="name" value="{{ !auth()->check() ? NULL : auth()->user()->name }}" class="form-control" placeholder="* Nome" required>
  </div>

  <div class="form-group">
    <textarea name="description" class="form-control" rows="4" placeholder="* Descrição" required></textarea>
  </div>

  <div class="pt-3 overflow-hidden">
    <button type="submit" class="btn btn-warning btn-sm px-3 float-right"><i class="fas fa-check fa-fw"></i> Enviar</button>
  </div>
</form>