<div>
    <livewire:admin.layout.header />



    <div class="container py-5">
        <h2 class="mb-4 text-dark fw-bolder">Blog Post Editor</h2>

        <form wire:submit.prevent="save">
            <!-- Toolbar -->
            <div class="card mb-4 shadow-sm" wire:ignore>
                <div class="card-body d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-outline-secondary btn-sm toolbar-button" data-command="bold"><i
                            class="fas fa-bold"></i></button>
                    <button type="button" class="btn btn-outline-secondary btn-sm toolbar-button"
                        data-command="italic"><i class="fas fa-italic"></i></button>
                    <button type="button" class="btn btn-outline-secondary btn-sm toolbar-button"
                        data-command="underline"><i class="fas fa-underline"></i></button>
                    <button type="button" class="btn btn-outline-secondary btn-sm toolbar-button"
                        data-command="insertUnorderedList"><i class="fas fa-list-ul"></i></button>
                    <button type="button" class="btn btn-outline-secondary btn-sm toolbar-button"
                        data-command="insertOrderedList"><i class="fas fa-list-ol"></i></button>

                    <select id="styleDropdown" class="form-select form-select-sm toolbar-button" style="width: auto;">
                        <option value="">Style</option>
                        <option value="h1">H1</option>
                        <option value="h2">H2</option>
                        <option value="h3">H3</option>
                        <option value="h4">H4</option>
                        <option value="p">Paragraph</option>
                    </select>

                    <select id="fontDropdown" class="form-select form-select-sm toolbar-button" style="width: auto;">
                        <option value="">Font</option>
                        <option value="Arial">Arial</option>
                        <option value="Georgia">Georgia</option>
                        <option value="Courier New">Courier New</option>
                    </select>

                    <select id="fontSizeDropdown" class="form-select form-select-sm toolbar-button"
                        style="width: auto;">
                        <option value="">Size</option>
                        <option value="1">XS</option>
                        <option value="2">Small</option>
                        <option value="3">Normal</option>
                        <option value="4">Large</option>
                        <option value="5">X-Large</option>
                    </select>

                    <input type="color" id="colorPicker" class="form-control form-control-color" title="Text Color" />

                    <button type="button" id="insertLinkBtn" class="btn btn-outline-secondary btn-sm toolbar-button"><i
                            class="fas fa-link"></i></button>
                    <button type="button" id="insertImageBtn" class="btn btn-outline-secondary btn-sm toolbar-button"><i
                            class="fas fa-image"></i></button>
                    <button type="button" class="btn btn-outline-secondary btn-sm toolbar-button"
                        data-command="insertHorizontalRule"><i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-outline-secondary btn-sm toolbar-button"
                        data-command="justifyLeft"><i class="fas fa-align-left"></i></button>
                    <button type="button" class="btn btn-outline-secondary btn-sm toolbar-button"
                        data-command="justifyCenter"><i class="fas fa-align-center"></i></button>
                    <button type="button" class="btn btn-outline-secondary btn-sm toolbar-button"
                        data-command="justifyRight"><i class="fas fa-align-right"></i></button>
                    <button type="button" id="insertTableBtn" class="btn btn-outline-secondary btn-sm toolbar-button"><i
                            class="fas fa-table"></i></button>
                    <button type="button" id="toggleCodeBtn" class="btn btn-outline-primary btn-sm toolbar-button"><i
                            class="fas fa-code"></i></button>
                </div>
            </div>

            <!-- Editor -->
            <div wire:ignore class="mb-4">
                <div id="editor" contenteditable="true" class="form-control" style="min-height: 200px;"></div>
                <input type="hidden" id="postContent" wire:model="content" />
                @error('content') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <!-- Post Info -->
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="title" class="form-label">Post Title</label>
                    <input type="text" id="title" class="form-control" wire:model="title">
                    @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-6">
                    <label for="tags" class="form-label">Tags <small class="text-muted">(comma
                            separated)</small></label>
                    <input type="text" id="tags" class="form-control" wire:model="tags">
                    @error('tags') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-6">
                    <label for="alt_tag" class="form-label">image Alt Tag</label>
                    <input type="text" id="alt_tag" class="form-control" wire:model="alt_tag">
                    @error('alt_tag') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-6">
                    <label for="alt_tag" class="form-label">Select Blog Categories</label>
                    <input type="text" id="alt_tag" class="form-control" wire:model="alt_tag">
                    @error('alt_tag') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

            </div>

            <!-- SEO -->
            <div class="mt-4 p-3 bg-light rounded shadow-sm">
                <h5 class="mb-3 text-secondary">🔍 SEO Metadata</h5>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="meta_title" class="form-label">Meta Title</label>
                        <input type="text" id="meta_title" class="form-control" wire:model="meta_title">
                        @error('meta_title') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="meta_slug" class="form-label">Meta Slug</label>
                        <input type="text" id="meta_slug" class="form-control" wire:model="meta_slug">
                        @error('meta_slug') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-12">
                        <label for="meta_description" class="form-label">Meta Description</label>
                        <textarea id="meta_description" rows="3" class="form-control"
                            wire:model="meta_description"></textarea>
                        @error('meta_description') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <!-- Submit -->
            <div class="mt-4 text-end">
                <button class="btn btn-primary  px-4" type="submit">
                    Save Post
                </button>
            </div>
        </form>

        <!-- Feedback Messages -->
        @if (session()->has('message'))
            <div class="alert alert-success mt-3">{{ session('message') }}</div>
        @endif
        @if (session()->has('error'))
            <div class="alert alert-danger mt-3">{{ session('error') }}</div>
        @endif
    </div>

    <livewire:admin.layout.footer />

