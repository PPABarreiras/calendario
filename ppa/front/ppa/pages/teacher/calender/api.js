const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
const idClass = urlParams.get('id_class');

//fetch(`localhost:3000/jobs/student?date=${year}-${month}`, {
//  method: 'GET',
//  headers: {
//    'Content-Type': 'application/json',
//    'Authorization': `Bearer ${window.localStorage.getItem('token')}`
//  }
//})
//  .then((response) => response.json())
//  .then((response) => {
//    data = response;
//    createCalender(year, month);
//});

//fetch(`localhost:3000/jobs/teacher?id_class=${idClass}`, {
//  method: 'GET',
//  headers: {
//    'Content-Type': 'application/json',
//    'Authorization': `Bearer ${window.localStorage.getItem('token')}`
//  }
//})
//  .then((response) => response.json())
//  .then((response) => teacher = response);



function addNewTask() {
  const title = document.querySelector('#titleTask');
  const description = document.querySelector('#descriptionTask');
  const deadline = document.querySelector('#dateTask');
  const note = document.querySelector('#noteTask');
  const idType = document.querySelector('#typeTask');

  const body = {
    title: title.value,
    description: description.value,
    deadline: deadline.value,
    note: String(note.value).includes(',') ? Number(note.value.split(',').join('.')) : Number(note.value),
    id_type: idType.options[idType.selectedIndex].value 
  };

  fetch(`localhost:3000/new/job`, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'Authorization': `Bearer ${window.localStorage.getItem('token')}`
    },
    body: JSON.stringify(body)
  })
    .then((response) => console.log);
}

function captureVacantClass() {}
