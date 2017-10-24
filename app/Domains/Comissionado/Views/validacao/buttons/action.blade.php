<ul class="icons-list">
    @permission('criar-validacao')
        @if($servidor->validado == 'N')
            <li><a href="{{ route('admin.validacao.find',['id' => $servidor->id]) }}"
                   data-popup="tooltip" title="Validar" data-placement="bottom"><i
                            class="icon-file-check"></i></a>
            <li>
        @endif
    @endpermission
    @permission('atualizar-validacao')
        @if($servidor->validado == 'S' || $servidor->validado == 'P')
        <li><a href="{{ route('admin.validacao.revalidar',['id' => $servidor->id]) }}"
               data-popup="tooltip" title="Re-validar" data-placement="bottom"><i
                        class="icon-paste2"></i></a>
        </li>
        @endif
    @endpermission
</ul>