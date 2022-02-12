<li class="sidebar-item">
	<a class="sidebar-link sidebar-link" href="{{ route('admin.home') }}" aria-expanded="false">
		<i data-feather="home" class="feather-icon"></i><span class="hide-menu">Dashboard</span>
	</a>
</li>
<li class="list-divider"></li>
<li class="nav-small-cap">
	<span class="hide-menu">Site</span>
</li>
@can('editar informacoes basicas')
	<li class="sidebar-item">
		<a class="sidebar-link" href="{{ route('admin.info.edit', 1) }}" aria-expanded="false">
			<i data-feather="info" class="feather-icon"></i><span class="hide-menu">Informações Básicas</span>
		</a>
	</li>
@endcan

@canany(['visualizar pagina', 'criar pagina', 'editar pagina', 'apagar pagina'])
	<li class="sidebar-item">
		<a class="sidebar-link" href="{{ route('admin.pages.index') }}" aria-expanded="false">
			<i data-feather="file-text" class="feather-icon"></i><span class="hide-menu">Páginas</span>
		</a>
	</li>
@endcanany

@canany(['criar categoria de pets', 'editar categoria de pets', 'apagar categoria de pets'])
	<li class="sidebar-item">
		<a class="sidebar-link" href="{{ route('admin.pet_categories.index') }}" aria-expanded="false">
			<i data-feather="tag" class="feather-icon"></i><span class="hide-menu">Categorias de Pets</span>
		</a>
	</li>
@endcanany

@canany(['visualizar depoimento', 'criar depoimento', 'editar depoimento', 'apagar depoimento'])
	<li class="sidebar-item">
		<a class="sidebar-link" href="{{ route('admin.testimonials.index') }}" aria-expanded="false">
			<i data-feather="message-circle" class="feather-icon"></i><span class="hide-menu">Depoimentos</span>
		</a>
	</li>
@endcanany

@role('admin')
	<li class="list-divider"></li>
	<li class="nav-small-cap">
		<span class="hide-menu">Painel Administrador</span>
	</li>
	<li class="sidebar-item">
		<a class="sidebar-link sidebar-link" href="{{ route('admin.roles.index') }}" aria-expanded="false">
			<i data-feather="settings" class="feather-icon"></i><span class="hide-menu">Perfis de Acesso</span>
		</a>
	</li>
	<li class="sidebar-item">
		<a class="sidebar-link sidebar-link" href="{{ route('admin.users.index') }}" aria-expanded="false">
			<i data-feather="users" class="feather-icon"></i><span class="hide-menu">Usuários</span>
		</a>
	</li>
@endrole