<div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
        <div class="d-block mb-4 mb-md-0">
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                    <li class="breadcrumb-item">
                        <a href="#">
                            <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                                ></path>
                            </svg>
                        </a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ env('APP_NAME') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('Menu List') }}</li>
                </ol>
            </nav>
            <h2 class="h4">{{ __('Menu List') }}</h2>
            <p class="mb-0">{{ __('Show All Menu List') }}</p>
        </div>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{ route('admin.menu.create') }}" class="btn btn-sm btn-gray-800 d-inline-flex align-items-center">
                <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                {{ __('New Menu') }}
            </a>
        </div>
    </div>
    <div class="table-settings mb-4">
        <div class="row justify-content-between align-items-center">
            <div class="col-9 col-lg-8 d-md-flex">
                <div class="input-group me-2 me-lg-3 fmxw-300">
                    <span class="input-group-text">
                        <svg class="icon icon-xs" x-description="Heroicon name: solid/search" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                        </svg>
                    </span>
                    <input type="text" class="form-control" wire:model="search" placeholder="Search Menus" />
                </div>
                <select class="form-select fmxw-200 d-none d-md-inline" aria-label="Message select example 2" wire:model="filter_status">
                    <option value="all" selected="selected">{{ __('All') }}</option>
                    <option value="approved">{{ __('Active') }}</option>
                    <option value="pending">{{ __('Pending') }}</option>
                    <option value="darft">{{ __('Darft') }}</option>
                </select>
            </div>
            <div class="col-3 col-lg-4 d-flex justify-content-end">
                
            </div>
        </div>
    </div>
    <div class="card card-body shadow border-0 table-wrapper table-responsive">
        <form wire:submit.prevent="change_status">
            <div class="d-flex mb-3">
                <select class="form-select fmxw-200" aria-label="Message select example" wire:model="status">
                    <option selected="selected">{{ __('Select Action') }}</option>
                    <option value="pending">{{ __('Move To Pending') }}</option>
                    <option value="draft">{{ __('Move To Draft') }}</option>
                    <option value="approved">{{ __('Move To Active') }}</option>
                    <option value="delete">{{ __('Delete Permanently') }}</option>
                </select>
                <button type="submit" class="btn btn-sm px-3 btn-secondary ms-3">{{ __('Apply') }}</button>
            </div>
            <table class="table user-table table-hover align-items-center">
                <thead>
                    <tr>
                        <th class="border-bottom">
                            
                        </th>
                        <th class="border-bottom">{{ __('Name') }}</th>
                        <th class="border-bottom">{{ __('Date Created') }}</th>
                        <th class="border-bottom">{{ __('Status') }}</th>
                        <th class="border-bottom">{{ __('Customize') }}</th>
                        <th class="border-bottom">{{ __('Action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($menus as $menu)
                    <tr>
                        <td>
                            <div class="form-check dashboard-check">
                                <input class="form-check-input" type="checkbox" wire:model="checklistId" value="{{ $menu->id }}" /> 
                            </div>
                        </td>
                        <td> 
                            <span class="fw-bold">{{ $menu->name }}</span>
                        </td>
                        <td><span class="fw-normal">{{ $menu->created_at->isoFormat('MM MMM Y') }}</span></td>
                        <td>
                            @if ($menu->status == 'approved')
                            <span class="fw-normal text-success"> 
                                {{ __('Active') }}
                            </span>
                            @elseif($menu->status == 'pending')
                            <span class="fw-normal text-danger"> 
                                {{ __('Pending') }}
                            </span>
                            @elseif($menu->status == 'draft')
                            <span class="fw-normal text-danger"> 
                                {{ __('Draft') }}
                            </span>
                            @endif 
                        </td>
                        <td><a href="{{ route('admin.menu.builder',$menu->id) }}" class="btn btn-tertiary"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M16 13l6.964 4.062-2.973.85 2.125 3.681-1.732 1-2.125-3.68-2.223 2.15L16 13zm-2-7h2v2h5a1 1 0 0 1 1 1v4h-2v-3H10v10h4v2H9a1 1 0 0 1-1-1v-5H6v-2h2V9a1 1 0 0 1 1-1h5V6zM4 14v2H2v-2h2zm0-4v2H2v-2h2zm0-4v2H2V6h2zm0-4v2H2V2h2zm4 0v2H6V2h2zm4 0v2h-2V2h2zm4 0v2h-2V2h2z" fill="rgba(255,255,255,1)"/></svg> Builder</a></td>
                        <td>
                            <div class="btn-group text-center">
                                <button class="btn btn-link text-dark dropdown-toggle dropdown-toggle-split m-0 p-0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <svg class="icon icon-xs" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                    </svg>
                                </button>
                                <div class="dropdown-menu dashboard-dropdown dropdown-menu-start mt-2 py-1">
                                    <a class="dropdown-item d-flex align-items-center" href="{{ route('admin.menu.edit',$menu->id) }}">
                                        <svg class="mr-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18"><path fill="none" d="M0 0h24v24H0z"/><path d="M16.757 3l-2 2H5v14h14V9.243l2-2V20a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h12.757zm3.728-.9L21.9 3.516l-9.192 9.192-1.412.003-.002-1.417L20.485 2.1z" fill="rgba(156,163,175,1)"/></svg>
                                        {{ __('Edit Menu') }}
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </form>
        <div class="card-footer px-3 border-0 d-flex flex-column flex-lg-row align-items-center justify-content-end">
            {{ $menus->links() }}
        </div>
    </div>
</div>


<script src="{{ asset('assets/js/script.js') }}"></script>