</div>

<!-- JS -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const editor = document.getElementById('editor');
        const postContent = document.getElementById('postContent');

        // ✅ Fill editor with Livewire content
        editor.innerHTML = @json($content ?? '');

        // Sync back to Livewire on input
        editor.addEventListener('input', () => {
            @this.set('content', editor.innerHTML);
        });

        // Toolbar handlers
        document.querySelectorAll('.toolbar-button[data-command]').forEach(button => {
            button.addEventListener('click', e => {
                e.preventDefault();
                const command = e.currentTarget.getAttribute('data-command');
                if (command === 'bold') {
                    document.execCommand('styleWithCSS', false, false);
                    document.execCommand('bold', false, null);
                } else {
                    document.execCommand('styleWithCSS', false, true);
                    document.execCommand(command, false, null);
                }
                editor.dispatchEvent(new Event('input'));
            });
        });

        document.getElementById('styleDropdown').addEventListener('change', e => {
            document.execCommand('formatBlock', false, e.target.value);
            editor.dispatchEvent(new Event('input'));
        });

        document.getElementById('fontDropdown').addEventListener('change', e => {
            document.execCommand('fontName', false, e.target.value);
            editor.dispatchEvent(new Event('input'));
        });

        document.getElementById('fontSizeDropdown').addEventListener('change', e => {
            document.execCommand('fontSize', false, e.target.value);
            editor.dispatchEvent(new Event('input'));
        });

        document.getElementById('colorPicker').addEventListener('input', function () {
            document.execCommand('styleWithCSS', false, true);
            document.execCommand('foreColor', false, this.value);
            editor.dispatchEvent(new Event('input'));
        });

        document.getElementById('insertLinkBtn').addEventListener('click', e => {
            e.preventDefault();
            const url = prompt("Enter link URL:");
            if (url) document.execCommand('createLink', false, url);
            editor.dispatchEvent(new Event('input'));
        });

        document.getElementById('insertImageBtn').addEventListener('click', e => {
            e.preventDefault();
            const url = prompt("Enter image URL:");
            if (url) document.execCommand('insertImage', false, url);
            editor.dispatchEvent(new Event('input'));
        });

        document.getElementById('insertTableBtn').addEventListener('click', e => {
            e.preventDefault();
            const rows = parseInt(prompt("Rows:"), 10);
            const cols = parseInt(prompt("Columns:"), 10);
            if (!rows || !cols) return;
            const table = document.createElement('table');
            table.style.borderCollapse = 'collapse';
            table.style.width = '100%';
            for (let i = 0; i < rows; i++) {
                const tr = document.createElement('tr');
                for (let j = 0; j < cols; j++) {
                    const td = document.createElement('td');
                    td.textContent = ' ';
                    td.style.border = '1px solid #ccc';
                    td.style.padding = '4px';
                    tr.appendChild(td);
                }
                table.appendChild(tr);
            }
            editor.appendChild(table);
            editor.dispatchEvent(new Event('input'));
        });

        let isCodeView = false;
        let savedHTML = '';
        document.getElementById('toggleCodeBtn').addEventListener('click', e => {
            e.preventDefault();
            if (!isCodeView) {
                savedHTML = editor.innerHTML;
                editor.textContent = savedHTML;
                editor.setAttribute('contenteditable', false);
            } else {
                editor.innerHTML = savedHTML;
                editor.setAttribute('contenteditable', true);
            }
            isCodeView = !isCodeView;
        });
    });
</script>