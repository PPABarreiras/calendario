const contents = document.querySelectorAll('.inputContent');
contents.forEach((element) => {
	element.onchange = function (e) {
		if (element.value != '') {
			e.target.style.borderColor = "black";
		} else
			e.target.style.borderColor = "silver";
	};
});

