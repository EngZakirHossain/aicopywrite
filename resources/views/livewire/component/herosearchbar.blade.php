<div class="hero-form">
    <form wire:submit.prevent="search">
        <input type="text" placeholder="Enter Product Name" wire:model="search">
        <div class="hero-search-btn">
            <button type="submit"><svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 16 16"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"><path d="m11.25 11.25l3 3"/><circle cx="7.5" cy="7.5" r="4.75"/></g></svg> {{ __('Search') }}</button>
        </div>
    </form>
</div>