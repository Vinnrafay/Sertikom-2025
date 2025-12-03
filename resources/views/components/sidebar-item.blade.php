@props(['icon', 'label', 'route', 'link'])

<a href="{{ $link }}"
   class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 
          hover:bg-indigo-50 hover:text-indigo-600 group
          {{ request()->routeIs($route) ? 'bg-indigo-100 text-indigo-600 font-semibold shadow-sm' : 'text-gray-700' }}">
    <i class="fa-solid {{ $icon }} mr-3 text-lg opacity-80 group-hover:opacity-100"></i>
    <span>{{ $label }}</span>
</a>
