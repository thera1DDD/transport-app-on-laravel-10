@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <div class="alert-container">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @elseif(session('info'))
            <div class="alert alert-info">
                {{ session('info') }}
            </div>
        @elseif(session('warning'))
            <div class="alert alert-warning">
                {{ session('warning') }}
            </div>
        @endif
    </div>

