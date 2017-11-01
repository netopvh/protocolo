<ul class="icons-list">
    <li><a href="{{ route('admin.documento.show',['id' => $documento->id]) }}"
       data-popup="tooltip" title="Visualizar Documentos" data-placement="bottom"><i
                class="icon-copy4"></i></a>
    <li>
    <li>
        <a href="{{ route('admin.documento.edit',['id' => $documento->id]) }}"
           data-popup="tooltip" title="Editar" data-placement="bottom"><i
                    class="icon-pencil7"></i>
        </a>
    </li>
    <li>
        <form class="form-delete"
              action="{{ route('admin.documento.destroy',['id'=>$documento->id]) }}"
              method="POST">
            <input type="hidden" name="id" value="">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <button name="delete-modal" data-popup="tooltip" title="Remover" data-placement="bottom" class="delete"
                    style="padding: 0 0 0 0;border: 0; background: transparent;">
                <i
                        class="icon-trash" style="padding-top: 2px;"></i>
            </button>
        </form>
    </li>
</ul>