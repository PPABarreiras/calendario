const showDeleteStudent = (deleteStudentId) => {
	const deleteStudent = document.getElementById(deleteStudentId);

	if (deleteStudent) {
		deleteStudent.classList.add('showDeleteStudent');
		deleteStudent.addEventListener('click', (event) => {

			if (event.target.id === deleteStudentId || event.target.className === 'closeDeleteStudent') {
				deleteStudent.classList.remove('showDeleteStudent');
			}
		});
	}

	const checkbox = document.querySelector("#delete");
	const buttonDelete = document.querySelector("#buttonDelete");

	checkbox.addEventListener("click", changeDeleteButton);

	function changeDeleteButton() {
		if (checkbox.checked) {
			buttonDelete.disabled = false;
		} else {
			buttonDelete.disabled = true;
		}
	}
}
