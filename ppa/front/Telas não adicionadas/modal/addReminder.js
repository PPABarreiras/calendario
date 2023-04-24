const showReminder = (reminderId) => {
	const reminder = document.getElementById(reminderId);

	if (reminder) {
		reminder.classList.add('showReminder');
		reminder.addEventListener('click', (event) => {

			if (event.target.id === reminderId || event.target.className === 'closeReminder') {
				reminder.classList.remove('showReminder');
			}
		});
	}
	const contents = document.querySelectorAll('.contentsReminder');
	contents.forEach((element) => {
		element.onchange = function (e) {
			if (element.value != '') {
				e.target.style.borderColor = "black";
			} else
				e.target.style.borderColor = "silver";
		};
	});



}
