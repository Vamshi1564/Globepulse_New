<!-- <div style="position: relative; width: 100%;" id="searchbar-wrapper">

    <form wire:submit.prevent="submitSearch">
        <div class="alibaba-search-bar" id="search-bar-box">

            <select wire:model="searchType" class="alibaba-select">
                <option value="product">Products</option>
                <option value="buylead">Buy Leads</option>
            </select>

            <div class="alibaba-divider"></div>

            {{-- 
                NO wire:model here.
                JS reads the value and calls $wire.search(value) manually.
                This works on ALL Livewire versions.
            --}}
            <input
                type="text"
                id="search-input"
                value="{{ $searchTerm }}"
                placeholder="Search products, categories..."
                autocomplete="off"
                class="alibaba-input"
            />

            <button type="submit" class="alibaba-btn">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2.5"
                     stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"/>
                    <path d="M21 21l-4.35-4.35"/>
                </svg>
                Search
            </button>

        </div>
    </form>

    {{-- DROPDOWN — rendered by Livewire on server, shown/hidden by JS --}}
    <div
        id="search-dropdown"
        style="display: {{ $showDropdown ? 'block' : 'none' }};"
        class="alibaba-dropdown"
    >
        @if($showDropdown)

            @if(count($suggestions['products']) > 0)
                <div class="alibaba-section-label">Products</div>
                @foreach($suggestions['products'] as $item)
                    <div class="alibaba-item"
                         wire:key="p-{{ $item['id'] }}"
                         wire:click="selectSuggestion('{{ e($item['name']) }}')"
                         onclick="document.getElementById('search-input').value = '{{ e($item['name']) }}'">
                        <span class="alibaba-item-icon">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
                        </span>
                        <span class="alibaba-item-text">{!! searchHighlight($item['name'], $searchTerm) !!}</span>
                        <span class="alibaba-item-badge">Product</span>
                    </div>
                @endforeach
            @endif

            @if(count($suggestions['categories']) > 0)
                <div class="alibaba-section-label">Categories</div>
                @foreach($suggestions['categories'] as $item)
                    <div class="alibaba-item"
                         wire:key="c-{{ $item['id'] }}"
                         wire:click="selectSuggestion('{{ e($item['name']) }}')"
                         onclick="document.getElementById('search-input').value = '{{ e($item['name']) }}'">
                        <span class="alibaba-item-icon">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>
                        </span>
                        <span class="alibaba-item-text">{!! searchHighlight($item['name'], $searchTerm) !!}</span>
                        <span class="alibaba-item-badge">Category</span>
                    </div>
                @endforeach
            @endif

            @if(count($suggestions['buyleads']) > 0)
                <div class="alibaba-section-label">Buy Leads</div>
                @foreach($suggestions['buyleads'] as $item)
                    <div class="alibaba-item"
                         wire:key="b-{{ $item['id'] }}"
                         wire:click="selectSuggestion('{{ e($item['title']) }}')"
                         onclick="document.getElementById('search-input').value = '{{ e($item['title']) }}'">
                        <span class="alibaba-item-icon">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.8a2 2 0 012-2.18h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6z"/></svg>
                        </span>
                        <span class="alibaba-item-text">{!! searchHighlight($item['title'], $searchTerm) !!}</span>
                        <span class="alibaba-item-badge">Buy Lead</span>
                    </div>
                @endforeach
            @endif

            @if(
                count($suggestions['products'])   === 0 &&
                count($suggestions['categories']) === 0 &&
                count($suggestions['buyleads'])   === 0
            )
                <div class="alibaba-no-results">
                    No results found for "<strong>{{ $searchTerm }}</strong>"
                </div>
            @endif

        @endif
    </div>

</div>

