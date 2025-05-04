<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Upgrade to Blogger</title>
</head>
<body>

    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <form action="" method="POST">
        @csrf
        <label>Blog Name:</label>
        <input type="text" name="blogger_name" required>
    
        <label>Bio (optional):</label>
        <textarea name="bio"></textarea>
    
        <label>Select Blog Categories:</label>
        <select name="categories[]" multiple required>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    
        <button type="submit">Become a Blogger</button>
    </form>
    
</body>
</html>