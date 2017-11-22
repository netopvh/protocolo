<ul class="icons-list">
    <li>
        <a href="{{ route('admin.tramitacao.movimento',['id' => $documento->id]) }}"
           data-popup="tooltip" title="Movimentação" data-placement="bottom">
            <i class="icon-eye-plus"></i>
        </a>
    </li>
    <li>
        <a href="{{ route('admin.tramitacao.doc.show',['id' => $documento->id]) }}"
           data-popup="tooltip" title="Visualizar Documentos" data-placement="bottom">
            <i class="icon-copy4"></i>
        </a>
    <li>
    @if(in_admin_group())
        <li>
            <a href="{{ route('admin.documento.edit',['id' => $documento->id]) }}"
               data-popup="tooltip" title="Editar" data-placement="bottom">
                <i class="icon-pencil7"></i>
            </a>
        </li>
    @endif
    <li>
        <a href="{{ route('admin.tramitacao.movimentar.index',['id' => $documento->id]) }}"
           data-popup="tooltip" title="Encaminhar" data-placement="bottom">
            <i class="icon-flip-vertical3"></i>
        </a>
    </li>
    <li>
        <a href="{{ route('admin.tramitacao.doc.arquivar',['id' => $documento->id]) }}"
           data-popup="tooltip" title="Arquivar Documentos" data-placement="bottom">
            <i class="icon-archive"></i>
        </a>
    </li>
</ul>