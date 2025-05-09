@if(session('success'))
    <div style="padding: 10px; background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; border-radius: 5px; margin-bottom: 15px;">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div style="padding: 10px; background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; border-radius: 5px; margin-bottom: 15px;">
        {{ session('error') }}
    </div>
@endif