{{-- ── JAVASCRIPT ────────────────────────────────────────────── --}}
<script>
(function () {
    const input    = document.getElementById('search-input');
    const dropdown = document.getElementById('search-dropdown');
    const wrapper  = document.getElementById('searchbar-wrapper');
    const barBox   = document.getElementById('search-bar-box');

    let debounceTimer = null;

    // Debounced input handler — calls Livewire server method directly
    input.addEventListener('input', function () {
        const val = this.value;

        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(function () {
            // This calls the public search() method on the Livewire component
            // Works on both Livewire 2 (@this) and Livewire 3 ($wire)
            const wire = window.Livewire
                ? (typeof Livewire.find === 'function'
                    ? Livewire.find(wrapper.closest('[wire\\:id]')?.getAttribute('wire:id'))
                    : null)
                : null;

            if (wire) {
                wire.call('search', val);
            } else {
                // Fallback: trigger via the closest Livewire component element
                const componentEl = wrapper.closest('[wire\\:id]');
                if (componentEl && window.Livewire) {
                    Livewire.find(componentEl.getAttribute('wire:id')).call('search', val);
                }
            }
        }, 300);
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function (e) {
        if (!wrapper.contains(e.target)) {
            dropdown.style.display = 'none';
            barBox.classList.remove('is-open');
        }
    });

    // Open border style when focused
    input.addEventListener('focus', function () {
        if (dropdown.style.display === 'block') {
            barBox.classList.add('is-open');
        }
    });

    // Livewire finished re-rendering — sync dropdown visibility
    document.addEventListener('livewire:update', syncDropdown);
    document.addEventListener('livewire:load',   syncDropdown);

    // Livewire 3 hook
    if (window.Livewire) {
        Livewire.hook('commit', ({ component, commit, respond, succeed, fail }) => {
            succeed(({ snapshot, effect }) => {
                syncDropdown();
            });
        });
    }

    function syncDropdown() {
        // Read the actual display value Livewire rendered into the DOM
        const isVisible = dropdown.style.display === 'block'
            || dropdown.getAttribute('data-show') === 'true';

        if (isVisible) {
            barBox.classList.add('is-open');
        } else {
            barBox.classList.remove('is-open');
        }
    }
})();
</script>

{{-- ── STYLES ────────────────────────────────────────────────── --}}
<style>
[x-cloak] { display: none !important; }

.alibaba-search-bar {
    display: flex;
    align-items: center;
    background: #fff;
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    height: 52px;
    transition: border-color .2s, border-radius .2s;
    position: relative;
}
.alibaba-search-bar:focus-within,
.alibaba-search-bar.is-open {
    border-color: #ff6a00;
    border-bottom-left-radius: 0;
    border-bottom-right-radius: 0;
}

.alibaba-select {
    height: 100%;
    padding: 0 10px 0 14px;
    border: none;
    background: transparent;
    font-size: 14px;
    color: #333;
    outline: none;
    min-width: 110px;
    cursor: pointer;
}

.alibaba-divider {
    width: 1px;
    height: 24px;
    background: #e5e7eb;
    flex-shrink: 0;
}

.alibaba-input {
    flex: 1;
    height: 100%;
    padding: 0 16px;
    border: none;
    outline: none;
    font-size: 15px;
    color: #111;
    background: transparent;
}
.alibaba-input::placeholder { color: #b0b3b8; }

.alibaba-btn {
    display: flex;
    align-items: center;
    gap: 7px;
    height: 100%;
    padding: 0 24px;
    background: linear-gradient(135deg, #ff6a00, #ff8c38);
    color: #fff;
    border: none;
    border-radius: 0 10px 10px 0;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
    white-space: nowrap;
    transition: opacity .15s;
}
.alibaba-btn:hover { opacity: .9; }

.alibaba-dropdown {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: #fff;
    border: 2px solid #ff6a00;
    border-top: none;
    border-radius: 0 0 12px 12px;
    box-shadow: 0 8px 24px rgba(0,0,0,.10);
    z-index: 99999;
    max-height: 420px;
    overflow-y: auto;
}
.alibaba-dropdown::-webkit-scrollbar { width: 4px; }
.alibaba-dropdown::-webkit-scrollbar-thumb { background: #e5e7eb; border-radius: 4px; }

.alibaba-section-label {
    padding: 8px 18px 5px;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .07em;
    color: #9ca3af;
    background: #fafafa;
    border-bottom: 1px solid #f3f4f6;
}

.alibaba-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 18px;
    cursor: pointer;
    border-bottom: 1px solid #f9fafb;
    transition: background .1s;
}
.alibaba-item:hover { background: #fff5ee; }
.alibaba-item:last-child { border-bottom: none; }

.alibaba-item-icon { color: #c0c4cc; display: flex; align-items: center; flex-shrink: 0; }

.alibaba-item-text { flex: 1; font-size: 14px; color: #374151; }
.alibaba-item-text .highlight { font-weight: 700; color: #111; }

.alibaba-item-badge {
    font-size: 11px;
    color: #9ca3af;
    background: #f3f4f6;
    border-radius: 4px;
    padding: 2px 7px;
    white-space: nowrap;
    flex-shrink: 0;
}

.alibaba-no-results {
    padding: 18px;
    font-size: 14px;
    color: #6b7280;
    text-align: center;
}
</style> -->