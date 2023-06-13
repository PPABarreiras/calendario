const showModal = (modalId, closeId) => {
  console.log(modalId, closeId);
	const modal = document.getElementById(modalId);

	if (modal) {
		modal.classList.add('showModal');
		modal.addEventListener('click', (event) => {

			if (event.target.id === modalId || event.target.id === closeId) {
				modal.classList.remove('showModal');
			}
		});
	}
}
