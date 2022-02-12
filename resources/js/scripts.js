$(function () {
	// Bootstrap 
	$('[data-toggle="tooltip"]').tooltip();
	$('[data-toggle="popover"]').popover();

	// Masks
	$('.phone').mask('(00) 0000-0000', { clearIfNotMatch: true });
	$('.cellphone').mask('(00) 00000-0000', { clearIfNotMatch: true });
	$('.cpf').mask('000.000.000-00', { clearIfNotMatch: true });
	$('.cnpj').mask('00.000.000/0000-00', { clearIfNotMatch: true });
	$('.postal_code').mask('00000-000', { clearIfNotMatch: true });
	$('.date').mask('00/00/0000', { clearIfNotMatch: true });
	$('.date_without_year').mask('00/00', { clearIfNotMatch: true });
	$('.hour').mask('00:00', { clearIfNotMatch: true });
	$('.money').mask('000.000.000.000.000,00', { reverse: true });

	// Slick
	$('.testimonials__slide').slick({
		slidesToShow: 1,
		autoplay: true,
		dots: true
	});

	var phoneCellphone = function (val) {
		return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
	},
	spOptions = {
		onKeyPress: function(val, e, field, options) {
			field.mask(phoneCellphone.apply({}, arguments), options);
		}
	};

	$('.phone_cellphone').mask(phoneCellphone, spOptions);

	// For Custom File Input
	$('.custom-file-input').on('change', function () {
    //get the file name
    var fileName = $(this).val();
    //replace the "Choose a file" label
    $(this).next('.custom-file-label').html(fileName);
	});

	// Back to top
	$('#back-to-top').on('click', function(e) {
		e.preventDefault();
		$('html, body').animate({
			scrollTop: 0
		}, 700);
	});

	$(window).scroll(function() {
		if ($(this).scrollTop() >= 50) {
			$('#back-to-top').fadeIn(200);
		} else {
			$('#back-to-top').fadeOut(200);
		}
	});
});

window.enableSubmit = function() {
  $('[type="submit"]').removeAttr('disabled');
  $('[type="submit"]').css('pointer-events', 'auto');
}

window.disableSubmit = function() {
  $('[type="submit"]').attr('disabled', true).css('pointer-events', 'none');
}

// Form step
$(document).on('click', '.form-step fieldset .btn-next', function(e) {
	e.preventDefault();

	var parent_step = $(this).parents('fieldset'),
			next_step = true;
	
	parent_step.find('[required]').not('[type="hidden"], [disabled="disabled"]').each(function() {
		if($(this).val() == '' || $(this).val() == null || $(this).val() == undefined) {
			$(this).addClass('is-invalid');
			next_step = false;
		} else if($(this).is(':radio') || $(this).is(':checkbox')) {
			var inputName = $(this).attr('name');

			if (!$('[name="' + inputName + '"]').is(':checked')) {
				next_step = false;
				$(this).parents('.radio-group').addClass('border-danger');
			} else {
				$(this).parents('.radio-group').removeClass('border-danger');
			}
		} else {
			$(this).removeClass('is-invalid');
		}
	});


	if(!next_step) {
		notify('<i class="fas fa-exclamation-triangle fa-fw"></i> Preencha todos os campos', 'error');
	} else {
		parent_step.fadeOut(400, function() {
			$(this).next().fadeIn();
		});
	}
});

$(document).on('click', '.form-step fieldset .btn-previous', function(e) {
	e.preventDefault();
	
	var parent_step = $(this).parents('fieldset');

	parent_step.fadeOut(400, function() {
		$(this).prev().fadeIn();
	});
});

// List registers
$(document).on('click', '.list-items', function(e) {
	e.preventDefault();

	var url = $(this).data('url'),
			small = $(this).data('small'),
			large = $(this).data('large'),
			title = $(this).data('title');

	if(small == true) {
		$('#modal-list').find('.modal-dialog').addClass('modal-sm');
	}

	if(large == true) {
		$('#modal-list').find('.modal-dialog').addClass('modal-lg');
	}

	$('#modal-list').find('.modal-title').html(title);
	$('#modal-list').find('.modal-body').html('<div class="p-4 text-center"><i class="fas fa-spinner fa-spin"></i></div>');

	$('#modal-list').find('.modal-body').load(url, function(responseTxt, statusTxt, xhr) {
		
	}).on('show.bs.modal', function (event) {
			
	});
});

