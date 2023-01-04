<x-app>
    <side-bar 
        user-name="{{ Auth::user()->name }}" 
        action-logout="{{ route('logout') }}" 
        link-products="{{ route('dashboard.products') }}"
        link-purchases="{{ route('dashboard.purchases') }}"
        link-categories="{{ route('dashboard.categories') }}"
        link-users="{{ route('dashboard.users') }}"
    ></side-bar>
   <table-products></table-products>
</x-app>