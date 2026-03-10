<div>
    <livewire:seller.layout.header />

    <div class="d-flex flex-wrap">
        <div class="col-12 col-lg-3">
            <livewire:components.create-website-navbar />
        </div>
        <div class="col-12 col-lg-9">
            <div class="container my-4">
                <div class="card">
                    <div class="card-body" x-data
                        @submit.prevent="$refs.hiddenTextarea.value = $refs.editor.innerHTML; $wire.description = $refs.hiddenTextarea.value">

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h2 class="fw-bold text-primary">Privacy Policy</h2>
                        </div>

                        <form id="formAccountSettings" wire:submit.prevent="AddPolicy">
                            <div class="mb-3">
                                <label for="description" class="form-label">DESCRIPTION</label>

                                <!-- Hidden textarea connected to Livewire -->
                                <textarea class="form-control d-none" x-ref="hiddenTextarea" wire:model.defer="description" id="description"
                                    name="description"></textarea>

                                <!-- Toolbar -->
                                <div class="editor-toolbar mb-2 bg-light p-2 rounded-top border">
                                    <button type="button" class="btn btn-outline-secondary"
                                        onclick="wrapWithTag('b')"><b>B</b></button>
                                    <button type="button" class="btn btn-outline-secondary"
                                        onclick="formatText('italic')"><i>I</i></button>
                                    <button type="button" class="btn btn-outline-secondary"
                                        onclick="formatText('underline')"><u>U</u></button>
                                    <button type="button" class="btn btn-outline-secondary"
                                        onclick="formatText('insertUnorderedList')">&#8226;</button>
                                    <button type="button" class="btn btn-outline-secondary"
                                        onclick="formatText('insertOrderedList')">1</button>
                                    <button type="button" class="btn btn-outline-secondary"
                                        onclick="formatText('justifyLeft')">
                                        <i class="fa-solid fa-align-left"></i></button>
                                    <button type="button" class="btn btn-outline-secondary"
                                        onclick="formatText('justifyCenter')">
                                        <i class="fa-solid fa-align-center"></i></button>
                                    <button type="button" class="btn btn-outline-secondary"
                                        onclick="formatText('justifyRight')">
                                        <i class="fa-solid fa-align-right"></i></button>
                                </div>

                                <!-- Contenteditable editor -->
                                <div id="descriptionEditor" x-ref="editor" class="form-control editor-content"
                                    contenteditable="true">
                                </div>
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <button type="reset" class="btn btn-outline-secondary"
                                    onclick="resetEditor()">Cancel</button>
                            </div>
                        </form>
                    </div>

                    <style>
                        .editor-toolbar button {
                            margin-right: 5px;
                        }

                        .editor-content {
                            min-height: 200px;
                            border: 1px solid #ccc;
                            padding: 10px;
                            border-radius: 5px;
                            background: white;
                            overflow-y: auto;
                        }
                    </style>

                    <script>
                        function formatText(command, value = null) {
                            document.execCommand(command, false, value);
                        }

                        function wrapWithTag(tag) {
                            const sel = window.getSelection();
                            if (!sel.rangeCount) return;

                            const range = sel.getRangeAt(0);
                            const selectedText = range.extractContents();
                            const wrapper = document.createElement(tag);
                            wrapper.appendChild(selectedText);
                            range.insertNode(wrapper);

                            // Move cursor after inserted tag
                            range.setStartAfter(wrapper);
                            range.setEndAfter(wrapper);
                            sel.removeAllRanges();
                            sel.addRange(range);
                        }

                        function resetEditor() {
                            document.getElementById('descriptionEditor').innerHTML = '';
                            document.getElementById('description').value = '';
                        }

                        window.addEventListener('populateEditor', event => {
                            const html = event.detail;

                            // clean pasted HTML if needed
                            document.getElementById('descriptionEditor').innerHTML = html;
                            document.getElementById('description').value = html;
                        });
                    </script>

                </div>
                <div class="card mt-4 border-0 shadow-sm">
                    <div class="card-body p-4">
                        @if ($policies)
                            <div class="table-responsive">
                                <table class="table table-striped align-middle text-center">
                                    <thead class="bg-primary text-white">
                                        <tr>
                                            <th>No.</th>
                                            <th>Description</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($policies as $item)
                                            <tr @if($isEdit && $policyId == $item['id']) style="background-color: #e7fda9;" @endif>
                                                <td class="fw-bold">{{ $loop->iteration }}</td>
                                                <td class="text-start">{!! $item['description'] !!}</td>
                                                <td>
                                                    <button class="btn btn-sm btn-warning"
                                                        wire:click="editPolicy({{ $item['id'] }})">
                                                        <i class="fa fa-edit me-1"></i>Edit
                                                    </button>
                                                    <button class="btn btn-sm btn-danger"
                                                        wire:click="DeletePolicy({{ $item['id'] }})">
                                                        <i class="fa fa-trash me-1"></i>Delete
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