// Get location by postal code
window.getLocation = function(that, e) {
	var postalCode = $(that).val();

	if (postalCode.length < 9) {
		return false;
	}

	$('.postal_code').after('<i class="fas fa-redo fa-spin"></i>');

	$.get('https://viacep.com.br/ws/' + postalCode + '/json/', function(data) {
		if (data.erro) {
			notify('<div class="alert alert-warning">Cep inválido, digite novamente.</div>', 'warning');
		} else {
			$('[name="public_place"]').val(data.logradouro);
			$('[name="neighborhood"]').val(data.bairro);
			$('[name="complement"]').val(data.complemento);
			$('[name="state_id"] option').filter(function () { return $(this).data('uf') == data.uf; }).attr('selected', true);
			$('[name="state_id"]').trigger('change');
			setTimeout(function() {
				$('[name="city_id"] option').filter(function () { return $(this).text() == data.localidade; }).attr('selected', true);
			}, 2000);
		}

		$('form .fa-redo').remove();
	});
}

// Update status
window.updateStatus = function(that, e) {
  var token = $(that).data('token'),
      controller = $(that).data('controller'),
      id = $(that).data('id'),
      value = $(that).find('input[type="checkbox"]').val();

  if (value == 0) {
    $(that).find('input').val(1);
  } else {
    $(that).find('input').val(0);
  }

  $.ajax({
    url: APP_URL + '/' + controller + '/update_status/' + id,
    type: 'POST',
    data: { _token: token, status: value },
    success: function(result) {
      notify('<i class="fas fa-check fa-fw"></i> ' + result.message, 'success');
    },
    error: function(xhr) {
      notify('<i class="fas fa-times fa-fw"></i> ' + xhr.responseText, 'error');
    }
  });
}

// Update featured
window.updateFeatured = function(that, e) {
  var token = $(that).data('token'),
      controller = $(that).data('controller'),
      id = $(that).data('id'),
      value = $(that).data('value');

  if (value === 0) {
    $(that).data('value', 1);
    value = 1;
  } else {
    $(that).data('value', 0);
    value = 0;
  }

  $.ajax({
    url: APP_URL + '/' + controller + '/update_featured/' + id,
    type: 'POST',
    data: { _token: token, featured: value },
    success: function(result) {
      if ($(that).find('.fas').length > 0) {
        $(that).html('<i class="far fa-star" aria-hidden="true"></i>');
      } else {
        $(that).html('<i class="fas fa-star" aria-hidden="true"></i>');
      }

      notify('<i class="fas fa-check fa-fw"></i> ' + result.message, 'success');
    },
    error: function(xhr) {
      notify('<i class="fas fa-times fa-fw"></i> ' + xhr.responseJSON, 'error');
    }
  });
}

// Set current Business Unit
window.createPetComment = function(that, e) {
	e.preventDefault();
	var url = $(that).attr('action'),
			data = $(that).serializeArray(),
			token = $('meta[name="csrf-token"]').attr('content');

	data.push({ name: '_token', value: token });

	$(that).find('[type="submit"]').attr('disabled', true);

	i = 0;
	var wait = setInterval(function() {
		i = ++i % 4;
		$(that).find('[type="submit"]').text('Enviando'+Array(i+1).join('.'));
	}, 500);

	$.ajax({
		url: url,
		type: 'POST',
		data: data,
		success: function(result) {
			$('#pet-comments').html(result.html);
			clearInterval(wait);
			wait = 0;
			$(that).find('[type="submit"]').removeAttr('disabled');

			notify('<i class="fas fa-check fa-fw"></i> Comentário salva com sucesso.', 'success');
		},
		error: function(xhr) {
			clearInterval(wait);
			wait = 0;
			$(that).find('[type="submit"]').replaceWith('<button type="submit" class="btn btn-warning btn-sm px-3 float-right"><i class="fas fa-check fa-fw"></i> Enviar</button>');

			notify('<i class="fas fa-times fa-fw"></i> ' + xhr.responseJSON, 'error');
		}
	});
}

// Notify
window.notify = function(msg, type) {
  new Noty({
		text: msg,
		layout: 'bottomRight',
		type: type,
		theme: 'mint',
		timeout: 3000
	}).show();
}