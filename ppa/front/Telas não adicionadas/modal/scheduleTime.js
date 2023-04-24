const showTime = (timeId) => {
	const time = document.getElementById(timeId);

	if (time) {
		time.classList.add('showTime');
		time.addEventListener('click', (event) => {

			if (event.target.id === timeId || event.target.className === 'closeTime') {
				time.classList.remove('showTime');
			}
		});
	}
	const contents = document.querySelectorAll('.contentsTime');
	contents.forEach((element) => {
		element.onchange = function (e) {
			if (element.value != '') {
				e.target.style.borderColor = "black";
			} else
				e.target.style.borderColor = "silver";
		};
	});
	
}