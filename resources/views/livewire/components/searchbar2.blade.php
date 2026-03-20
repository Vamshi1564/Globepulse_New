<div x-data="{
    query: '',
    open: false,
    activeIdx: -1,
    items: [],
    mock: {
        products:   ['Electric Bike 1000W','Electric Scooter','Electric Dirt Bike','Electric Car Charger','Electric Motorcycle','Electric Bicycle','Electric Mountain Bike','Electronics Wholesale','Solar Panel 400W','Solar Street Light','LED Strip Lights','LED Flood Light','Bluetooth Speaker','Smart Watch Pro'],
        categories: ['Electronics and Electrical','Electric Vehicles','Solar Energy','Lighting Equipment','Consumer Electronics','Smart Home Devices','Audio and Video Equipment','Mobile Accessories'],
        buyleads:   ['Looking for Electric Bike Supplier','Need 500 units Electric Scooter','Buying Solar Panels in Bulk','Request for LED Light Manufacturer','Seeking Smart Watch Wholesale','Buy Bluetooth Speakers 1000 pcs']
    },
    search(q) {
        this.query = q;
        this.activeIdx = -1;
        if (q.trim().length < 2) { this.open = false; this.items = []; return; }
        const lq = q.toLowerCase();
        let result = [];
        this.mock.products.filter(x => x.toLowerCase().includes(lq)).slice(0,8).forEach(n => result.push({name:n, type:'Product', key:'products'}));
        this.mock.categories.filter(x => x.toLowerCase().includes(lq)).slice(0,4).forEach(n => result.push({name:n, type:'Category', key:'categories'}));
        this.mock.buyleads.filter(x => x.toLowerCase().includes(lq)).slice(0,4).forEach(n => result.push({name:n, type:'Buy Lead', key:'buyleads'}));
        this.items = result;
        this.open = true;
    },
    select(val) {
        this.query = val;
        this.open = false;
        this.items = [];
        this.activeIdx = -1;
        document.getElementById('sb-hidden-input').value = val;
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
            this.select(this.items[this.activeIdx].name);
        }
    },
    highlightHtml(text, q) {
        if (!q) return '<b style=\'color:#111;font-weight:600\'>' + text + '</b>';
        const i = text.toLowerCase().indexOf(q.toLowerCase());
        if (i === -1) return '<b style=\'color:#111;font-weight:600\'>' + text + '</b>';
        return '<span style=\'color:#bbb;font-weight:400\'>' + text.slice(i, i+q.length) + '</span>'
             + '<b style=\'color:#111;font-weight:600\'>' + text.slice(i+q.length) + '</b>';
    },
    lastType: ''
}" @click.outside="open = false" style="position:relative;width:100%;">

    <form wire:submit.prevent="submitSearch">

        {{-- Search Bar --}}
        <div id="sb-bar" :class="open ? 'sb-bar sb-bar-open' : 'sb-bar'"
             style="display:flex;align-items:center;background:#fff;border:2px solid #e0dbd4;border-radius:12px;height:52px;transition:border-color .2s,border-radius .15s,box-shadow .2s;overflow:hidden;">

            {{-- Category Select --}}
            <select wire:model.defer="searchType"
                    style="height:100%;padding:0 10px 0 14px;font-size:14px;font-weight:500;color:#444;background:transparent;outline:none;min-width:108px;cursor:pointer;border:none;flex-shrink:0;border-right:1px solid #e0dbd4;">
                <option value="product">Product</option>
                <option value="buylead">BuyLead</option>
            </select>

            {{-- Text Input --}}
            <input
                type="text"
                id="sb-hidden-input"
                wire:model.defer="searchTerm"
                :value="query"
                @input="search($event.target.value)"
                @keydown.arrow-down.prevent="arrowDown()"
                @keydown.arrow-up.prevent="arrowUp()"
                @keydown.enter.prevent="enterKey()"
                @keydown.escape="open = false"
                @focus="if(query.trim().length >= 2) open = true"
                placeholder="Search products, categories, buy leads..."
                autocomplete="off"
                style="flex:1;height:100%;padding:0 14px;border:none;outline:none;box-shadow:none;font-size:15px;color:#111;background:transparent;caret-color:#ff6a00;"
            />

            {{-- Submit Button --}}
            <button type="submit"
                    style="display:flex;align-items:center;justify-content:center;height:100%;padding:0 20px;background:linear-gradient(135deg,#ff6a00,#ff8c38);border:none;cursor:pointer;flex-shrink:0;">
                <svg xmlns="http://www.w3.org/2000/svg" height="22" viewBox="0 0 24 24" width="22">
                    <path d="M0 0h24v24H0z" fill="none"/>
                    <path fill="#fff" d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zM9.5 14C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
                </svg>
            </button>

        </div>

        {{-- Dynamic border radius when open --}}
        <template x-if="open">
            <span x-init="
                document.getElementById('sb-bar').style.borderBottomLeftRadius  = '0';
                document.getElementById('sb-bar').style.borderBottomRightRadius = '0';
                document.getElementById('sb-bar').style.borderColor = '#0d1a94';
                document.getElementById('sb-bar').style.boxShadow = 'none';
            "></span>
        </template>
        <template x-if="!open">
            <span x-init="
                document.getElementById('sb-bar').style.borderBottomLeftRadius  = '12px';
                document.getElementById('sb-bar').style.borderBottomRightRadius = '12px';
            "></span>
        </template>

    </form>

    {{-- Dropdown --}}
    <div x-show="open"
         x-transition:enter="transition ease-out duration-150"
         x-transition:enter-start="opacity-0 -translate-y-1"
         x-transition:enter-end="opacity-100 translate-y-0"
         style="position:absolute;top:100%;left:0;right:0;background:#fff;border:2px solid #0d1a94;border-top:none;border-radius:0 0 12px 12px;box-shadow:0 10px 28px rgba(0,0,0,.10);z-index:99999;max-height:420px;overflow-y:auto;">

        <template x-if="items.length === 0">
            <div style="padding:20px 16px;font-size:14px;color:#aaa;text-align:center;">
                No results for "<span x-text="query" style="font-weight:600;color:#333;"></span>"
            </div>
        </template>

        <template x-if="items.length > 0">
            <div>
                <template x-for="(item, idx) in items" :key="idx">
                    <div @click="select(item.name)"
                         :style="idx === activeIdx ? 'background:#fff5ee;' : ''"
                         @mouseover="activeIdx = idx"
                         @mouseleave="activeIdx = -1"
                         style="padding:10px 16px;cursor:pointer;border-bottom:1px solid #faf7f4;transition:background .1s;">
                        <div style="font-size:14px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;" x-html="highlightHtml(item.name, query)"></div>
                    </div>
                </template>
            </div>
        </template>

    </div>

</div>