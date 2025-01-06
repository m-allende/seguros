<div class="card-body">
    <div class="item-editor">
        <div class="item-editor__toolbar"></div>
        <div class="item-editor__editable-container">
            <div class="item-editor__editable">

            </div>
        </div>
    </div>
</div>
<link href="{{ URL::asset('css/ck-styles-item.css') }}" rel="stylesheet" type="text/css" />
<script>
    DecoupledEditor
        .create(document.querySelector('.item-editor__editable'))
        .then(editor => {
            const toolbarContainer = document.querySelector('.item-editor__toolbar');

            toolbarContainer.appendChild(editor.ui.view.toolbar.element);

            window.editor = editor;
        })
        .catch(error => {
            console.error(error);
        });
</script>
