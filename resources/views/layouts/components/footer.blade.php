<!-- Icones do Font Awesome -->
<script src="https://kit.fontawesome.com/8eafe50798.js"></script>

<!-- Mascaras -->
<script defer type="text/javascript" src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>
<script defer type="text/javascript" src="{{ asset('js/jquery/jquery.inputmask.js') }}"></script>      
<script defer type="text/javascript" src="{{ asset('js/jquery/jquery.maskMoney.min.js') }}"></script>
<script defer="true" src="{{ asset('js/masks.js') }}"></script>

<!-- Datatable -->
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('js/datatables/datatables.js') }}"></script>

<!-- include summernote js -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script src="{{ asset('js/summernote_config.js') }}"></script>
<script src="{{ asset('js/summernote_atlas_config.js') }}"></script> 

<!-- include summernote-PT-Br -->
<script src="{{ asset('js/summernote/lang/summernote-pt-BR.js') }}"></script>

<!-- include simple-anime library -->
<script src="{{ asset('js/simple-anime.js') }}"></script>

<!-- app scripts -->
<script src="{{ asset('js/animation_config.js') }}"></script>

<!-- Footer -->
	<footer>
		<div class="container">
			<div class="row text-center text-xs-center text-sm-left text-md-left">
				<div class="col-xs-12 col-sm-4 col-md-4">
                    <h5>LAPA</h5>
                    <p>Laboratório de Anatomia<br/>e Patologia Animal</p>
                    <p>Avenida Bom Pastor, s/n.º<br />Bairro: Boa Vista<br/>
						CEP: 55292-270<br/>Garanhuns - PE</p>
				</div>
				<div class="col-xs-12 col-sm-4 col-md-4">
					<h5>Navegação</h5>
					<ul class="list-unstyled quick-links">
						<li><a href="{{ route('site.atlas.index') }}">Atlas Iterativo</a>
							<li><a href="{{ route('site.visita.busca') }}">Agendar Visitas</a>
							<li><a href="{{ route('site.postagens.indexEvento') }}">Eventos</a>
								<li><a href="{{ route('site.postagens.indexNoticia') }}">Notícias</a>
						<li><a href="{{ route('site.postagens.indexEdital') }}">Editais e Seleções</a>
						<li><a href="{{ route('site.materiais.index') }}">Materiais</a>
						<li><a href="{{ route('site.contato.index')}}">Sobre</a>
						@guest
							<li><a href="{{ route('login') }}">Acesso</a></li>
						@else
							<li><a href="{{ route('auth.gerenciar') }}" title="Gerenciar">Gerenciar</a></li>
							<li><a href="{{ route('auth.registros') }}" title="Minha conta">Minha conta ({{ Auth::user()->name ?? "" }})</a></li>
							<li><a title="Sair" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sair</a></li>
						@endguest
					</ul>
				</div>

				<div class="col-xs-12 col-sm-4 col-md-4">
					<h5>Contatos</h5>
				<!-- Email -->
				@php($contato = App\Contato::latest('updated_at')->first())
				@if (isset($contato->email))
					<p><b>Email:</b> 
						<a href="mailto:{{ $contato->email ?? '' }}">{{ $contato->email ?? '' }}</a>
					</p>
				@endif

				@if (isset($contato->telefone))
					<p><b>Telefone:</b>
						<a href="tel:{{ $contato->telefone ?? ''}}">{{ $contato->telefone ?? ''}}</a>	
					</p>	
				@endif

				<!-- Facebook -->
                @if(isset($contato->facebook))
                    <a class="facebook-icone" href="{{ isset($contato->facebook) ? $contato->facebook : '#' }}" target="_blank">
                        <i class="fab fa-facebook-f fa-lg white-text"></i>
                    </a>
                @endif	

				<!-- Twitter -->
                @if(isset($contato->twitter))
                    <a class="twitter-icone" href="{{ isset($contato->twitter) ? $contato->twitter : '#' }}" target="_blank">
                        <i class="fab fa-twitter fa-lg white-text"></i>
                    </a>
                @endif	
       
				<!-- Instagram -->
				@if(isset($contato->instagram))
					<a class="instagram-icone" href="{{ isset($contato->instagram) ? $contato->instagram : '#' }}" target="_blank">
						<i class="fab fa-instagram fa-lg white-text"></i>
					</a>
				@endif	
		</div>
	</div>
  <p>© {{ date('Y') }} Todos os direitos reservados.</p>
</footer>
<!-- ./Footer -->