<form class="navigation-search form-inline" action="{{ route('liara.search') }}" method="get">
  {{ csrf_field() }}

  <x-input name="search" type="search" placeholder="Search" required/>

  <button class="btn btn-light" type="submit">
    <x-svg class="bi bi-search">
      <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 011.415 0l3.85 3.85a1 1 0 01-1.414 1.415l-3.85-3.85a1 1 0 010-1.415z" clip-rule="evenodd"/>
      <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 100-11 5.5 5.5 0 000 11zM13 6.5a6.5 6.5 0 11-13 0 6.5 6.5 0 0113 0z" clip-rule="evenodd"/>
    </x-svg>
  </button>
</form>
