function displayNextImage() {
	x = (x === images.length - 1) ? 0 : x + 1;
	document.getElementById("img").src = images[x];
}

function displayPreviousImage() {
	x = (x <= 0) ? images.length - 1 : x - 1;
	document.getElementById("img").src = images[x];
}

function startTimer() {
	setInterval(displayNextImage, 2000);
}

var images = [], x = -1;
images[0] = "img/sports1.jpg";
images[1] = "img/seminar1.jpg";
images[2] = "img/lights1.jpg";