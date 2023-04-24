const showAddStudent = (addStudentId) => {
	const addStudent = document.getElementById(addStudentId);

	if (addStudent) {
		addStudent.classList.add('showAddStudent');
		addStudent.addEventListener('click', (event) => {

			if (event.target.id === addStudentId || event.target.className === 'closeAddStudent') {
				addStudent.classList.remove('showAddStudent');
			}
		});
	}
	
	const contents = document.querySelectorAll('.contentsAddStudent');
	contents.forEach((element) => {
		element.onchange = function (e) {
			if (element.value != '') {
				e.target.style.borderColor = "black";
			} else
				e.target.style.borderColor = "silver";
		};
	});



}
