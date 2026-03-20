{{-- Add this once in your main layout if not already present --}}
{{-- <style>[x-cloak]{display:none!important}</style> --}}

<div
    x-data="{ open: @entangle('showDropdown').live }"
    @click.outside="open = false; $wire.closeDropdown()"
    style="position: relative; width: 100%;"
>

    {{-- ─── SEARCH BAR ─────────────────────────────────────────── --}}
    <form wire:submit.prevent="submitSearch">
        <div class="alibaba-search-bar" :class="open ? 'dropdown-open' : ''">

            {{-- Category Select --}}
            <select class="alibaba-select" wire:model="searchType">
                <option value="product">Products</option>
                <option value="buylead">Buy Leads</option>
            </select>

            <div class="alibaba-divider"></div>

            {{-- Text Input --}}
            <input
                type="text"
                wire:model.live.debounce.300ms="searchTerm"
                class="alibaba-input"
                placeholder="Search products, suppliers, categories..."
                autocomplete="off"
                @focus="open = $wire.showDropdown"
            />

            {{-- Search Button --}}
            <button type="submit" class="alibaba-btn">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2.5"
                     stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"/>
                    <path d="M21 21l-4.35-4.35"/>
                </svg>
                Search
            </button>

        </div>
    </form>

    {{-- ─── DROPDOWN ────────────────────────────────────────────── --}}
    <div
        class="alibaba-dropdown"
        x-show="open"
        x-cloak
        x-transition:enter="dropdown-enter"
        x-transition:enter-start="dropdown-enter-start"
        x-transition:enter-end="dropdown-enter-end"
    >

        {{-- PRODUCTS --}}
        @if(count($suggestions['products']) > 0)
            <div class="alibaba-section-label">Products</div>
            @foreach($suggestions['products'] as $item)
                <div
                    class="alibaba-suggestion-item"
                    wire:key="p-{{ $item['id'] }}"
                    wire:click="selectSuggestion('{{ e($item['name']) }}')"
                >
                    <span class="alibaba-suggestion-icon">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2"
                             stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8"/>
                            <path d="M21 21l-4.35-4.35"/>
                        </svg>
                    </span>
                    <span class="alibaba-suggestion-text">
                        {!! \App\Helpers\SearchHelper::highlight($item['name'], $searchTerm) !!}
                    </span>
                    <span class="alibaba-suggestion-tag">Product</span>
                </div>
            @endforeach
        @endif

        {{-- CATEGORIES --}}
        @if(count($suggestions['categories']) > 0)
            <div class="alibaba-section-label">Categories</div>
            @foreach($suggestions['categories'] as $item)
                <div
                    class="alibaba-suggestion-item"
                    wire:key="c-{{ $item['id'] }}"
                    wire:click="selectSuggestion('{{ e($item['name']) }}')"
                >
                    <span class="alibaba-suggestion-icon">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2"
                             stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="3" width="7" height="7"/>
                            <rect x="14" y="3" width="7" height="7"/>
                            <rect x="3" y="14" width="7" height="7"/>
                            <rect x="14" y="14" width="7" height="7"/>
                        </svg>
                    </span>
                    <span class="alibaba-suggestion-text">
                        {!! \App\Helpers\SearchHelper::highlight($item['name'], $searchTerm) !!}
                    </span>
                    <span class="alibaba-suggestion-tag">Category</span>
                </div>
            @endforeach
        @endif

        {{-- BUY LEADS --}}
        @if(count($suggestions['buyleads']) > 0)
            <div class="alibaba-section-label">Buy Leads</div>
            @foreach($suggestions['buyleads'] as $item)
                <div
                    class="alibaba-suggestion-item"
                    wire:key="b-{{ $item['id'] }}"
                    wire:click="selectSuggestion('{{ e($item['title']) }}')"
                >
                    <span class="alibaba-suggestion-icon">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2"
                             stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.8 19.79 19.79 0 01.22 1.18 2 2 0 012.22 0h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/>
                        </svg>
                    </span>
                    <span class="alibaba-suggestion-text">
                        {!! \App\Helpers\SearchHelper::highlight($item['title'], $searchTerm) !!}
                    </span>
                    <span class="alibaba-suggestion-tag">Buy Lead</span>
                </div>
            @endforeach
        @endif

        {{-- NO RESULTS --}}
        @if(
            count($suggestions['products']) === 0 &&
            count($suggestions['categories']) === 0 &&
            count($suggestions['buyleads']) === 0
        )
            <div class="alibaba-no-results">
                No results found for "<strong>{{ $searchTerm }}</strong>"
            </div>
        @endif

    </div>

