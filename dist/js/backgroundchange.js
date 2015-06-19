var images = ['1.jpg', '2.jpg', '3.jpg', '4.jpg', '5.jpg', '6.jpg'];

$('#supersized').css({'background-image': 'url(images/background/' + images[Math.floor(Math.random() * images.length)] + ')'});

$('<img src="images/background/' + images[Math.floor(Math.random() * images.length)] + '">').appendTo('#banner');