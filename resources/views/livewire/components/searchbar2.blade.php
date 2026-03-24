<div x-data="{
    open: false,
    activeIdx: -1,
    get items() {
        return ($wire.suggestions || []).filter(s => s && s.name && s.url);
    },
    arrowDown() {
        if (!this.open) return;
        this.activeIdx = Math.min(this.activeIdx + 1, this.items.length - 1);
    },
    arrowUp() {
        if (!this.open) return;
        this.activeIdx = Math.max(this.activeIdx - 1, 0);
    },
    enterKey() {
        if (this.activeIdx >= 0 && this.items[this.activeIdx]) {
            window.location.href = this.items[this.activeIdx].url;
        }
    },
    highlightHtml(text, q) {
        if (!text) return '';
        if (!q) return '<span style=\'color:#111;font-weight:500\'>' + text + '</span>';
        const i = text.toLowerCase().indexOf(q.toLowerCase());
        if (i === -1) return '<span style=\'color:#111;font-weight:500\'>' + text + '</span>';
        return '<span style=\'color:#ff6a00;font-weight:700\'>' + text.slice(i, i + q.length) + '</span>'
             + '<span style=\'color:#111;font-weight:500\'>' + text.slice(i + q.length) + '</span>';
    }
}"
x-init="
    $wire.on('suggestionsUpdated', () => {
        const valid = ($wire.suggestions || []).filter(s => s && s.name && s.url);
        open = valid.length > 0 || $wire.searchTerm.length >= 2;
        activeIdx = -1;
    });
"
@click.outside="open = false"
style="position:relative;width:100%;">

    <form wire:submit.prevent="submitSearch">

        <div id="sb-bar"
             :style="open
                ? 'display:flex;align-items:center;background:#fff;border:2px solid #0d1a94;border-radius:12px 12px 0 0;height:52px;overflow:hidden;transition:all .2s;'
                : 'display:flex;align-items:center;background:#fff;border:2px solid #e0dbd4;border-radius:12px;height:52px;overflow:hidden;transition:all .2s;'">

            {{-- Category Select --}}
            <select wire:model.live="searchType"
                    style="height:100%;padding:0 10px 0 14px;font-size:14px;font-weight:500;color:#444;background:transparent;outline:none;min-width:108px;cursor:pointer;border:none;flex-shrink:0;border-right:1px solid #e0dbd4;">
                <option value="product">Product</option>
                <!-- <option value="buylead">BuyLead</option> -->
            </select>

            {{-- Text Input --}}
            <input
                type="text"
                wire:model.live.debounce.300ms="searchTerm"
                @keydown.arrow-down.prevent="arrowDown()"
                @keydown.arrow-up.prevent="arrowUp()"
                @keydown.enter.prevent="enterKey()"
                @keydown.escape="open = false; activeIdx = -1"
                @focus="open = items.length > 0"
                placeholder="Search products"
                autocomplete="off"
                style="flex:1;height:100%;padding:0 14px;border:none;outline:none;font-size:15px;color:#111;background:transparent;caret-color:#ff6a00;"
            />

            {{-- Submit Button --}}
            <!-- <button class="search-icon border-0" type="submit" title="search"
                    style="display:flex;align-items:center;justify-content:center;height:100%;padding:0 20px;background:linear-gradient(135deg,#ff6a00,#ff8c38);border:none;cursor:pointer;flex-shrink:0;">
                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                    <path d="M0 0h24v24H0z" fill="none"></path>
                    <path fill="#fff" d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zM9.5 14C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z">
                    </path>
                </svg>
            </button> -->

            {{-- Original Search Button --}}
            <button class="search-icon border-0" type="submit" title="search">
                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                    <path d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zM9.5 14C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z">
                    </path>
                </svg>
            </button>

        </div>

    </form>

    {{-- Dropdown --}}
    <div x-show="open"
         x-transition:enter="transition ease-out duration-150"
         x-transition:enter-start="opacity-0 -translate-y-1"
         x-transition:enter-end="opacity-100 translate-y-0"
         style="position:absolute;top:100%;left:0;right:0;background:#fff;border:2px solid #0d1a94;border-top:none;border-radius:0 0 12px 12px;box-shadow:0 10px 28px rgba(0,0,0,.10);z-index:99999;max-height:420px;overflow-y:auto;">

        {{-- Results --}}
        <template x-if="items.length > 0">
            <div>
                <template x-for="(item, idx) in items" :key="idx">
                    <a :href="item.url"
                       :style="idx === activeIdx
                           ? 'display:flex;align-items:center;gap:10px;padding:10px 16px;background:#fff5ee;border-bottom:1px solid #faf7f4;text-decoration:none;'
                           : 'display:flex;align-items:center;gap:10px;padding:10px 16px;background:#fff;border-bottom:1px solid #faf7f4;text-decoration:none;'"
                       @mouseover="activeIdx = idx"
                       @mouseleave="activeIdx = -1">

                        {{-- Type Badge --}}
                        <!-- <span :style="item.type === 'Product'
                                  ? 'font-size:11px;font-weight:600;padding:2px 8px;border-radius:20px;background:#fff5ee;color:#ff6a00;flex-shrink:0;white-space:nowrap;'
                                  : item.type === 'Category'
                                  ? 'font-size:11px;font-weight:600;padding:2px 8px;border-radius:20px;background:#eef0ff;color:#0d1a94;flex-shrink:0;white-space:nowrap;'
                                  : 'font-size:11px;font-weight:600;padding:2px 8px;border-radius:20px;background:#efffef;color:#1a8a1a;flex-shrink:0;white-space:nowrap;'"
                              x-text="item.type">
                        </span> -->

                        {{-- Item Name with highlight --}}
                        <span style="font-size:14px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;"
                              x-html="highlightHtml(item.name, $wire.searchTerm)">
                        </span>

                    </a>
                </template>
            </div>
        </template>

        {{-- No Results --}}
        <template x-if="items.length === 0">
            <div style="padding:20px 16px;font-size:14px;color:#aaa;text-align:center;">
                No results found for "<span x-text="$wire.searchTerm" style="font-weight:600;color:#333;"></span>"
            </div>
        </template>

    </div>

</div>