</div>


{{-- ─── STYLES ──────────────────────────────────────────────────── --}}
<style>
/* Search bar wrapper */
.alibaba-search-bar {
    display: flex;
    align-items: center;
    background: #fff;
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    overflow: visible;
    transition: border-color 0.2s;
    height: 52px;
}
.alibaba-search-bar:focus-within,
.alibaba-search-bar.dropdown-open {
    border-color: #ff6a00;
    border-bottom-left-radius: 0;
    border-bottom-right-radius: 0;
}

/* Category select */
.alibaba-select {
    height: 100%;
    padding: 0 10px 0 14px;
    border: none;
    background: transparent;
    font-size: 14px;
    color: #333;
    cursor: pointer;
    outline: none;
    white-space: nowrap;
    min-width: 110px;
    appearance: auto;
}

/* Divider */
.alibaba-divider {
    width: 1px;
    height: 24px;
    background: #e5e7eb;
    flex-shrink: 0;
}

/* Text input */
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
.alibaba-input::placeholder {
    color: #b0b3b8;
}

/* Search button */
.alibaba-btn {
    display: flex;
    align-items: center;
    gap: 7px;
    height: 100%;
    padding: 0 22px;
    background: linear-gradient(135deg, #ff6a00, #ff8c38);
    color: #fff;
    border: none;
    border-radius: 0 10px 10px 0;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
    white-space: nowrap;
    transition: opacity 0.15s;
}
.alibaba-btn:hover { opacity: 0.9; }

/* Dropdown container */
.alibaba-dropdown {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: #fff;
    border: 2px solid #ff6a00;
    border-top: none;
    border-radius: 0 0 12px 12px;
    box-shadow: 0 8px 24px rgba(0,0,0,0.10);
    z-index: 99999;
    overflow: hidden;
    max-height: 400px;
    overflow-y: auto;
}

/* Scrollbar */
.alibaba-dropdown::-webkit-scrollbar { width: 4px; }
.alibaba-dropdown::-webkit-scrollbar-thumb { background: #e5e7eb; border-radius: 4px; }

/* Section label */
.alibaba-section-label {
    padding: 8px 18px 4px;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.07em;
    color: #9ca3af;
    background: #fafafa;
    border-bottom: 1px solid #f3f4f6;
}

/* Suggestion row */
.alibaba-suggestion-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 18px;
    cursor: pointer;
    transition: background 0.12s;
    border-bottom: 1px solid #f9fafb;
}
.alibaba-suggestion-item:hover {
    background: #fff5ee;
}
.alibaba-suggestion-item:last-child {
    border-bottom: none;
}

/* Icon */
.alibaba-suggestion-icon {
    display: flex;
    align-items: center;
    color: #c0c4cc;
    flex-shrink: 0;
}

/* Text — the bold highlight is injected by PHP */
.alibaba-suggestion-text {
    flex: 1;
    font-size: 14px;
    color: #374151;
}
.alibaba-suggestion-text .highlight {
    font-weight: 700;
    color: #111;
}

/* Tag badge */
.alibaba-suggestion-tag {
    font-size: 11px;
    color: #9ca3af;
    background: #f3f4f6;
    border-radius: 4px;
    padding: 2px 7px;
    white-space: nowrap;
    flex-shrink: 0;
}

/* No results */
.alibaba-no-results {
    padding: 18px;
    font-size: 14px;
    color: #6b7280;
    text-align: center;
}

/* Alpine transition */
.dropdown-enter        { transition: opacity 0.15s ease, transform 0.15s ease; }
.dropdown-enter-start  { opacity: 0; transform: translateY(-4px); }
.dropdown-enter-end    { opacity: 1; transform: translateY(0); }

/* Hide x-cloak elements until Alpine loads */
[x-cloak] { display: none !important; }
</style>