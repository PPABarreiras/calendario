const showAddTeacher = (addTeacherId) => {
	const addTeacher = document.getElementById(addTeacherId);

	if (addTeacher) {
		addTeacher.classList.add('showAddTeacher');
		addTeacher.addEventListener('click', (event) => {

			if (event.target.id === addTeacherId || event.target.className === 'closeAddTeacher') {
				addTeacher.classList.remove('showAddTeacher');
			}
		});
	}
	
	const contents = document.querySelectorAll('.contentsAddTeacher');
	contents.forEach((element) => {
		element.onchange = function (e) {
			if (element.value != '') {
				e.target.style.borderColor = "black";
			} else
				e.target.style.borderColor = "silver";
		};
	});



}
