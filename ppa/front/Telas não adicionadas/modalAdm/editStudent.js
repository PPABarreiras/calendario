
const showEditStudent = (editStudentId) => {
	const editStudent = document.getElementById(editStudentId);

	if (editStudent) {
		editStudent.classList.add('showEditStudent');
		editStudent.addEventListener('click', (event) => {

			if (event.target.id === editStudentId || event.target.className === 'closeEditStudent') {
				editStudent.classList.remove('showEditStudent');
			}
		});
	}
	
	const contents = document.querySelectorAll('.contentsEditStudent');
	contents.forEach((element) => {
		element.onchange = function (e) {
			if (element.value != '') {
				e.target.style.borderColor = "black";
			} else
				e.target.style.borderColor = "silver";
		};
	});



}
