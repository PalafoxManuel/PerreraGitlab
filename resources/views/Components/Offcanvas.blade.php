@props([
'id' => 'offcanvas',
'title' => 'Menú',
'isOpen' => false, // controlado por clases o JS externo
])

<div>
    <!-- Backdrop -->
    <div id="{{ $id }}-backdrop" class="backdrop {{ $isOpen ? 'open' : '' }}" onclick="document.getElementById('{{ $id }}').classList.remove('open'); document.getElementById('{{ $id }}-backdrop').classList.remove('open');"></div>

    <!-- Offcanvas panel -->
    <div id="{{ $id }}" class="offcanvas {{ $isOpen ? 'open' : '' }}">
        <div class="offcanvas-header">
            <h2>{{ $title }}</h2>
            <button type="button" class="close-button" onclick="document.getElementById('{{ $id }}').classList.remove('open'); document.getElementById('{{ $id }}-backdrop').classList.remove('open');">×</button>
        </div>
        <div class="offcanvas-body">
            {{ $slot }}
        </div>
    </div>
</div>