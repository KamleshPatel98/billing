@if(session()->has('success'))
    <script>
        alertify.set('notifier','position', 'top-right');
        alertify.success('{{ session('success') }}');
    </script>
@endif
@if(session()->has('error'))
    <script>
        alertify.set('notifier','position', 'top-right');
        alertify.error('{{ session('error') }}');
    </script>
@endif
@if($errors->any())
    <div class="alert alert-danger" role="alert">
        @foreach ($errors->all() as $error)
            {{ $error }}
            @break
        @endforeach
    </div>
@endif