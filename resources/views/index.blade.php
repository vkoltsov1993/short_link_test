<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Short Link</title>
</head>
<body>
<input id="url" type="hidden" value="{{ route('make-short') }}">
<div>
    <input id="link" type="text">
    <button id="btn">Make short</button>
</div>
<div>
    <p id="short_link"></p>
    <a
        id="short_link_a"
        href=""
        target="_blank"
        style="display: none"
    >Check</a>
</div>
<script>
    let url = document.querySelector('#url').value;

    let btn = document.querySelector('#btn');
    btn.addEventListener('click', async () => {
        let link = document.querySelector('#link').value;
        const request = new Request(url, {
            method: 'POST',
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-Token": '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                link: link,
            }),
        });
        const response = await fetch(request);
        const data = await response.json();
        let dataBody = data.data;
        let shortLink = url + '/' +dataBody.short_link;
        document.querySelector('#short_link').innerHTML = shortLink;
        let shortLinkTag = document.querySelector('#short_link_a');
        shortLinkTag.href = shortLink;
        shortLinkTag.style.display = 'inline';
    });


</script>
</body>
</html>
