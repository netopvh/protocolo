<ul class="icons-list">
    <li>
        <a href="{{ route('admin.tramitacao.doc.show',['id' => $documento->id]) }}"
           data-popup="tooltip" title="Visualizar Documentos" data-placement="bottom">
            <i class="icon-copy4"></i>
        </a>
    <li>
    <li>
        <button name="confirm-modal" title="Receber" class="receber" data-id="{{ $documento->id }}"
                style="padding: 0 0 0 0;border: 0; background: transparent;">
            <i class="icon-file-check" style="padding-top: 2px;"></i>
        </button>
    </li>
    <li>
        <button name="confirm-modal" title="Devolver" class="devolver" data-id="{{ $documento->id }}"
                style="padding: 0 0 0 0;border: 0; background: transparent;">
            <i class="icon-redo2" style="padding-top: 2px;"></i>
        </button>
    </li>
</ul>