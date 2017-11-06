<ul class="icons-list">
    <li>
        <a href="{{ route('admin.tramitacao.doc.show',['id' => $documento->id]) }}"
           data-popup="tooltip" title="Visualizar Documentos" data-placement="bottom">
            <i class="icon-copy4"></i>
        </a>
    <li>
    <li>
        <button name="confirm-modal" title="Receber" class="receber" data-id="{{ $documento->id }}" data-value="R"
                style="padding: 0 0 0 0;border: 0; background: transparent;">
            <i class="icon-file-check" style="padding-top: 2px;"></i>
        </button>
    </li>
</ul>