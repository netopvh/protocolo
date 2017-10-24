<ul class="icons-list">
    @ability('superadministrador,administrador', 'ver-servidores')
         @if(in_admin_group())
            <li><a href="{{ route('admin.servidores.show',['id' => $servidor->id]) }}"
               data-popup="tooltip" title="Visualizar" data-placement="bottom"><i
                        class="icon-eye"></i></a>
            <li>
        @elseif(auth()->user()->servidor_id == $servidor->id)
            <li><a href="{{ route('admin.servidores.show',['id' => $servidor->id]) }}"
               data-popup="tooltip" title="Visualizar" data-placement="bottom"><i
                        class="icon-eye"></i></a>
            <li>
        @endif
    @endability
    @permission('atualizar-servidores')
        @if(in_admin_group())
        <li><a href="{{ route('admin.servidores.edit',['id' => $servidor->id]) }}"
               data-popup="tooltip" title="Editar" data-placement="bottom"><i
                        class="icon-pencil7"></i></a>
        </li>
        @elseif(auth()->user()->servidor_id == $servidor->id)
        <li><a href="{{ route('admin.servidores.edit',['id' => $servidor->id]) }}"
               data-popup="tooltip" title="Editar" data-placement="bottom"><i
                        class="icon-pencil7"></i></a>
        </li>
        @endif
    @endpermission
</ul>