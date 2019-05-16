window.onload = initiated;

function initiated() {
	var thumbnails = document.getElementById("thumbnails");
	var enlarge = document.getElementById("enlarged");
	var figure = document.getElementById("figure");
	var caption = document.getElementById("caption");

	thumbnails.addEventListener("click", function showLarger(img){
		if(img.target.nodeName.toLowerCase() == 'img') {
			var imgSrc = img.target.src;
			var newImgSrc = imgSrc.replace("small", "medium");
			
			enlarge.src = newImgSrc;
			caption.textContent = img.target.title;
		}
	});
	
	figure.addEventListener("mouseover", function showCaption(e) {
		caption.style.opacity = "0.75";
	});
	
	figure.addEventListener("mouseout", function hideCaption(e) {
		caption.style.opacity = "0";
	});
}
