<div class="share p-3">
	<span class="share-option" data-toggle="tooltip" title="Facebook">
		<a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" class="share-option-btn" rel="noopener" target="_blank"><i class="fab fa-facebook fa-lg"></i></a>
	</span>
	<span class="share-option" data-toggle="tooltip" title="Pinterest">
		<a href="http://pinterest.com/pin/create/button/?url={{ url()->current() }}" class="share-option-btn" rel="noopener" target="_blank"><i class="fab fa-pinterest fa-lg"></i></a>
	</span>
	<span class="share-option" data-toggle="tooltip" title="WhatsApp">
		<a href="https://api.whatsapp.com/send?text={{ url()->current() }}" class="share-option-btn" rel="noopener" target="_blank" rel="noopener"><i class="fab fa-whatsapp fa-lg"></i></a>
	</span>
</div>