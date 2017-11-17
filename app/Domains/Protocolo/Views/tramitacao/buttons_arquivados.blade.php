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
</ul>